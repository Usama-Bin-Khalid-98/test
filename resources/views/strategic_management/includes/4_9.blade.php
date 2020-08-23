
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.9. Faculty participation in social and corporate organizations</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Faculty name</th>
                                    <th>Social/Corporate organization</th>
                                    <th>Title of activity</th>
                                    
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyParticipations as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->organization}}</td>
                                        <td>{{$data->title}}</td>
                                        
                                       
                                       
                                       
                                    </tr>
                                   @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>