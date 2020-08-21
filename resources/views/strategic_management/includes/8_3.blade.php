
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 8.3. List of international participants of statutory body meetings
</caption>
                                <thead>
                                    <th >Participant name</th>
                                     <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Statutory body</th>

                                    <th>Meeting date</th>
                                    
                                </thead>
                                <tbody>
                                    
                                    @foreach($statutoryBodyMeetings as $data)
                                    <tr>
                                        
                                        <td>{{$data->participant_name}}</td>
                                        <td>{{$data->designation}}</td>
                                        <td>{{$data->affiliation}}</td>
                                        <td>{{$data->statutoryBody}}</td>
                                        <td>{{$data->meeting_date}}</td>
                                        
                                    </tr>
                                    @endforeach
                                   
                                   
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>