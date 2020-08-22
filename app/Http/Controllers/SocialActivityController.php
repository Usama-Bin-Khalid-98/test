<?php

namespace App\Http\Controllers;

use App\Models\social_responsibility\SocialActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class SocialActivityController extends Controller
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
        
        $reports = SocialActivity::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('social_responsibility.social_activity', compact('reports'));
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
                    $path = 'uploads/social_activity';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    SocialActivity::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Social Activity added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\social_responsibility\SocialActivity  $socialActivity
     * @return \Illuminate\Http\Response
     */
    public function show(SocialActivity $socialActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\social_responsibility\SocialActivity  $socialActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialActivity $socialActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\social_responsibility\SocialActivity  $socialActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialActivity $socialActivity)
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
                $path = 'uploads/social_activity';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                SocialActivity::where('id', $socialActivity->id)->update(
                    [
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Social Activity updated successfully.']);
            }
           SocialActivity::where('id', $socialActivity->id)->update([
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Social Activity updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\social_responsibility\SocialActivity  $socialActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialActivity $socialActivity)
    {
        try {
             SocialActivity::where('id', $socialActivity->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             SocialActivity::destroy($socialActivity->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function update_rules() {
        return [
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
