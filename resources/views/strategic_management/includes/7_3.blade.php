
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 7.3. Administrative/support staff
</caption>
                                <thead>
                                    <th >Category</th>
                                    <th>Total number of staff members</th>
                                    <th>Qualification of head/supervisor</th>
                                    
                                                                         
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($supportStaff as $data)
                                    <tr>
                                        <td>{{$data->staffCategory}}</td>
                                        <td>{{$data->total_staff}} </td>
                                        <td>{{$data->supervisor_qualification}}</td>
                                        
                                    </tr>
                                     @endforeach
                                    
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>