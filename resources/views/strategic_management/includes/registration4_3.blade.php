
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">
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
                                        <td>Teaching courses in program 1(F)</td>
                                        <td>Teaching courses in program 2 (G)</td>
                                        <td>FTE for program 1=F/E</td>
                                        <td>FTE for program 2=G/E</td>
                                    </tr>
                                    @php
                                    $totalFTE1=$totalFTE2=0;
                                    @endphp
                                    @foreach($facultyTeachingCourses as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{@$data->name}}</td>
                                        <td>{{@$data->desName}}</td>
                                        <td>{{@$data->lookupFacultyType}}</td>
                                        <td>{{$data->   max_cources_allowed}}</td>
                                        <td>{{$data->tc_program1}}</td>
                                        <td>{{$data->tc_program2}}</td>
                                        <td>{{number_format((float)$data->tc_program1/$data->max_cources_allowed, 3, '.', '')}}</td>
                                        <td>{{number_format((float)$data->tc_program2/$data->max_cources_allowed, 3, '.', '')}}</td>

                                        @php
                                        $totalFTE1+=$data->tc_program1/$data->max_cources_allowed;
                                        $totalFTE2+=$data->tc_program2/$data->max_cources_allowed;
                                        @endphp
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="7">Total FTE</td>
                                        <td>{{$totalFTE1}}</td>
                                        <td>{{$totalFTE2}}</td>
                                    </tr>

                                   @php

                                   View::share('FTE', $totalFTE1+$totalFTE2);
                                   @endphp



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
