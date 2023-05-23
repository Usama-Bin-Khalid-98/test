<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\Common\Designation;
use App\Models\Common\Slip;
use App\Models\StrategicManagement\StatutoryBody;
use App\Models\StrategicManagement\Affiliation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use Auth;

class AffiliationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
        $bodies = StatutoryBody::all();
        $designations = Designation::where(['status' => 'active', 'is_default' => true])->get();

        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $affiliations = Affiliation::with('campus','statutory_bodies')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
            }else {
                $affiliations = Affiliation::with('campus','statutory_bodies')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
            }
        //dd($affiliations);
        return view('strategic_management.affiliations', compact('bodies', 'affiliations', 'designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();

            if($slip){
                $type = 'SAR';
            }else
            {
                $type = 'REG';
            }
            $path = '';
            if(@$request->file('file')) {
                $path = @$request->file('file')->getRealPath();
            }
            if($path){
            $data = array_map('str_getcsv', file(@$path));
            $csv_data = array_slice($data, 1);

            foreach($csv_data as $index=>$addData)
            {
                $getStrBody = StatutoryBody::where(['name'=> @$addData[3]])->first();
                if(!$getStrBody)
                {
                    return response()->json(['error' => ' Incorrect Statutory Body in line ', 'line'=> $index + 2], 422);

                }
                $designation = Designation::byName(@$addData[1])->first();
                if(!$designation){
                    $designation = Designation::create([
                        'name' => @$addData[1],
                        'is_default' => false
                    ]);
                }
                $where_data = [
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'name' => @$addData[0],
                    'designation_id' => $designation->id,
                    'statutory_bodies_id' => $getStrBody->id,
                    'isComplete' => 'yes',
                    'type' => $type];

                $check = Affiliation::where($where_data)->exists();

                if (!$check) {
                    Affiliation::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'name' => @$addData[0],
                        'designation_id' => $designation->id,
                        'statutory_bodies_id' => $getStrBody->id,
                        'affiliation' => @$addData[2],
                        'isComplete' => 'yes',
                        'type' => $type,
                        'created_by' => Auth::user()->id
                    ]);
                }


            }

            }else {

                $validation = Validator::make($request->all(), $this->rules(), $this->messages());
                if($validation->fails())
                {
                    return response()->json($validation->messages()->all(), 422);
                }
                list($designation_id, $error) = Designation::getOrCreate($request->designation, $request->other_designation);
                if($error){
                    return $error;
                }
                $where_data = [
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'name' => $request->name,
                    'designation_id' => $designation_id,
                    'statutory_bodies_id' => $request->statutory_bodies_id,
                    'isComplete' => 'yes',
                    'type' => $type];

                $check = Affiliation::where($where_data)->exists();

                if (!$check) {
                    if ($slip) {
                        $type = 'SAR';
                        Affiliation::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'name' => $request->name,
                            'designation_id' => $designation_id,
                            'affiliation' => $request->affiliation,
                            'statutory_bodies_id' => $request->statutory_bodies_id,
                            'isComplete' => 'yes',
                            'type' => $type,
                            'created_by' => Auth::user()->id
                        ]);
                    } else {
                        $type = 'REG';
                        Affiliation::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'name' => $request->name,
                            'designation_id' => $designation_id,
                            'affiliation' => $request->affiliation,
                            'statutory_bodies_id' => $request->statutory_bodies_id,
                            'isComplete' => 'yes',
                            'type' => $type,
                            'created_by' => Auth::user()->id
                        ]);
                        Affiliation::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'name' => $request->name,
                            'designation_id' => $designation_id,
                            'affiliation' => $request->affiliation,
                            'statutory_bodies_id' => $request->statutory_bodies_id,
                            'isComplete' => 'yes',
                            'type' => 'SAR',
                            'created_by' => Auth::user()->id
                        ]);
                    }
                } else {
                    return response()->json(['error' => ' affiliation already exists.'], 422);
                }
                return response()->json(['success' => ' Affiliations added successfully.'], 200);
            }
                return response()->json(['success' => ' Affiliations added successfully.'], 200);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function show(Affiliation $affiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function edit(Affiliation $affiliation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affiliation $affiliation)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            list($designation_id, $error) = Designation::getOrCreate($request->designation, $request->other_designation);
            if($error){
                return $error;
            }

            Affiliation::where('id', $affiliation->id)->update([
                'name' => $request->name,
                'designation_id' => $designation_id,
                'affiliation' => $request->affiliation,
                'statutory_bodies_id' => $request->statutory_bodies_id,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Affiliations updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affiliation $affiliation)
    {
//        dd($affiliation);
        try {
            Affiliation::where('id', $affiliation->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            Affiliation::destroy($affiliation->id);
            Affiliation::where([
                "name" => $affiliation->name,
                "campus_id" => $affiliation->campus_id,
                "department_id" => $affiliation->department_id,
                "affiliation" => $affiliation->affiliation,
                "designation_id" => $affiliation->designation,
                "statutory_bodies_id" => $affiliation->statutory_bodies_id,
            ])->delete();
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [

            'name' => 'required',
            'designation' => 'required',
            'affiliation' => 'required',
//            'statutory_bodies_id' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
