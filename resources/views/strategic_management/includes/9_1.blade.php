
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 9.1. Basic information of examination and admission offices</caption>
                                <thead>
                                  <tr>
                                      <th>Particulars</th>
                                      <th>Admission office</th>
                                      <th>Examination office</th>
                                  </tr>
                                     
                                </thead>
                                <tbody>
                                  @foreach($admissionOffices as $data) 
                                  <tr class="left">
                                        <td>a)  Hierarchical position</td>
                                        <td>{{$data->hierarchical_position}} </td>
                                        <td>{{$data->hierarchical_positionb}} </td>
                                    </tr> 
                                    <tr class="left">
                                        <td>i)  System handling</td>
                                        <td>{{$data->system_handling}} </td>
                                        <td>{{$data->system_handlingb}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>j)  Name & designation of  head/supervisor</td>
                                        <td>{{$data->head}} </td><td>{{$data->headb}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>k)  Qualification of head/supervisor</td>
                                        <td>{{$data->qualification}} </td>
                                        <td>{{$data->qualificationb}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>l)  Total number of staff members</td>
                                        <td>{{$data->total_staff}} </td>
                                         <td>{{$data->total_staffb}} </td>
                                    </tr>
                                    
                                    <tr class="left">
                                        <td>Number of printers</td>
                                        <td>{{$data->printers}} </td>
                                        <td>{{$data->printersb}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>Number of photocopiers</td>
                                        <td>{{$data->photocopiers}} </td>
                                        <td>{{$data->photocopiersb}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>Number of secure cabinets</td>
                                        <td>{{$data->secure_cabinets}} </td>
                                        <td>{{$data->secure_cabinetsb}} </td>
                                    </tr>
                                    @endforeach
                                     
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>