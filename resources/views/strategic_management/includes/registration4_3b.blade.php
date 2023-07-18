
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">
Table 4.3b Visiting Faculty Equivalent (VFE) in program(s)
</caption>
                                <thead>
                                    <th >No </th>
                                    <th>Faculty name(A)</th>
                                    <th>Designation(B)</th>
                                    <th>Maximum teaching courses allowed(C)</th>

                                    <th style="text-align: center;" colspan="4">Program(s) under Review</th>



                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @foreach($facultyTeachingCourses4b as $req)
                                        @foreach($req->faculty_program as $program )
                                            <th> Teaching courses in {{$program->program->name}}:</th>
                                        @endforeach
                                        @break
                                    @endforeach
                                </tr>
                                @php
                                    $totalProgramVFE = [];
                                    $programVFE = [];
                                @endphp
                                @foreach($facultyTeachingCourses4b as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{@$data->name}}</td>
                                        <td>{{@$data->designation->name}}</td>
{{--                                        <td>{{@$data->lookupFacultyType}}</td>--}}
                                        <td>{{$data->max_cources_allowed}}</td>
                                        @foreach($data->faculty_program as $program )
                                            @php
                                                if(array_key_exists($program->program->name, $programVFE)){
                                                    if($data->max_cources_allowed>0){
                                                        array_push($programVFE[$program->program->name], round($program->tc_program / $data->max_cources_allowed, 2));
                                                    }else{
                                                        array_push($programVFE[$program->program->name], $program->tc_program);
                                                    }
                                                }else{
                                                    if($data->max_cources_allowed>0){
                                                        $programVFE[$program->program->name] = [round($program->tc_program / $data->max_cources_allowed, 2)];

                                                    }else{
                                                        $programVFE[$program->program->name] = [$program->tc_program];
                                                    }
                                                }
                                            @endphp
                                            <td>
                                                Courses : {{$program->tc_program}} <br>
                                                FTE  {{round($program->tc_program/$data->max_cources_allowed, 2)}}
                                            </td>
                                        @endforeach
                                        {{--                                        <td>{{number_format((float)$data->tc_program1/$data->max_cources_allowed, 3, '.', '')}}</td>--}}
                                        {{--                                        <td>{{number_format((float)$data->tc_program2/$data->max_cources_allowed, 3, '.', '')}}</td>--}}
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td colspan="4" align="center">Total VFE</td>
                                        @if(!empty($data->faculty_program))
                                            @foreach($data->faculty_program as $program )
                                            <td>
                                                {{round(array_sum($programVFE[$program->program->name]) / 3, 2)}}
                                                @php
                                                    $totalProgramVFE[$program->program->name] = round(array_sum($programVFE[$program->program->name]) / 3, 2);
                                                @endphp
                                            </td>
                                            @endforeach
                                        @endif
                                    </tr>

                                    @php

                                        View::share('VFE', $totalProgramVFE);
                                    @endphp



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
