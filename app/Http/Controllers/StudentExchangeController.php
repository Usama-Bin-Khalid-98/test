<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\StudentExchange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentExchangeController extends Controller
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
        $genders = StudentExchange::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        $getYears = BusinessSchoolTyear::where(['campus_id'=> $campus_id, 'department_id'=> $department_id])->get()->first();
        $years['yeart'] = @$getYears->tyear;
        $years['year_t_1'] = @$getYears->year_t_1;
        $years['year_t_2'] = @$getYears->year_t_2;

        return view('external_linkages.student_exchange_program', compact('genders', 'years'));
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
//            dd($fileName);
                if(StudentExchange::where(['campus_id' => Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])->exists()){
                    return response()->json(['message'=> 'Student exchange already exists.'], 422);
                }
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName = Auth::user()->id."file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/student_exchange';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    StudentExchange::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'year' => $request->year,
                        'destination_country' => $request->destination_country,
                        'student_name' => $request->student_name,
                        'source_country' => $request->source_country,
                        'name_student' => $request->name_student,
                        'file' => $path.'/'.$imageName,
                        'isComplete' => 'yes',
                        'created_by' => Auth::user()->id
                ]);

                    return response()->json(['success' => 'Student Exchange added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\StudentExchange  $studentExchange
     * @return \Illuminate\Http\Response
     */
    public function show(StudentExchange $studentExchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\StudentExchange  $studentExchange
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentExchange $studentExchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\StudentExchange  $studentExchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentExchange $studentExchange)
    {
         $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=StudentExchange::find($studentExchange->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = Auth::user()->id. "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/student_exchange';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(StudentExchange::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                StudentExchange::where('id', $studentExchange->id)->update(
                    [
                    'year' => $request->year,
                        'destination_country' => $request->destination_country,
                        'student_name' => $request->student_name,
                        'source_country' => $request->source_country,
                        'name_student' => $request->name_student,
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Student Exchange updated successfully.']);
            }
           StudentExchange::where('id', $studentExchange->id)->update([
               'year' => $request->year,
                        'destination_country' => $request->destination_country,
                        'student_name' => $request->student_name,
                        'source_country' => $request->source_country,
                        'name_student' => $request->name_student,
               'status' => $request->status,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Student Exchange updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\StudentExchange  $studentExchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentExchange $studentExchange)
    {
        try {
        StudentExchange::where('id', $studentExchange->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            StudentExchange::destroy($studentExchange->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


     protected function rules() {
        return [
            'year' => 'required',
            'destination_country' => 'required',
            'student_name' => 'required',
            'source_country' => 'required',
            'name_student' => 'required',
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'year' => 'required',
            'destination_country' => 'required',
            'student_name' => 'required',
            'source_country' => 'required',
            'name_student' => 'required',
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'Document must be of the following file type: pdf or docx.'
        ];
    }
}
