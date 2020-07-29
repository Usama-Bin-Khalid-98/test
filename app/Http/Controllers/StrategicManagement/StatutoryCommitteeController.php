<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\Common\Designation;
use App\Models\StrategicManagement\StatutoryBody;
use App\Models\StrategicManagement\StatutoryCommittee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;

class StatutoryCommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bodies = StatutoryBody::all();
        $designations = Designation::all();
        $statutory_committees = StatutoryCommittee::with('designation', 'statutory_body')->get();
        return view('strategic_management.statutory_committee', compact('bodies', 'designations', 'statutory_committees'));
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

            $path = ''; $fileName = '';
            if($request->file('file')) {
                $fileName = $request->name . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/statutory_committee';
                $diskName = env('DISK');
                $disk = Storage::disk($diskName);
                $request->file('file')->move($path, $fileName);

                StatutoryCommittee::create([
                    'campus_id' => Auth::user()->campus_id,
                    'statutory_body_id' => $request->statutory_body_id,
                    'name' => $request->name,
                    'designation_id' => $request->designation_id,
                    'date_first_meeting' => $request->date_first_meeting,
                    'date_second_meeting' => $request->date_second_meeting,
                    'date_third_meeting' => $request->date_third_meeting,
                    'date_fourth_meeting' => $request->date_fourth_meeting,
                    'file' => $path.'/'.$fileName,
                ]);

                return response()->json(['success' => 'Statutory committee added successfully.']);
            }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function show(StatutoryCommittee $statutoryCommittee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function edit(StatutoryCommittee $statutoryCommittee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatutoryCommittee $statutoryCommittee)
    {
        //
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
//            dd($fileName);
            $path = ''; $fileName = '';
            if($request->file('file')) {
                $fileName = $request->name . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/statutory_committee';
                $diskName = env('DISK');
                $disk = Storage::disk($diskName);
                $request->file('file')->move($path, $fileName);
            }
            StatutoryCommittee::where('id', $statutoryCommittee->id)->update([
                'statutory_body_id' => $request->statutory_body_id,
                'name' => $request->name,
                'designation_id' => $request->designation_id,
                'date_first_meeting' => $request->date_first_meeting,
                'date_second_meeting' => $request->date_second_meeting,
                'date_third_meeting' => $request->date_third_meeting,
                'date_fourth_meeting' => $request->date_fourth_meeting,
                'file' => $path.'/'.$fileName,
                'status' => $request->status
            ]);

            return response()->json(['success' => 'Statutory committee updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StatutoryCommittee  $statutoryCommittee
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatutoryCommittee $statutoryCommittee)
    {
        //
        try {
            StatutoryCommittee::destroy($statutoryCommittee->id);
            return response()->json(['success'=> 'Record deleted successfully']);
        }catch (Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    protected function rules() {
        return [
            'statutory_body_id' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
            'date_first_meeting' => 'required',
            'date_second_meeting' => 'required',
            'date_third_meeting' => 'required',
            'date_fourth_meeting' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048'
        ];
    }

    protected function update_rules() {
        return [
            'statutory_body_id' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
            'date_first_meeting' => 'required',
            'date_second_meeting' => 'required',
            'date_third_meeting' => 'required',
            'date_fourth_meeting' => 'required',
            'file.*' => 'required|file|mimetypes:application/msword,application/pdf|max:2048'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'CV must be of the following file type: pdf, doc or docx.'
        ];
    }
}
