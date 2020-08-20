
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 8.4b. Faculty exchange programs
</caption>
                                <thead>
                                    
                                     <th style="text-align: center;" colspan="2">Faculty  outflow</th>
                                    <th style="text-align: center;" colspan="2">Faculty  inflow</th>

                                    
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Destination country</td>
                                        <td>Name of Name of faculty</td>
                                        <td>Source country</td>
                                        <td>Name of faculty</td>
                                    </tr>
                                     
                                    @foreach($facultyExchangePrograms as $data)
                                    <tr>
                                        <td>{{$data->destination_country}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->source_country}}</td>
                                        <td>{{$data->name_faculty}}</td>
                                        
                                       
                                    </tr>
                                    @endforeach
                                   
                                   
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>