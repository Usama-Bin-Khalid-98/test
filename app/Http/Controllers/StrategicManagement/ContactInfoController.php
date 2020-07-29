<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\StrategicManagement\ContactInfo;
use App\Models\Common\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $designations = Designation::all();
        $contacts = ContactInfo::with('designation')->get();
        ///dd($contacts);
        return view('strategic_management.contact_info', compact('designations', 'contacts'));
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
                if($request->file('cv')) {
                    $imageName = $request->name . "-cv-" . time() . '.' . $request->cv->getClientOriginalExtension();
                    $path = 'uploads/cv';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('cv')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    ContactInfo::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'contact_no' => $request->contact_no,
                        'school_contact' => $request->school_contact,
                        'designation_id' => $request->designation_id,
                        'focal_person' => $request->focal_person,
                        'cv' => $path.'/'.$imageName,
                        'campus_id' => auth()->user()->campus_id
                ]);

                    return response()->json(['success' => 'Contact Information added successfully.']);
                }

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
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact_no' => $request->contact_no,
                    'school_contact' => $request->school_contact,
                    'designation_id' => $request->designation_id,
                    'focal_person' => $request->focal_person,
                    'cv' => $path.'/'.$imageName,
                    'business_school_id' => auth()->user()->business_school_id
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
             ContactInfo::destroy($contactInfo->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'name' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'school_contact' => 'required',
            'designation_id' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048',
        ];
    }

    protected function update_rules() {
        return [
            'name' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'school_contact' => 'required',
            'designation_id' => 'required',
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
