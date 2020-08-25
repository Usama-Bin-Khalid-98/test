<?php

namespace App\Http\Controllers;

use App\AlumniMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class AlumniMembershipController extends Controller
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
        $memberships = AlumniMembership::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('registration.student_enrolment.alumni_membership', compact('memberships'));
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
                    $path = 'uploads/alumni_membership';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    AlumniMembership::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'total_graduates' => $request->total_graduates,
                        'reg_members' => $request->reg_members,
                        'membership_percentage' => $request->membership_percentage,
                        'maj_industries' => $request->maj_industries,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Alumni Membership added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AlumniMembership  $alumniMembership
     * @return \Illuminate\Http\Response
     */
    public function show(AlumniMembership $alumniMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AlumniMembership  $alumniMembership
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumniMembership $alumniMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AlumniMembership  $alumniMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlumniMembership $alumniMembership)
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
                $path = 'uploads/alumni_membership';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                AlumniMembership::where('id', $alumniMembership->id)->update(
                    [
                        'total_graduates' => $request->total_graduates,
                        'reg_members' => $request->reg_members,
                        'membership_percentage' => $request->membership_percentage,
                        'maj_industries' => $request->maj_industries,
                    'file' => $path.'/'.$imageName,
                    'isComplete' => $request->isComplete,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Alumni Membership updated successfully.']);
            }
           AlumniMembership::where('id', $alumniMembership->id)->update([
                        'total_graduates' => $request->total_graduates,
                        'reg_members' => $request->reg_members,
                        'membership_percentage' => $request->membership_percentage,
                        'maj_industries' => $request->maj_industries,
               'isComplete' => $request->isComplete,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Alumni Membership updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AlumniMembership  $alumniMembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumniMembership $alumniMembership)
    {
         try {
             AlumniMembership::where('id', $alumniMembership->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             AlumniMembership::destroy($alumniMembership->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'total_graduates' => 'required',
            'reg_members' => 'required',
            'membership_percentage' => 'required',
            'maj_industries' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function update_rules() {
        return [
            'total_graduates' => 'required',
            'reg_members' => 'required',
            'membership_percentage' => 'required',
            'maj_industries' => 'required',
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
