<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\ProgramDeliveryMethod;
use App\Models\Carriculum\TeachingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;

class ProgramDeliveryMethodController extends Controller
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
        $items = TeachingMethod::all();
        $methods = ProgramDeliveryMethod::with('teaching_methods')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        return view('registration.curriculum.program_delivery_method', compact('items','methods'));
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
//        dd($request->all());

        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            //$data = $request;
          for($i =0; $i<=count($request->teaching_methods_id); $i++)
          {
              if(@$request->teaching_methods_id[$i] && @$request->course_title[$i] !=null) {
                  ProgramDeliveryMethod::create([
                      'teaching_methods_id' => $request->teaching_methods_id[$i],
                      'campus_id' => Auth::user()->campus_id,
                      'department_id' => Auth::user()->department_id,
                      'course_code' => $request->course_code[$i],
                      'course_title' => $request->course_title[$i],
                      'isComplete' => 'yes',
                      'created_by' => Auth::user()->id
                  ]);
              }

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
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

           ProgramDeliveryMethod::where('id', $id)->update([
                'teaching_methods_id' => $request->teaching_methods_id,
                'course_code' => $request->course_code,
                'course_title' => $request->course_title,
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
             ProgramDeliveryMethod::where('id', $id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             ProgramDeliveryMethod::destroy($id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'course_code' => 'required',
            'course_title' => 'required',
        ];
    }

    protected function update_rules() {
        return [
            'teaching_methods_id' => 'required',
            'course_code' => 'required',
            'course_title' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
