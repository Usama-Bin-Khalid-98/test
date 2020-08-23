
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.6. Personal grooming and skill development activities</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Activity title</th>
                                    <th>Grooming skill in focus </th>
                                    <th>Number of participants</th>
                                </thead>
                                <tbody>
                                    @foreach($personalGroomings as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->activity_title}}</td>
                                        <td>{{$data->grooming_skill}}</td>
                                        <td>{{$data->total_participants}}</td>
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>