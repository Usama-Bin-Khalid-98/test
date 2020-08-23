
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.7. Counselling activity</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Counsellor’s name</th>
                                    <th>Counselling hours</th>
                                    <th>Counselling activity</th>
                                    <th>Number of students covered</th>
                                </thead>
                                <tbody>
                                    @foreach($counselingActivities as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->counsellor_name}}</td>
                                        <td>{{$data->counselling_hours}}</td>
                                        <td>{{$data->counselling_activity}}</td>
                                        <td>{{$data->students_covered}}</td>
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>