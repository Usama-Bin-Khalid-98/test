<?php

namespace App\Http\Controllers;

use App\Models\social_responsibility\InternalCommunity;
use Illuminate\Http\Request;
use App\Models\social_responsibility\WelfareProgram;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class InternalCommunityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id= Auth::user()->department_id;
        $wps =  WelfareProgram::all();
        $communities = InternalCommunity::with('campus','welfare_program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('social_responsibility.internal_community', compact('wps','communities'));
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
                    $path = 'uploads/internal_communities_wp';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    InternalCommunity::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'welfare_program_id' => $request->welfare_program_id,
                        'no_of_individual_covered' => $request->no_of_individual_covered,
                        'file' => $path.'/'.$imageName, 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Internal Community Welfare Program added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\social_responsibility\InternalCommunity  $internalCommunity
     * @return \Illuminate\Http\Response
     */
    public function show(InternalCommunity $internalCommunity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\social_responsibility\InternalCommunity  $internalCommunity
     * @return \Illuminate\Http\Response
     */
    public function edit(InternalCommunity $internalCommunity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\social_responsibility\InternalCommunity  $internalCommunity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternalCommunity $internalCommunity)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $update=InternalCommunity::find($internalCommunity->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = Auth::user()->id . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/internal_communities_wp';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(InternalCommunity::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                InternalCommunity::where('id', $internalCommunity->id)->update(
                    [
                    'welfare_program_id' => $request->welfare_program_id,
                    'no_of_individual_covered' => $request->no_of_individual_covered,
                    'file' => $path.'/'.$imageName,
                    'isComplete' => $request->isComplete,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Internal Community WP updated successfully.']);
            }
           InternalCommunity::where('id', $internalCommunity->id)->update([
               'welfare_program_id' => $request->welfare_program_id,
               'no_of_individual_covered' => $request->no_of_individual_covered,
               'isComplete' => $request->isComplete,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Internal Community WP updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\social_responsibility\InternalCommunity  $internalCommunity
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternalCommunity $internalCommunity)
    {
         try {
             InternalCommunity::where('id', $internalCommunity->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             InternalCommunity::destroy($internalCommunity->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'welfare_program_id' => 'required',
            'no_of_individual_covered' => 'required',
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'welfare_program_id' => 'required',
            'no_of_individual_covered' => 'required',
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
