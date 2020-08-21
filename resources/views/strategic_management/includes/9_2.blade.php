
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 9.2. Entry requirements</caption>
                                <thead>
                                  <tr>
                                      <th>Program(s) under review</th>
                                      <th>Eligibility criteria </th>
                                      <th> Minimum requirements/relative weightage</th>
                                  </tr>
                                     
                                </thead>
                                <tbody>
                                    @foreach($entryRequirements as $data)
                                 <tr>
                                     <td>{{$data->program}}</td>
                                     <td>{{$data->eligibilityCriteria}}</td>
                                     <td>{{$data->min_req}}</td>
                                 </tr>
                                 @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>