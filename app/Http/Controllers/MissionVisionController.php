<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\StrategicManagement\MissionVision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class MissionVisionController extends Controller
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
        $get = MissionVision::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get()->first();
        return view('strategic_management.mission_vision',compact('get'));
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
                    $imageName = Auth::user()->id."file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/mission_vision';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                    MissionVision::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'mission' => $request->mission,
                        'vision' => $request->vision,
                        'file' => $path.'/'.$imageName,
                        'mission_url' => $request->mission_url,
                        'isComplete' => 'yes',
                        'mission_approval' => $request->mission_approval,
                        'vision_approval' => $request->vision_approval,
                        'created_by' => Auth::user()->id
                    ]);
                    return response()->json(['success' => 'Mission Vision added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\MissionVision  $missionVision
     * @return \Illuminate\Http\Response
     */
    public function show(MissionVision $missionVision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\MissionVision  $missionVision
     * @return \Illuminate\Http\Response
     */
    public function edit(MissionVision $missionVision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\MissionVision  $missionVision
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

            $update=MissionVision::find($id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = Auth::user()->id . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/mission_vision';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(MissionVision::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                MissionVision::where('id', $id)->update(
                    [
                    'mission' => $request->mission,
                    'vision' => $request->vision,
                    'file' => $path.'/'.$imageName,
                    'mission_approval' => $request->mission_approval,
                    'vision_approval' => $request->vision_approval,
                    'mission_url' => $request->mission_url,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Mission Vision updated successfully.']);
            }
           MissionVision::where('id', $id)->update([
               'mission' => $request->mission,
               'vision' => $request->vision,
               'mission_approval' => $request->mission_approval,
               'vision_approval' => $request->vision_approval,
               'mission_url' => $request->mission_url,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Mission Vision updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\MissionVision  $missionVision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MissionVision $missionVision)
    {
         try {
             MissionVision::where('id', $missionVision->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             MissionVision::destroy($missionVision->id);
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
