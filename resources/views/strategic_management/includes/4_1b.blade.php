
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.1(b). Detailed information of business schools’ faculty </caption>
                                <thead>
                                    <th>No</th>
                                    <th>Name/
                                        CNIC
                                        </th>
                                    <th>Designation / Faculty type </th>
                                    <th>Academic degree/
                                        Specialization
                                        </th>
                                    <th>Degree awarding institution/
                                    Country
                                    </th>
                                    <th>Teaching course type</th>
                                    <th>Experience in higher
                                        education/
                                        industry
                                        </th>
                                        <th>Current job duration (years)</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyDetailedInfos as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->name}}{{"/ "}}
                                        {{$data->cnic}}
                                        </td>
                                        <td>{{$data->designation}}{{"/ "}}{{$data->facultyType}}
                                        </td>
                                        <td>{{$data->degree}}
                                        </td>
                                        <td>{{$data->awarding_institute}}
                                        </td>
                                        <td>{{$data->courseType}}</td>
                                        <td>{{$data->hec_experience}}
                                        </td>
                                       <td>{{$data->current_job_duration}}</td>
                                    </tr>
                                    @endforeach
                                       
                                      </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>