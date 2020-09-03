<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\PlagiarismCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class PlagiarismCaseController extends Controller
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
        $memberships = PlagiarismCase::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('registration.curriculum.plagiarism_case', compact('memberships'));
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
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/plagiarism_case';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    PlagiarismCase::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'date' => $request->date,
                        'students_initial' => $request->students_initial,
                        'degree' => $request->degree,
                        'nature' => $request->nature,
                        'penalty' => $request->penalty,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Plagiarism Case added successfully.']);
                }

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
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/plagiarism_case';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                PlagiarismCase::where('id', $id)->update(
                    [
                        'date' => $request->date,
                        'students_initial' => $request->students_initial,
                        'degree' => $request->degree,
                        'nature' => $request->nature,
                        'penalty' => $request->penalty,
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Plagiarism Case updated successfully.']);
            }
           PlagiarismCase::where('id', $id)->update([
                        'date' => $request->date,
                        'students_initial' => $request->students_initial,
                        'degree' => $request->degree,
                        'nature' => $request->nature,
                        'penalty' => $request->penalty,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Plagiarism Case updated successfully.']);

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
             PlagiarismCase::where('id', $id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             PlagiarismCase::destroy($id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }


     protected function rules() {
        return [
            'date' => 'required',
            'students_initial' => 'required',
            'degree' => 'required',
            'nature' => 'required',
            'penalty' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'date' => 'required',
            'students_initial' => 'required',
            'degree' => 'required',
            'nature' => 'required',
            'penalty' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'Document must be of the following file type: pdf or docx.'
        ];
    }
}
