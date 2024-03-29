<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\ObtainedInternship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class ObtainedInternshipController extends Controller
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

        $reports = ObtainedInternship::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('external_linkages.obtained_internships', compact('reports'));
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
//            dd($fileName);
                if(ObtainedInternship::where(['campus_id' => Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])->exists()){
                    return response()->json(['message'=> 'Internship Policy already exists.'], 422);
                }
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/obtained_internships';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    ObtainedInternship::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'file' => $path.'/'.$imageName,
                        'details'=> $request->details,
                        'isComplete' => 'yes',
                        'created_by' => Auth::user()->id
                ]);

                    return response()->json(['success' => 'Obtained Internship added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\ObtainedInternship  $obtainedInternship
     * @return \Illuminate\Http\Response
     */
    public function show(ObtainedInternship $obtainedInternship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\ObtainedInternship  $obtainedInternship
     * @return \Illuminate\Http\Response
     */
    public function edit(ObtainedInternship $obtainedInternship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\ObtainedInternship  $obtainedInternship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObtainedInternship $obtainedInternship)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $update=ObtainedInternship::find($obtainedInternship->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/obtained_internships';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(ObtainedInternship::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                ObtainedInternship::where('id', $obtainedInternship->id)->update(
                    [
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'details' => $request->edit_details,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Obtained Internship updated successfully.']);
            }
           ObtainedInternship::where('id', $obtainedInternship->id)->update([
               'status' => $request->status,
               'details' => $request->edit_details,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Obtained Internship updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\ObtainedInternship  $obtainedInternship
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObtainedInternship $obtainedInternship)
    {
        try {
             ObtainedInternship::where('id', $obtainedInternship->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             ObtainedInternship::destroy($obtainedInternship->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

     protected function rules() {
        return [
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
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
