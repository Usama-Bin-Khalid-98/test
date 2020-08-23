
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.10. Alumni participation</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Activity engagement</th>
                                    <th>Number of alumni participated</th>
                                    <th>Major input</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($alumniParticipation as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->activity}}</td>
                                        <td>{{$data->alumni_participated}}</td>
                                        <td>{{$data->major_input}}</td>
                                       
                                    </tr>
                                    @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>