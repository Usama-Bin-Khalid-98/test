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

        $programs = Scope::with('program','level')->where($where)->get();
        $po_plos = [];
        foreach($programs as $program)
        {
            $getPLOs = LearningOutcome::with('program')
                ->where($where)
                ->where('program_id', $program->program->id)
                ->get();

            $getPOs = ProgramObjective::with('program')->where($where)
                ->where('program_id', $program->program->id)
                ->get();
            $po_plos[$program->program->id]['name'] = $program->program->name;
            foreach ($getPOs as $pokey=>$po){
                $po_plos[$program->program->id]['pos'][$po->id]['id'] = $po->id;
                $po_plos[$program->program->id]['pos'][$po->id]['campus_id'] = $po->campus_id;
                $po_plos[$program->program->id]['pos'][$po->id]['department_id'] = $po->department_id;
                foreach ($getPLOs as $key => $plo)
                {
                    $po_plos[$program->program->id]['pos'][$po->id]['plos']= $getPLOs[$pokey]->id;
                }
            }

        }
//        dd($po_plos);
            $mappings = MappingPos::where($where)->get();
//        dd($mappings);
        return view('registration.curriculum.mapping_pos', compact('programs', 'po_plos', 'mappings'));

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
        foreach ($request->plo_po as $program_id=>$map)
        {
            foreach ($map as $po_key=> $po)
            {
                foreach ($po as $plo_id => $p) {
                    foreach ($p as $keycol=>$checked) {
                        MappingPos::updateOrCreate(
                            [
                                'campus_id' => $request['campus_id'],
                                'department_id' => $request['department_id'],
                                'program_id' => $program_id,
                                'learning_outcome_id' => $plo_id,
                                'program_objective_id' => $po_key,
                                'col' => $keycol,
                                'isChecked' => $checked,
                                'isComplete' => 'yes',
                            ]);
                    }
                }
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
