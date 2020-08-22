
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 9.3. Student enrollment</caption>
                                <thead>
                                  <tr>
                                      <th>Program(s) under review</th>
                                      <th>Semester</th>
                                      <th> Applications received</th>
                                      <th>Admissions offered</th>
                                      <th>Student Intake</th>
                                      <th>Semester commencement date</th>
                                  </tr>
                                     
                                </thead>
                                <tbody>
                                    @foreach($applicationsReceived as $data)
                                 <tr>
                                     <td>{{$data->program}}</td>
                                     <td>{{$data->semester}}</td>
                                     <td>{{$data->app_received}}</td>
                                     <td>{{$data->admission_offered}}</td>
                                     <td>{{$data->student_intake}}</td>
                                     <td>{{$data->semester_comm_date}}</td>
                                 </tr>
                                 @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>