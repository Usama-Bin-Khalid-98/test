<?php

namespace App\Http\Controllers;

use App\AdmissionOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class AdmissionOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;

            $admission_office = AdmissionOffice::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get()->first();

        return view('admission_examination.admission_office',compact('admission_office'));
        }catch (\Exception $e) {
            return $e->getMessage();
        }
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
                    $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/admission_office';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    AdmissionOffice::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'hierarchical_position' => $request->hierarchical_position,
                        'system_handling' => $request->system_handling,
                        'head' => $request->head,
                        'qualification' => $request->qualification,
                        'total_staff' => $request->total_staff,
                        'printers' => $request->printers,
                        'photocopiers' => $request->photocopiers,
                        'secure_cabinets' => $request->secure_cabinets,
                        'hierarchical_positionb' => $request->hierarchical_positionb,
                        'system_handlingb' => $request->system_handlingb,
                        'headb' => $request->headb,
                        'qualificationb' => $request->qualificationb,
                        'total_staffb' => $request->total_staffb,
                        'printersb' => $request->printersb,
                        'photocopiersb' => $request->photocopiersb,
                        'secure_cabinetsb' => $request->secure_cabinetsb,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Admission Office added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdmissionOffice  $admissionOffice
     * @return \Illuminate\Http\Response
     */
    public function show(AdmissionOffice $admissionOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdmissionOffice  $admissionOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(AdmissionOffice $admissionOffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdmissionOffice  $admissionOffice
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
            AdmissionOffice::where('id', $id)->update([
                'hierarchical_position' => $request->hierarchical_position,
                        'system_handling' => $request->system_handling,
                        'head' => $request->head,
                        'qualification' => $request->qualification,
                        'total_staff' => $request->total_staff,
                        'printers' => $request->printers,
                        'photocopiers' => $request->photocopiers,
                        'secure_cabinets' => $request->secure_cabinets,
                        'hierarchical_positionb' => $request->hierarchical_positionb,
                        'system_handlingb' => $request->system_handlingb,
                        'headb' => $request->headb,
                        'qualificationb' => $request->qualificationb,
                        'total_staffb' => $request->total_staffb,
                        'printersb' => $request->printersb,
                        'photocopiersb' => $request->photocopiersb,
                        'secure_cabinetsb' => $request->secure_cabinetsb,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Admission Office updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdmissionOffice  $admissionOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdmissionOffice $admissionOffice)
    {
        //
    }

    protected function rules() {
        return [
            'hierarchical_position' => 'required',
            'system_handling' => 'required',
            'head' => 'required',
            'qualification' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'hierarchical_position' => 'required',
            'system_handling' => 'required',
            'head' => 'required',
            'qualification' => 'required',
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
