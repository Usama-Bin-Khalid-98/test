<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\ProgramObjective;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;
use function GuzzleHttp\Psr7\str;

class ProgramObjectiveController extends Controller
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
        $scopes = Scope::with('program', 'level')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        $summaries = ProgramObjective::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('registration.curriculum.program_objective', compact('scopes','summaries'));
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

//            dd($request->all());

            foreach ($request->po as $key=> $po) {

//                dd($key);
//                $counter = $key+1;
//                dd($counter);
                ProgramObjective::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'program_id' => $request->program_id,
                    'po_name' => "PO". ($key+1),
                    'po' => $po,
                    'isComplete' => 'yes',
                    'created_by' => Auth::user()->id
                ]);
            }
            return response()->json(['success' => 'Record added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ProgramObjective::where('id', $id)->update([
                'program_id' => $request->program_id,
                'po' => $request->po,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            ProgramObjective::where('id', $id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            ProgramObjective::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


    protected function rules() {
        return [
            'program_id' => 'required',
            'po' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
