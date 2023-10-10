<?php

namespace App\Http\Controllers;

use App\Models\Faculty\FacultyPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class FacultyPromotionController extends Controller
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
        
        $reports = FacultyPromotion::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        
        return view('registration.faculty.faculty_promotion', compact('reports'));
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
                if(FacultyPromotion::where(['campus_id' => Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])->exists()){
                    return response()->json(['message'=> 'Faculty promoion already exists.'], 422);
                }
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/faculty_promotion';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    FacultyPromotion::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => ' Recordadded successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyPromotion  $facultyPromotion
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyPromotion $facultyPromotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyPromotion  $facultyPromotion
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyPromotion $facultyPromotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\FacultyPromotion  $facultyPromotion
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

            $update=FacultyPromotion::find($id);
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/faculty_promotion';
                $diskName = env('DISK');
                Storage::disk($diskName);
                if(FacultyPromotion::exists($update->file)){
                    unlink($update->file);
               }
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                FacultyPromotion::where('id', $id)->update(
                    [
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Record updated successfully.']);
            }
           FacultyPromotion::where('id', $id)->update([
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
     * @param  \App\Models\Faculty\FacultyPromotion  $facultyPromotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
             FacultyPromotion::where('id', $id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             FacultyPromotion::destroy($id);
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
