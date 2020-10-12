<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\ParentInstitution;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class ParentInstitutionController extends Controller
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
        $parents = ParentInstitution::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('strategic_management.parent_institution', compact('parents'));
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


            $department_id = Auth::user()->department_id;

            $slip = Slip::where(['department_id'=> $department_id])->where('regStatus','SAR')->first();
                if($request->file('file')) {
                    $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/parent_institution';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    if($slip) {
                        ParentInstitution::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'file' => $path . '/' . $imageName,
                            'isComplete' => 'yes',
                            'type' => 'SAR',
                            'created_by' => Auth::user()->id
                        ]);
                    }else {
                        ParentInstitution::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'file' => $path . '/' . $imageName,
                            'isComplete' => 'yes',
                            'type' => 'REG',
                            'created_by' => Auth::user()->id
                        ]);
                    }


                    return response()->json(['success' => 'Document added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ParentInstitution  $parentInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(ParentInstitution $parentInstitution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ParentInstitution  $parentInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentInstitution $parentInstitution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\ParentInstitution  $parentInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentInstitution $parentInstitution)
    {
         $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=ParentInstitution::find($parentInstitution->id);

            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/parent_institution';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(ParentInstitution::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                ParentInstitution::where('id', $parentInstitution->id)->update(
                    [
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Document updated successfully.']);
            }
           ParentInstitution::where('id', $parentInstitution->id)->update([
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Document updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\ParentInstitution  $parentInstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentInstitution $parentInstitution)
    {
        try {
             ParentInstitution::where('id', $parentInstitution->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             ParentInstitution::destroy($parentInstitution->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
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
