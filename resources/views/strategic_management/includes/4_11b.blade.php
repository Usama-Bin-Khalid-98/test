
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.11 International faculty</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Faculty name</th>
                                    <th>Activity title</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyExposures as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->activity}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->duration}}</td>
                                    </tr>
                                    @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>