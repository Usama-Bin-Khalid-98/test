<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\Common\Designation;
use App\Models\Common\Slip;
use App\Models\StrategicManagement\StatutoryBody;
use App\Models\StrategicManagement\StatutoryCommittee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;
use Illuminate\Support\Facades\Log;

class StatutoryCommitteeController extends Controller
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
        $statutory_committees = StatutoryCommittee::with('statutory_body', 'designation')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('strategic_management.statutory_committee', compact('bodies', 'designations', 'statutory_committees'));
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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;

            for($i =0; $i<count(@$request->name); $i++)
            {
                if ($request->name[$i] == ''){
                    continue;
                }

                list($designation_id, $error) = Designation::getOrCreate($request->designation_id[$i], $request->other_designation[$i]);
                if($error){
                    return $error;
                }
                $check = StatutoryCommittee::where([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'statutory_body_id' => @$request->statutory_body_id[$i],
                    'name' => @$request->name[$i],
                    'designation_id' => $designation_id
                ])->exists();
    //dd($check);
                if(!$check)
                {
                    $path = ''; $fileName = '';
                    if(@$request->file('file'.intval( $i+1))) {
                        $fileIndex = 'file'.intval( $i+1);
                        $fileName = $request->name[$i] . "-file-" . time() . '.' . $request->$fileIndex->getClientOriginalExtension();
                        $path = 'uploads/statutory_committee';
                        $diskName = env('DISK');
                        $disk = Storage::disk($diskName);
                        $request->file('file'.intval( $i+1))->move($path, $fileName);
                    }
                    if(@$request->name[$i] !='') {
                        StatutoryCommittee::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'statutory_body_id' => $request->statutory_body_id[$i],
                            'name' => $request->name[$i],
                            'designation_id' => $designation_id,
                            'date_first_meeting' => $request->date_first_meeting[$i],
                            'date_second_meeting' => $request->date_second_meeting[$i],
                            'date_third_meeting' => $request->date_third_meeting[$i],
                            'date_fourth_meeting' => $request->date_fourth_meeting[$i],
                            'file' => $path . '/' . $fileName,
                            'isComplete' => 'yes',
                            'created_by' => Auth::user()->id
                        ]);
                    }
                }
                else{
                    return response()->json(['error' => 'Statutory committee member '. $request->name[$i]. ' already exists.'], 409);
                }
                //}
            }
                return response()->json(['success' => 'Statutory committee added successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function show(StatutoryCommittee $statutoryCommittee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function edit(StatutoryCommittee $statutoryCommittee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatutoryCommittee $statutoryCommittee)
    {
        //
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            Log::debug($request->all());
            list($designation_id, $error) = Designation::getOrCreate($request->designation_id, $request->other_designation);
            if($error){
                return $error;
            }
            $update=StatutoryCommittee::find($statutoryCommittee->id);
            $path = ''; $fileName = '';
            if($request->file('file')) {
                $fileName = $request->name . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/statutory_committee';
                $diskName = env('DISK');
                $disk = Storage::disk($diskName);
                if($update->file != '' && $update->file != '/'){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $fileName);
                $statutoryCommittee->update([
                    'file' => $path.'/'.$fileName
                ]);
            }

            StatutoryCommittee::where('id', $statutoryCommittee->id)->update([
                'statutory_body_id' => $request->statutory_body_id,
                'name' => $request->name,
                'designation_id' => $designation_id,
                'date_first_meeting' => $request->date_first_meeting,
                'date_second_meeting' => $request->date_second_meeting,
                'date_third_meeting' => $request->date_third_meeting,
                'date_fourth_meeting' => $request->date_fourth_meeting,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Statutory committee updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatutoryCommittee $statutoryCommittee)
    {
//        dd($statutoryCommittee);
        try {
            StatutoryCommittee::where('id', $statutoryCommittee->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            StatutoryCommittee::destroy($statutoryCommittee->id);
            StatutoryCommittee::where([
                "campus_id" => $statutoryCommittee->campus_id,
                "department_id" => $statutoryCommittee->department_id,
                "statutory_body_id" => $statutoryCommittee->statutory_body_id,
                "name" => $statutoryCommittee->name,
                "designation_id" => $statutoryCommittee->designation_id,
                "date_first_meeting" => $statutoryCommittee->date_first_meeting,
                "date_second_meeting" => $statutoryCommittee->date_second_meeting,
                "date_third_meeting" => $statutoryCommittee->date_third_meeting,
                "date_fourth_meeting" => $statutoryCommittee->date_fourth_meeting,
            ])->delete();
            return response()->json(['success'=> 'Record deleted successfully']);
        }catch (Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    protected function rules() {
        return [
            'statutory_body_id' => 'required',
            'name' => 'required',
//            'designation_id' => 'required',
//            'date_first_meeting' => 'required',
//            'date_second_meeting' => 'required',
//            'date_third_meeting' => 'required',
//            'date_fourth_meeting' => 'required',
//            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048'
        ];
    }

    protected function update_rules() {
        return [
            'statutory_body_id' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
            'date_first_meeting' => 'required',
            'date_second_meeting' => 'required',
            'date_third_meeting' => 'required',
            'date_fourth_meeting' => 'required',
            // 'file' => 'mimes:pdf,docx'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            // 'file.mimes' => 'CV must be of the following file type: pdf, doc or docx.'
        ];
    }
}
