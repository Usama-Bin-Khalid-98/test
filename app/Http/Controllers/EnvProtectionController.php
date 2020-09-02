<?php

namespace App\Http\Controllers;

use App\Models\social_responsibility\EnvProtection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class EnvProtectionController extends Controller
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
        $envs = EnvProtection::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('social_responsibility.env_protection',compact('envs'));
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
                    $imageName = $request->activity_desc . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/env_protection';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    EnvProtection::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'date' => $request->date,
                        'activity_desc' => $request->activity_desc,
                        'file' => $path.'/'.$imageName, 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Environmental Protection added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\social_responsibility\EnvProtection  $envProtection
     * @return \Illuminate\Http\Response
     */
    public function show(EnvProtection $envProtection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\social_responsibility\EnvProtection  $envProtection
     * @return \Illuminate\Http\Response
     */
    public function edit(EnvProtection $envProtection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\social_responsibility\EnvProtection  $envProtection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnvProtection $envProtection)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = $request->activity_desc . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/env_protection';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                EnvProtection::where('id', $envProtection->id)->update(
                    [
                    'date' => $request->date,
                    'activity_desc' => $request->activity_desc,
                    'file' => $path.'/'.$imageName,
                    'isComplete' => $request->isComplete,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Environmental Protection updated successfully.']);
            }
           EnvProtection::where('id', $envProtection->id)->update([
               'date' => $request->date,
               'activity_desc' => $request->activity_desc,
               'isComplete' => $request->isComplete,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Environmental Protection updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\social_responsibility\EnvProtection  $envProtection
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnvProtection $envProtection)
    {
        try {
             EnvProtection::where('id', $envProtection->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             EnvProtection::destroy($envProtection->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'date' => 'required',
            'activity_desc' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'date' => 'required',
            'activity_desc' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'Document must be of the following file type: pdf, doc or docx.'
        ];
    }
}
