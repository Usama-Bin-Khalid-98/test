
<div class="box-body table-responsive">
                         <table class="table table-bordered table-striped">
                            <caption style="text-align: center;color: red">Table 3.4. Average success percentage and drop-out Percentage </caption>
                              <thead>
                                <tr>
                                  <th>Program under review</th>
                                  <th>Batch</th>
                                  <th>Intake of the passing out batch
                                  (A)</th>
                                  <th>Dropped out due to academic reasons(B)</th>
                                  <th>Dropped out due to any other  reasons
                                  (C)
                                  </th>
                                  <th>Passed out already
                                  (D)
                                  </th>
                                  <th>Pending to pass out
                                  (E)
                                  </th>
                                  <th>Success percentage
                                    =(D+E)/A*100
                                    </th>
                                    <th>Dropout percentage
                                    =B/A*100
                                    </th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                
                                ?>
                                @foreach($dropoutPercentage as $data)
                                <tr>
                                    <tr>
                                      <td >{{$data->program}}</td>
                                      
                                      <td>{{$data->year}}</td>
                                      <td>{{$data->intake}}</td>
                                      <td>{{$data->academic_reason}}</td>
                                      <td>{{$data->other_reason}}</td>
                                      <td>{{$data->pass}}</td>
                                      <td>{{$data->pending}}</td>
                                      <td>{{($data->pass+$data->pending)/$data->intake*100}} %</td>
                                      <td>{{$data->academic_reason/$data->intake*100}} %</td>
                                      
                                    </tr>
                                    
                                    @endforeach
                              
                              </tbody>
</table>
                          
                        </div>