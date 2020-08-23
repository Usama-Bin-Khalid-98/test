
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.9. Alumni membership</caption>
                                <thead>
                                    <th>Total number of graduates</th>
                                    <th>Registered members of alumni association</th>
                                    <th>Membership percentage</th>
                                    <th>Major industries where alumni are placed</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($alumniMembership as $data)
                                    <tr>
                                        <td>{{$data->total_graduates}}</td>
                                        <td>{{$data->reg_members}}</td>
                                        <td>{{$data->membership_percentage}}</td>
                                        <td>{{$data->maj_industries}}</td>
                                       
                                    </tr>
                                     @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>