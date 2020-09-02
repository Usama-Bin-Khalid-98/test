<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\EvaluationMethod;
use App\Models\Carriculum\EvaluationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;

class EvaluationMethodController extends Controller
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
        $items = EvaluationItem::all();
        $methods = EvaluationMethod::with('evaluation_items')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        return view('registration.curriculum.evaluation_method', compact('items','methods'));
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
            //$data = $request;
//            dd($request->file('file1'));
          for($i =0; $i<=count(@$request->all()); $i++)
          {
//              dd($data->statutory_body_id[$i]);
//              dd($request[$i]['name']);

            $path = ''; $fileName = '';
            //dd('file'.$i+1);
              if(@$request->file('file'.intval( $i+1))) {
                 //dd('image path here....', $request->file('file'.intval( $i+1)));
                  $fileIndex = 'file'.intval( $i+1);
                  $fileName = $request->frequency[$i] . "-file-" . time() . '.' . $request->$fileIndex->getClientOriginalExtension();
                  //dd($request->name[$i]);
                  $path = 'uploads/evaluation_method';
                  $diskName = env('DISK');
                  $disk = Storage::disk($diskName);
                  $request->file('file'.intval( $i+1))->move($path, $fileName);
//                dd($request->file('file'));
                  //dd($request->file());
              }
             // dd('here');
              if(@$request->frequency[$i]) {
                  EvaluationMethod::create([
                      'evaluation_items_id' => $request->evaluation_items_id[$i],
                      'campus_id' => Auth::user()->campus_id,
                      'department_id' => Auth::user()->department_id,
                      'frequency' => $request->frequency[$i],
                      'range' => $request->range[$i],
                      'file' => $path . '/' . $fileName,
                      'isComplete' => 'yes',
                      'created_by' => Auth::user()->id
                  ]);
              }
            //}
            }
                return response()->json(['success' => 'Record added successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
                $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/evaluation_method';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                EvaluationMethod::where('id', $id)->update(
                    [
                        'evaluation_items_id' => $request->evaluation_items_id,
                      'frequency' => $request->frequency,
                      'range' => $request->range,
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Record updated successfully.']);
            }
           EvaluationMethod::where('id', $id)->update([
                        'evaluation_items_id' => $request->evaluation_items_id,
                      'frequency' => $request->frequency,
                      'range' => $request->range,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
             EvaluationMethod::where('id', $id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             EvaluationMethod::destroy($id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }


    protected function rules() {
        return [
            'frequency' => 'required',
            'range' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'evaluation_items_id' => 'required',
            'frequency' => 'required',
            'range' => 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'CV must be of the following file type: pdf or docx.'
        ];
    }
}
