
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 6.2. Project details
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Date</th>
                                    <th>Title of activity/project</th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($projectDetails as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->activity_title}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>