<?php

namespace App\Http\Controllers;

use App\DocumentaryEvidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;
class DocumentaryEvidenceController extends Controller
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
        
        $reports = DocumentaryEvidence::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('admission_examination.documentary_evidence', compact('reports'));
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
                if(DocumentaryEvidence::where(['campus_id' => Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])->exists()){
                    return response()->json(['message'=> 'Evidence already exists.'], 422);
                }
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/documentary_evidence';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    DocumentaryEvidence::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => ' Documentary Evidence added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentaryEvidence  $documentaryEvidence
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentaryEvidence $documentaryEvidence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentaryEvidence  $documentaryEvidence
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentaryEvidence $documentaryEvidence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentaryEvidence  $documentaryEvidence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentaryEvidence $documentaryEvidence)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=DocumentaryEvidence::find($documentaryEvidence->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName =Auth::user()->id."-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/documentary_evidence';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(DocumentaryEvidence::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                DocumentaryEvidence::where('id', $documentaryEvidence->id)->update(
                    [
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Documentary Evidence updated successfully.']);
            }
           DocumentaryEvidence::where('id', $documentaryEvidence->id)->update([
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Documentary Evidence updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentaryEvidence  $documentaryEvidence
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentaryEvidence $documentaryEvidence)
    {
         try {
             DocumentaryEvidence::where('id', $documentaryEvidence->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             DocumentaryEvidence::destroy($documentaryEvidence->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
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
