
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 3.3. Student gender mix</caption>
                                <thead>
                                    <th>Program(s) under review</th>
                                    <th>Male (%)</th>
                                    <th>Female (%)</th>
                                     
                                </thead>
                                <tbody>
                                    @foreach($studentsGenders as $data)
                                    <tr>
                                        <td>{{$data->programName}} </td>
                                        <td>{{$data->male}} </td>
                                        <td>{{$data->female}} </td>
                                        
                                    </tr>
                                    @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>