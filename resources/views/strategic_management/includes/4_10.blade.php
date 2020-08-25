
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.10. Professional memberships of core business faculty</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Name of faculty</th>
                                    <th>Membership organization</th>
                                    <th>Valid since (year)</th>
                                    <th>Valid till (years)</th>
                                    
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyMemberships as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->organization}}</td>
                                        <td>{{$data->from}}</td>
                                        <td>{{$data->to}}</td>
                                        
                                       
                                       
                                       
                                    </tr>
                                   @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>