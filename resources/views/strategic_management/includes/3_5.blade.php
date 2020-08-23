
<div class="box-body table-responsive">
                         <table class="table table-bordered table-striped">
                            <caption style="text-align: center;color: red">Table 3.5. Financial Assistance (in PKR) </caption>
                              <thead>
                                <tr>
                                  <th>Program under review</th>
                                  <th>Batch</th>
                                  <th>Enrollment in program
(A)
</th>
                                  <th>Tuition Revenue
(B)
</th>
                                  <th>Merit Scholarship 
(C)

                                  </th>
                                  <th>Need Scholarship
(D)

                                  </th>
                                  <th>Other Financial Assistance
(E)

                                  </th>
                                  <th>Total Financial Assistance
(F)

                                    </th>
                                    <th>Ratio of Financial Assistance
F/B

                                    </th>
                                </tr>
                              </thead>

                              <tbody>
                                    @foreach($studentsFinancial as $data)
                                    <tr>
                                      <td>{{$data->program}}</td>
                                      <td>{{$data->year}}</td>
                                      <td>{{$data->enrolment}}</td>
                                      <td>{{$data->tution}}</td>
                                      <td>{{$data->merit}}</td>
                                      <td>{{$data->need}}</td>
                                      <td>{{$data->other}}</td>
                                      <td>{{$data->total}}</td>
                                      <td>{{$data->total/$data->tution}}</td>
                                      
                                    </tr>
                                    @endforeach
                                

                              </tbody>
</table>
                          
                        </div>