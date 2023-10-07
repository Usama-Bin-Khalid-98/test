
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.1(b). Detailed information of business schools’ faculty </caption>
                                <thead>
                                    <th>No</th>
                                    <th>Name/ <br>
                                        CNIC
                                        </th>
                                    <th>Designation / <br> Faculty type </th>
                                    <th>Academic degree/ <br>
                                        Specialization
                                        </th>
                                    <th>Degree awarding institution/ <br>
                                    Country
                                    </th>
                                    <th>Teaching course type</th>
                                    <th>Experience in higher
                                        education/ <br>
                                        industry
                                        </th>
                                        <th>Current job duration (years)</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyDetailedInfos as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->name}}{{"/ "}} <br>
                                        {{$data->cnic}}
                                        </td>
                                        <td>{{$data->designation}}{{"/ "}} <br> {{$data->facultyType}}
                                        </td>
                                        <td>{{$data->degree}}/ <br> {{$data->specialization}}
                                        </td>
                                        <td>{{$data->awarding_institute}}/ <br> {{$data->country}}
                                        </td>
                                        <td>{{$data->courseType}}</td>
                                        <td>{{$data->hec_experience}}/ <br> {{$data->industry}}
                                        </td>
                                       <td>{{$data->current_job_duration}}</td>
                                    </tr>
                                    @endforeach
                                       
                                      </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>