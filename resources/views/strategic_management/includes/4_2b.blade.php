
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 4.2b. Faculty workload (t-1)
</caption>
                                <thead>
                                    <th rowspan="2">No </th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Number of courses taught in all programs</th>
                                    <th style="text-align: center;" colspan="3">Number of students supervised</th>
                                    
                                    <th>Administrative responsibility</th>
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>PhD</td>
                                        <td>Masters</td>
                                        <td>Bachelors</td>
                                        <td></td>
                                     
                                     
                                    </tr><?php  ?>
                                    @foreach($facultyWorkLoadb as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->designationName}}</td>
                                        <td>{{$data->total_courses}}</td>
                                        <td>{{$data->phd}}</td>
                                        <td>{{$data->masters}}</td>
                                        <td>{{$data->bachleors}}</td>
                                        <td>{{$data->admin_responsibilities}}</td>
                                     
                                     
                                    </tr>
                                    @endforeach
                                     
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>