<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\Linkages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class LinkagesController extends Controller
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
        $genders = Linkages::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('external_linkages.linkages', compact('genders'));
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
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName = "file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/linkages';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    Linkages::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'name' => $request->name,
                        'type' => $request->type,
                        'location' => $request->location,
                        'level' => $request->level,
                        'signing_date' => $request->signing_date,
                        'last_activity_date' => $request->last_activity_date,
                        'last_activity_title' => $request->last_activity_title,
                        'file' => $path.'/'.$imageName,
                        'isComplete' => 'yes',
                        'created_by' => Auth::user()->id
                ]);

                    return response()->json(['success' => 'Linkages added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\Linkages  $linkages
     * @return \Illuminate\Http\Response
     */
    public function show(Linkages $linkages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\Linkages  $linkages
     * @return \Illuminate\Http\Response
     */
    public function edit(Linkages $linkages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\Linkages  $linkages
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
                $imageName = $request->mission . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/linkages';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                Linkages::where('id', $id)->update(
                    [
                    'name' => $request->name,
                        'type' => $request->type,
                        'location' => $request->location,
                        'level' => $request->level,
                        'signing_date' => $request->signing_date,
                        'last_activity_date' => $request->last_activity_date,
                        'last_activity_title' => $request->last_activity_title,
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Linkages updated successfully.']);
            }
           Linkages::where('id', $id)->update([
               'name' => $request->name,
                        'type' => $request->type,
                        'location' => $request->location,
                        'level' => $request->level,
                        'signing_date' => $request->signing_date,
                        'last_activity_date' => $request->last_activity_date,
                        'last_activity_title' => $request->last_activity_title,
               'status' => $request->status,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Linkages updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\Linkages  $linkages
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
        Linkages::where('id', $id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            Linkages::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
            'level' => 'required',
            'signing_date' => 'required',
            'last_activity_date' => 'required',
            'last_activity_title' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function update_rules() {
        return [
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
            'level' => 'required',
            'signing_date' => 'required',
            'last_activity_date' => 'required',
            'last_activity_title' => 'required',
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
