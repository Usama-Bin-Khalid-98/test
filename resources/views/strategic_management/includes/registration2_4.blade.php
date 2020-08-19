
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.4. Application received</caption>
                                <thead>
                                    <th>Program(s) under review</th>
                                    <th>Degree awarding criteria/ requirement</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($applicationsReceived as $data)
                                    <tr>
                                        <td>{{$data->programName}} </td>
                                        <td>{{$data->degree_awarding_criteria}} </td>
                                     
                                    </tr>
                                    @endforeach
                                    
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>