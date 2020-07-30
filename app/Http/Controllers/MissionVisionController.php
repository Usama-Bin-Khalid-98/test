<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\MissionVision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class MissionVisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = MissionVision::with('campus')->get();

        return view('strategic_management.mission_vision',compact('missions'));
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
                    $imageName = $request->mission . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/mission_vision';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    MissionVision::create([
                        'campus_id' => Auth::user()->campus_id,
                        'mission' => $request->mission,
                        'vision' => $request->vision,
                        'file' => $path.'/'.$imageName 
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
    public function update(Request $request, MissionVision $missionVision)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = $request->mission . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/mission_vision';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                MissionVision::where('id', $missionVision->id)->update(
                    [
                    'mission' => $request->mission,
                    'vision' => $request->vision,
                    'file' => $path.'/'.$imageName,
                    'isComplete' => $request->isComplete,
                    'status' => $request->status
                    ]
                );

                return response()->json(['success' => 'Mission Vision updated successfully.']);
            }
           MissionVision::where('id', $missionVision->id)->update([
               'mission' => $request->mission,
               'vision' => $request->vision,
               'isComplete' => $request->isComplete,
               'status' => $request->status
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
    public function destroy(MissionVision $missionVision)
    {
         try {
             MissionVision::destroy($missionVision->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'mission' => 'required',
            'vision' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function update_rules() {
        return [
            'mission' => 'required',
            'vision' => 'required',
            'file.*' => 'file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'Document must be of the following file type: pdf, doc or docx.'
        ];
    }
}
