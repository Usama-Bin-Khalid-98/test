
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">
Table 4.3a FTE for the permanent, regular and adjunct faculty in program(s)
</caption>
                                <thead>
                                    <th >No </th>
                                    <th>Faculty name(A)</th>
                                    <th>Designation(B)</th>
                                    <th>Faculty type(C)</th>
                                    <th>Maximum teaching courses allowed(E)</th>
                                    <th style="text-align: center;" colspan="4">Program(s) under Review</th>



                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @foreach($facultyTeachingCourses as $req)
                                            @foreach($req->faculty_program as $program )
                                                <th>Teaching courses in  {{$program->program->name}}:</th>
                                            @endforeach
                                            @break
                                        @endforeach
                                    </tr>
                                    @php
                                        $totalProgramFTE = [];
                                        $arr = [];
                                    @endphp
                                    @foreach($facultyTeachingCourses as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{@$data->name}}</td>
                                        <td>{{@$data->designation->name}}</td>
                                        <td>{{@$data->lookup_faculty_type->faculty_type}}</td>
                                        <td>{{@$data->max_cources_allowed}}</td>
                                        @foreach($data->faculty_program as $program )
                                            <td>
                                                Courses : {{$program->tc_program}} <br>
                                                FTE  {{round($program->tc_program/@$data->max_cources_allowed, 2)}}
                                            </td>
                                        @endforeach
{{--                                        <td>{{number_format((float)$data->tc_program1/$data->max_cources_allowed, 3, '.', '')}}</td>--}}
{{--                                        <td>{{number_format((float)$data->tc_program2/$data->max_cources_allowed, 3, '.', '')}}</td>--}}

                                        @php
                                        foreach (@$data->faculty_program as $programRow)
                                            if(empty($arr)){
                                                $arr[$programRow->program->name] = [round($programRow->tc_program/$data->max_cources_allowed, 2)];
                                            }else{
                                                if(array_key_exists($programRow->program->name,$arr)){
                                                    array_push($arr[$programRow->program->name],round($programRow->tc_program/$data->max_cources_allowed, 2));
                                                }else{
                                                    $arr[$programRow->program->name] = [round($programRow->tc_program/$data->max_cources_allowed, 2)];   
                                                }
                                            }
                                        @endphp
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td colspan="5">Total FTE</td>
                                        @foreach($arr as $key=>$program_total)
                                            <td>Program Total: {{array_sum($program_total)}}</td>
                                            @php
                                            $totalProgramFTE[$key] = array_sum($program_total);
                                            @endphp
                                        @endforeach
                                    </tr>

                                   @php

                                   View::share('FTE', $totalProgramFTE);
                                   @endphp



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
