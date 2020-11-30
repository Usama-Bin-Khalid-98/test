
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
                                        $totalFTE1=$totalFTE2=$counter=$totalPrograms=0;
                                    @endphp
                                    @foreach($facultyTeachingCourses as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{@$data->name}}</td>
                                        <td>{{@$data->desName}}</td>
                                        <td>{{@$data->lookupFacultyType}}</td>
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
                                            $totalFTE2+=$programRow->tc_program/$data->max_cources_allowed;
                                            $totalPrograms+=$data->max_cources_allowed;
                                        @endphp
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td colspan="5">Total FTE</td>
                                        @if(!empty($data->faculty_program))
                                        @foreach(@$data->faculty_program as $program )
                                            <td>
                                                {{round($totalFTE2, 2)}}
                                            </td>
                                        @endforeach
                                        @endif
                                    </tr>

                                   @php

                                   View::share('VFE', $totalFTE2);
                                   @endphp



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
