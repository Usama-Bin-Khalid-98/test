
<div class="box-body table-responsive">
                         <table class="table table-bordered table-striped">
                            <caption style="text-align: center;color: red">Table 2.2. Entry requirements </caption>
                              <thead>
                                <tr>
                                  <th>Program under review</th>
                                  <th>Eligibility criteria </th>
                                  <th>Minimum requirements/relative weightage</th>
                                  
                                </tr>
                              </thead>

                              <tbody>
                                  @foreach($entryRequirements as $data)
                                    <tr>
                                      <td >{{$data->programName}}</td>
                                      
                                      <td>{{$data->eligibilityCriteria}}</td>
                                      <td>{{$data-> min_req}}</td>
                                     
                                       
                                      
                                    </tr>
                                  @endforeach 
                                   
                                
                                <!-- <tr>
                                    <tr>
                                      <td style="text-align: center;" rowspan="4">Program 2</td>
                                      <td rowspan="4"></td>
                                      <td>Core</td>
                                      <td></td>
                                      <td></td>
                                      
                                    </tr>
                                    <tr>
                                      <td>Elective </td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td>Support </td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td>Support </td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                </tr> -->

                              </tbody>
</table>
                          
                        </div>