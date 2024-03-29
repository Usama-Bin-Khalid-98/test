<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\CourseOutline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class CourseOutlineController extends Controller
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

        $reports = CourseOutline::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('registration.curriculum.course_outline', compact('reports'));
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
            if(CourseOutline::where(['campus_id' => Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])->exists()){
                return response()->json(['message'=> 'Course Outline already exists.'], 422);
            }
//            dd($fileName);
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/course_outline/';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    CourseOutline::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'file' => $path.'/'.$imageName,
                        'isComplete' => 'yes',
                        'created_by' => Auth::user()->id
                ]);

                    return response()->json(['success' => ' Record added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carriculum\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function show(CourseOutline $courseOutline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carriculum\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseOutline $courseOutline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carriculum\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseOutline $courseOutline)
    {
         $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=CourseOutline::find($courseOutline->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/course_outline';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(CourseOutline::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                CourseOutline::where('id', $courseOutline->id)->update(
                    [
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Record updated successfully.']);
            }
          CourseOutline::where('id', $courseOutline->id)->update([
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
     * @param  \App\Models\Carriculum\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseOutline $courseOutline)
    {
        try {
             CourseOutline::where('id', $courseOutline->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             CourseOutline::destroy($courseOutline->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'file.*' => 'file|mimes:ppt,pptx,doc,docx,pdf'
        ];
    }

    protected function update_rules() {
        return [
           'file.*' => 'file|mimes:ppt,pptx,doc,docx,pdf'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'Document must be of the following file type: pdf or docx.'
        ];
    }
}
