
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.7. Training/workshops organized by core business faculty</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Venue</th>
                                    <th>Title</th>
                                    <th>Name of faculty trainer</th>
                                    <th>No. of participants</th>
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyWorkshops as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->venue}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->faculty_trainer_name}}</td>
                                        <td>{{$data->participants}}</td>
                                       
                                       
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>