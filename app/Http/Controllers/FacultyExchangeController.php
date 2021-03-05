<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\FacultyExchange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class FacultyExchangeController extends Controller
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
        $genders = FacultyExchange::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('external_linkages.faculty_exchange_program', compact('genders'));
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
                    $imageName = Auth::user()->id."file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/faculty_exchange';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    FacultyExchange::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'year' => $request->year,
                        'destination_country' => $request->destination_country,
                        'faculty_name' => $request->faculty_name,
                        'source_country' => $request->source_country,
                        'name_faculty' => $request->name_faculty,
                        'file' => $path.'/'.$imageName,
                        'isComplete' => 'yes',
                        'created_by' => Auth::user()->id
                ]);

                    return response()->json(['success' => 'Faculty  Exchange added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\FacultyExchange  $facultyExchange
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyExchange $facultyExchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\FacultyExchange  $facultyExchange
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyExchange $facultyExchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\FacultyExchange  $facultyExchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyExchange $facultyExchange)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=FacultyExchange::find($facultyExchange->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = Auth::user()->id . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/faculty_exchange';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(FacultyExchange::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                FacultyExchange::where('id', $facultyExchange->id)->update(
                    [
                    'year' => $request->year,
                        'destination_country' => $request->destination_country,
                        'faculty_name' => $request->faculty_name,
                        'source_country' => $request->source_country,
                        'name_faculty' => $request->name_faculty,
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Faculty Exchange updated successfully.']);
            }
           FacultyExchange::where('id', $facultyExchange->id)->update([
               'year' => $request->year,
                        'destination_country' => $request->destination_country,
                        'faculty_name' => $request->faculty_name,
                        'source_country' => $request->source_country,
                        'name_faculty' => $request->name_faculty,
               'status' => $request->status,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Faculty Exchange updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\FacultyExchange  $facultyExchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyExchange $facultyExchange)
    {
        try {
        FacultyExchange::where('id', $facultyExchange->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            FacultyExchange::destroy($facultyExchange->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'year' => 'required',
            'destination_country' => 'required',
            'faculty_name' => 'required',
            'source_country' => 'required',
            'name_faculty' => 'required',
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'year' => 'required',
            'destination_country' => 'required',
            'faculty_name' => 'required',
            'source_country' => 'required',
            'name_faculty' => 'required',
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
