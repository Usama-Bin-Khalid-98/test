
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 8.4a. Student exchange programs
</caption>
                                <thead>
                                    
                                     <th style="text-align: center;" colspan="2">Students outflow</th>
                                    <th style="text-align: center;" colspan="2">Students inflow</th>

                                    
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Destination country</td>
                                        <td>Name of student</td>
                                        <td>Source country</td>
                                        <td>Name of student</td>
                                    </tr>
                                     
                                    @foreach($studentsExchangePrograms as $data)
                                    <tr>
                                        <td>{{$data->destination_country}}</td>
                                        <td>{{$data->student_name}}</td>
                                        <td>{{$data->source_country}}</td>
                                        <td>{{$data->name_student}}</td>
                                        
                                       
                                    </tr>
                                    @endforeach
                                   
                                   
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>