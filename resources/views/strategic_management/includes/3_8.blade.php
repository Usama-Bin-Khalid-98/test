
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.8. Extra-curricular and co-curricular activities</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Activity title</th>
                                    <th>Budget allocation</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($extraActivities as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->activity_title}}</td>
                                        <td>{{$data->budget_allocation}}</td>
                                       
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>