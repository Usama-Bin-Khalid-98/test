<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\LearningOutcome;
use App\Models\Carriculum\MappingPos;
use App\Models\Carriculum\ProgramObjective;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MappingPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userInfo = Auth::user();
        $where = ['campus_id' =>$userInfo->campus_id,
            'department_id'=> $userInfo->department_id,
            'status'=> 'active'];

        $programs = Scope::with('program')->where($where)->where(['type'=> 'SAR'])->get();
        $getPLOs = LearningOutcome::with('program')
                ->where($where)
//                ->where('program_id', $program->program->id)
                ->get();
        $getPOs = ProgramObjective::with('program')->where($where)->get();
            $mappings = MappingPos::where($where)->get();
//dd($mappings);
        return view('registration.curriculum.mapping_pos', compact('programs', 'getPLOs', 'getPOs', 'mappings'));

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
        $userInfo = Auth::user();
        foreach ($request->plo_po as $plo_po_key=>$plo_po)
        {
            $program_id = $plo_po_key;
            foreach ($plo_po as $plo_key=> $plo)
            {
//dd($plo_key);
                $plo_id = $plo_key;
//                foreach ($plo as $po_key=> $po)
//                {
//                    dd($po);
////                    dd($po[$po_key]);
//                    foreach ($po as $p) {
                        $insertMapping = MappingPos::create(
                            [
                                'campus_id' => $userInfo->campus_id,
                                'department_id' => $userInfo->department_id,
                                'program_id' => $program_id,
                                'learning_outcome_id' => $plo_id,
//                                'program_objective_id' => $po_key,
                                'isChecked' => $plo
                            ]);
//                    }

//                }

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carriculum\MappingPos  $mappingPos
     * @return \Illuminate\Http\Response
     */
    public function show(MappingPos $mappingPos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carriculum\MappingPos  $mappingPos
     * @return \Illuminate\Http\Response
     */
    public function edit(MappingPos $mappingPos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carriculum\MappingPos  $mappingPos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MappingPos $mappingPos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carriculum\MappingPos  $mappingPos
     * @return \Illuminate\Http\Response
     */
    public function destroy(MappingPos $mappingPos)
    {
        //
    }
}
