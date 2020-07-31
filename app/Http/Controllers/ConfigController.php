<?php

namespace App\Http\Controllers;

use App\CharterType;
use App\InstituteType;
use App\Models\Common\Department;
use Illuminate\Http\Request;
use App\Models\Common\CourseType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    protected $TableRows;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index($table)
    {
        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::all();

                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::all();
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::all();
                break;
            }
        }


        $TableRows = $this->TableRows;
        $counter = $this->counter();
        //dd($counter);
        $TableName = ucwords(str_replace('_',' ', $table));
//        dd();
        return view('config', compact('TableRows', 'TableName', 'counter'));
    }

    public function counter()
    {
        $counter = [];

        $CharterType= CharterType::all()->count();
        $counter['CharterType'] = $CharterType;

        $InstituteType= InstituteType::all()->count();
        $counter['InstituteType'] = $InstituteType;

        $Department= Department::all()->count();
        $counter['Department'] = $Department;


        return $counter;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $table)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());

        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::create($request->all());
                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::create($request->all());
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::create($request->all());
                break;
            }
        }



    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $table, $id)
    {
        //dd($request);

        $validation = Validator::make($request->all(), $this->rules(), $this->messages());

        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::find($id)->update($request->all());
                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::find($id)->update($request->all());
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::find($id)->update($request->all());
                break;
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $table)
    {
        //dd($request);

        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::find($id)->update($request->all());
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::find($id)->update($request->all());
                break;
            }
        }
        $request->destroy();
    }

    protected function rules() {
        return [ 'name' => 'required'];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }

}
