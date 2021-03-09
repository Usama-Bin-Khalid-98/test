<?php

namespace App\Http\Controllers;

use App\Models\facility\QecInfo;
use Illuminate\Http\Request;
use App\Models\Facility\QecType;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class QecInfoController extends Controller
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
         $wps =  QecType::all();
        $qecs = QecInfo::with('campus','qec_type')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('registration.facilities_information.qec_info', compact('wps','qecs'));
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
                    $imageName = $request->level . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/qec_infos';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    QecInfo::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'qec_type_id' => $request->qec_type_id,
                        'level' => $request->level,
                        'file' => $path.'/'.$imageName,
                        'isComplete' => 'yes',
                        'created_by' => Auth::user()->id
                ]);

                    return response()->json(['success' => 'Qec Info added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facility\QecInfo  $qecInfo
     * @return \Illuminate\Http\Response
     */
    public function show(QecInfo $qecInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\facility\QecInfo  $qecInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(QecInfo $qecInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\facility\QecInfo  $qecInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QecInfo $qecInfo)
    {
         $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            $update=QecInfo::find($qecInfo->id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName = $request->level . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/qec_infos';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(QecInfo::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                QecInfo::where('id', $qecInfo->id)->update(
                    [
                   'qec_type_id' => $request->qec_type_id,
                    'level' => $request->level,
                    'file' => $path.'/'.$imageName,
                    'isComplete' => $request->isComplete,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id
                    ]
                );

                return response()->json(['success' => 'Qec Info updated successfully.']);
            }
           QecInfo::where('id', $qecInfo->id)->update([
               'qec_type_id' => $request->qec_type_id,
               'level' => $request->level,
               'isComplete' => $request->isComplete,
               'status' => $request->status,
               'updated_by' => Auth::user()->id
           ]);
            return response()->json(['success' => 'Qec Info updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\facility\QecInfo  $qecInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(QecInfo $qecInfo)
    {
         try {
             QecInfo::where('id', $qecInfo->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             QecInfo::destroy($qecInfo->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'qec_type_id' => 'required',
            'level' => 'required',
            'file.*' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'qec_type_id' => 'required',
            'level' => 'required',
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
