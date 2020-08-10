
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 2.2. Program courses</caption>
                                <thead>
                                    <th>No.</th>
                                    <th>Course code and title</th>
                                    <th>Credit hours</th>
                                    <th>Prerequisite if any</th>
                                    
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td></td>
                                        <td><b>Core Courses</b></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    
                                    @foreach($programsCourses[1] as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$data->programName}}</td>
                                        <td>{{$data->credit_hours}}</td>
                                        <td>{{$data->preReq }}</td>
                                        
                                    </tr>
                                    @endforeach
                                   


                                    <tr>
                                        <td></td>
                                        <td><b>Support Courses</b></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    @foreach($programsCourses[2] as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$data->programName}}</td>
                                        <td>{{$data->credit_hours}}</td>
                                        <td>{{$data->preReq}}</td>
                                        
                                    </tr>
                                    @endforeach


                                     <tr>
                                        <td></td>
                                        <td><b>Elective Courses</b></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                      @foreach($programsCourses[3] as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$data->programName}}</td>
                                        <td>{{$data->credit_hours}}</td>
                                        <td>{{$data->preReq}}</td>
                                        
                                    </tr>
                                    @endforeach
                                        
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>