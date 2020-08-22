<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\StrategicManagement\ContactInfo;
use App\Models\Common\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ContactInfoController extends Controller
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
        $designations = Designation::all();
        $ds_contacts = ContactInfo::with('designation')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id, 'designation_id'=> 2])
            ->get()->first();
        $hs_contacts = ContactInfo::with('designation')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id, 'designation_id'=> 1])
            ->get()->first();
        $fp_contacts = ContactInfo::with('designation')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id, 'designation_id'=> 3])
            ->get()->first();
        ///dd($contacts);
        return view('strategic_management.contact_info', compact('designations', 'ds_contacts', 'hs_contacts', 'fp_contacts'));
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
            $campus_id = auth()->user()->campus_id;
            $department_id = auth()->user()->department_id;
            $user_id = auth()->user()->id;
           // dd($check);

                if (!empty($request->ds_name)) {
                    $path = '';
                    $imageName = '';
                    $where = ['campus_id' => $campus_id,
                        'department_id' => $department_id,
                        'created_by' => $user_id,
                        'designation_id' => 2];
                    $existed = ContactInfo::where($where)
                        ->exists();
                    if ($existed) {
                        if ($request->file('ds_cv')) {
                            $imageName = $request->ds_name . "-cv-" . time() . '.' . $request->ds_cv->getClientOriginalExtension();
                            $path = 'uploads/cv';
                            $diskName = env('DISK');
                            $disk = Storage::disk($diskName);
                            $request->file('ds_cv')->move($path, $imageName);
                        }
                        //dd($request->all());
                        // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                        //dd($request->ds_name);
                        ContactInfo::where($where)->update([
                            'name' => $request->ds_name,
                            'email' => $request->ds_email,
                            'contact_no' => $request->ds_tell_off,
                            'school_contact' => $request->ds_tell_cell,
                            'job_title' => $request->ds_job_title,
                            'cv' => $path . '/' . $imageName,
                            'isComplete' => 'yes',
                            'updated_by' => auth()->user()->id,
                        ]);
                    } else {
                        if ($request->file('ds_cv')) {
                            $imageName = $request->ds_name . "-cv-" . time() . '.' . $request->ds_cv->getClientOriginalExtension();
                            $path = 'uploads/cv';
                            $diskName = env('DISK');
                            $disk = Storage::disk($diskName);
                            $request->file('ds_cv')->move($path, $imageName);
                        }
                        //dd($request->all());
                        // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                        //dd($request->ds_name);
                        ContactInfo::create([
                            'name' => $request->ds_name,
                            'email' => $request->ds_email,
                            'contact_no' => $request->ds_tell_off,
                            'school_contact' => $request->ds_tell_cell,
                            'designation_id' => 2,
                            'job_title' => $request->ds_job_title,
                            'cv' => $path . '/' . $imageName,
                            'isComplete' => 'yes',
                            'campus_id' => auth()->user()->campus_id,
                            'department_id' => auth()->user()->department_id,
                            'created_by' => auth()->user()->id,
                        ]);

                    }
                }

                if(!empty($request->hs_name)) {
                    $path = '';
                    $imageName = '';
                    $where = ['campus_id' => $campus_id,
                        'department_id' => $department_id,
                        'created_by' => $user_id,
                        'designation_id' => 1];
                    $existed = ContactInfo::where($where)
                        ->exists();
                    if ($existed) {
                        if ($request->file('hs_cv')) {
                            $imageName = $request->hs_name . "-cv-" . time() . '.' . $request->hs_cv->getClientOriginalExtension();
                            $path = 'uploads/cv';
                            $diskName = env('DISK');
                            $disk = Storage::disk($diskName);
                            $request->file('hs_cv')->move($path, $imageName);
                        }
                        //dd($request->all());
                        // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                        ContactInfo::where($where)->update([
                            'name' => $request->hs_name,
                            'email' => $request->hs_email,
                            'contact_no' => $request->hs_tell_off,
                            'school_contact' => $request->hs_tell_cell,
                            'job_title' => $request->hs_job_title,
                            'cv' => $path . '/' . $imageName,
                            'isComplete' => 'yes',
                            'updated_by' => auth()->user()->id,
                        ]);
                    } else {
                        if ($request->file('hs_cv')) {
                            $imageName = $request->hs_name . "-cv-" . time() . '.' . $request->hs_cv->getClientOriginalExtension();
                            $path = 'uploads/cv';
                            $diskName = env('DISK');
                            $disk = Storage::disk($diskName);
                            $request->file('hs_cv')->move($path, $imageName);
                        }
                        //dd($request->all());
                        // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                        ContactInfo::create([
                            'name' => $request->hs_name,
                            'email' => $request->hs_email,
                            'contact_no' => $request->hs_tell_off,
                            'school_contact' => $request->hs_tell_cell,
                            'designation_id' => 1,
                            'job_title' => $request->hs_job_title,
                            'cv' => $path . '/' . $imageName,
                            'isComplete' => 'yes',
                            'campus_id' => auth()->user()->campus_id,
                            'department_id' => auth()->user()->department_id,
                            'created_by' => auth()->user()->id,
                        ]);
                    }

                    if (!empty($request->fp_name)) {
                        $path = '';
                        $imageName = '';
                        $where = ['campus_id' => $campus_id,
                            'department_id' => $department_id,
                            'created_by' => $user_id,
                            'designation_id' => 3];
                        $existed = ContactInfo::where($where)
                            ->exists();
                        if ($existed) {
                            if ($request->file('fp_cv')) {
                                $imageName = $request->fp_name . "-cv-" . time() . '.' . $request->fp_cv->getClientOriginalExtension();
                                $path = 'uploads/cv';
                                $diskName = env('DISK');
                                $disk = Storage::disk($diskName);
                                $request->file('fp_cv')->move($path, $imageName);
                            }
                            //dd($request->all());
                            // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                            ContactInfo::where($where)->update([
                                'name' => $request->fp_name,
                                'email' => $request->fp_email,
                                'contact_no' => $request->fp_tell_off,
                                'school_contact' => $request->fp_tell_cell,
                                'job_title' => $request->fp_job_title,
                                'cv' => $path . '/' . $imageName,
                                'isComplete' => 'yes',
                                'updated_by' => auth()->user()->id,
                            ]);
                        }
                        else{
                            if ($request->file('fp_cv')) {
                                $imageName = $request->fp_name . "-cv-" . time() . '.' . $request->fp_cv->getClientOriginalExtension();
                                $path = 'uploads/cv';
                                $diskName = env('DISK');
                                $disk = Storage::disk($diskName);
                                $request->file('fp_cv')->move($path, $imageName);
                            }
                            //dd($request->all());
                            // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                            ContactInfo::create([
                                'name' => $request->fp_name,
                                'email' => $request->fp_email,
                                'contact_no' => $request->fp_tell_off,
                                'school_contact' => $request->fp_tell_cell,
                                'designation_id' => 3,
                                'job_title' => $request->fp_job_title,
                                'cv' => $path . '/' . $imageName,
                                'isComplete' => 'yes',
                                'campus_id' => auth()->user()->campus_id,
                                'department_id' => auth()->user()->department_id,
                                'created_by' => auth()->user()->id,
                            ]);
                        }
                    }

                    if ($request->file('fp_cv')) {
                        $imageName = $request->fp_name . "-cv-" . time() . '.' . $request->fp_cv->getClientOriginalExtension();
                        $path = 'uploads/cv';
                        $diskName = env('DISK');
                        $disk = Storage::disk($diskName);
                        $request->file('fp_cv')->move($path, $imageName);
                    }
                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    ContactInfo::create([
                        'name' => $request->fp_name,
                        'email' => $request->fp_email,
                        'contact_no' => $request->fp_tell_off,
                        'school_contact' => $request->fp_tell_cell,
                        'designation_id' => 2,
                        'job_title' => $request->fp_job_title,
                        'cv' => $path . '/' . $imageName,
                        'isComplete' => 'yes',
                        'campus_id' => auth()->user()->campus_id,
                        'department_id' => auth()->user()->department_id,
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }

                    return response()->json(['success' => 'Contact Information added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }


    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ContactInfo $contactInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactInfo $contactInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactInfo $contactInfo)
    {
        //
       // dd($request->all());
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $path = ''; $imageName = '';
            if($request->file('cv')) {
                $imageName = $request->name . "-cv-" . time() . '.' . $request->cv->getClientOriginalExtension();
                $path = 'uploads/cv';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('cv')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                ContactInfo::where('id', $contactInfo->id)->update(
                    [
                    'name' => $request->ds_name,
                    'email' => $request->email,
                    'contact_no' => $request->contact_no,
                    'school_contact' => $request->school_contact,
                    'designation_id' => $request->designation_id,
                    'focal_person' => $request->focal_person,
                    'cv' => $path.'/'.$imageName,
                    'updated_by' => auth()->user()->id
                    ]
                );

                return response()->json(['success' => 'Contact Information updated successfully.']);
            }
           ContactInfo::where('id', $contactInfo->id)->update([
               'name' => $request->name,
               'email' => $request->email,
               'contact_no' => $request->contact_no,
               'school_contact' => $request->school_contact,
               'designation_id' => $request->designation_id,
               'focal_person' => $request->focal_person,
               'status' => $request->status,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Contact Information updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactInfo $contactInfo)
    {
         try {
            ContactInfo::where('id', $contactInfo->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             ContactInfo::destroy($contactInfo->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'ds_name' => 'required',
            'ds_tell_off' => 'required',
            'ds_email' => 'required',
            'ds_tell_cell' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function update_rules() {
        return [
            'ds_name' => 'required',
            'ds_tell_off' => 'required',
            'ds_email' => 'required',
            'ds_tell_cell' => 'required',
            'file.*' => 'file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'CV must be of the following file type: pdf, doc or docx.'
        ];
    }
}
