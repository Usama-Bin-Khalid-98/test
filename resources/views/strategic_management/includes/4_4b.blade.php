
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 4.4b Visiting Faculty Equivalent (VFE) in program(s)  
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

                                        <td>Teaching courses in program 1
(D)
</td>
                                        <td>Teaching courses in program 2
 (E)
</td>
                                        <td>No. of faculty teaching program 1
F=∑(D/C)
</td>
                                        <td>No. of faculty teaching program 2 G=∑(E/C)</td>
                                    </tr>
                                     @php
                                    $totalFTE1=$totalFTE2=0;
                                    @endphp
                                    @foreach($facultyTeachingCourses as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->desName}}</td>
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
                                        <td colspan="7">Total VFE</td>
                                        <td>={{number_format((float)($totalFTE1+$totalFTE2)/3, 3, '.', '')}}</td>
                                        @php
                                        $VFE=($totalFTE1+$totalFTE2)/3;
                                        View::share('VFE', ($totalFTE1+$totalFTE2)/3);
                                        @endphp
                                    </tr>





                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>