
<div class="box-body table-responsive">
                         <table class="table table-bordered table-striped" style="width: 100%">
                            <caption style="text-align: center;color: red">Table 2.3. Applications received </caption>
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Program under review</th>
                                  <th>Year</th>
                                  <th>Semester</th>
                                  <th>Applications received</th>
                                  <th>Admissions offered</th>
                                  <th>Student Intake</th>
                                  <th>Semester commencement date</th>
{{--                                  <th>Degree awarding criteria/ requirement</th>--}}

                                </tr>
                              </thead>

                              <tbody>
                                  @foreach($applicationsReceived as $data)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td  >{{$data->programName}}</td>
                                      <td>{{$data->year}}</td>
                                      <td>{{@$data->semester}}</td>
                                      <td>{{$data->app_received}}</td>
                                     <td>{{$data->admission_offered}}</td>
                                      <td>{{$data->student_intake}}</td>
                                      <td>{{$data->semester_comm_date}}</td>
{{--                                       <td>{{@$data->degree_awarding_criteria}}</td>--}}


                                    </tr>
                                  @endforeach

                              </tbody>
</table>

                        </div>
