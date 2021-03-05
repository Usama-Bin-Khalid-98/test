<?php

namespace App\Http\Controllers;

use App\Models\social_responsibility\ComplaintResolution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ComplaintResolutionController extends Controller
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
        $resolutions = ComplaintResolution::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('social_responsibility.complaint_resolution',compact('resolutions'));
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
                    $imageName = Auth::user()->id . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/complaint_resolution';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    ComplaintResolution::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'date' => $request->date,
                        'complaint_desc' => $request->complaint_desc,
                        'arbitrating_authority' => $request->arbitrating_authority,
                        'solution' => $request->solution,
                        'file' => $path.'/'.$imageName, 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Complaint Resolution added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\social_responsibility\ComplaintResolution  $complaintResolution
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintResolution $complaintResolution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\social_responsibility\ComplaintResolution  $complaintResolution
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintResolution $complaintResolution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\social_responsibility\ComplaintResolution  $complaintResolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintResolution $complaintResolution)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=ComplaintResolution::find($complaintResolution->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = Auth::user()->id . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/complaint_resolution';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(ComplaintResolution::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                ComplaintResolution::where('id', $complaintResolution->id)->update(
                    [
                    'date' => $request->date,
                    'complaint_desc' => $request->complaint_desc,
                    'arbitrating_authority' => $request->arbitrating_authority,
                    'solution' => $request->solution,
                    'file' => $path.'/'.$imageName,
                    'isComplete' => $request->isComplete,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Complaint Resolution updated successfully.']);
            }
          ComplaintResolution::where('id', $complaintResolution->id)->update([
               'date' => $request->date,
               'complaint_desc' => $request->complaint_desc,
               'arbitrating_authority' => $request->arbitrating_authority,
               'solution' => $request->solution,
               'isComplete' => $request->isComplete,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Complaint Resolution updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\social_responsibility\ComplaintResolution  $complaintResolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintResolution $complaintResolution)
    {
        try {
             ComplaintResolution::where('id', $complaintResolution->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             ComplaintResolution::destroy($complaintResolution->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'date' => 'required',
            'complaint_desc' => 'required',
            'arbitrating_authority' => 'required',
            'solution' => 'required',
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'date' => 'required',
            'complaint_desc' => 'required',
            'arbitrating_authority' => 'required',
            'solution' => 'required',
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
