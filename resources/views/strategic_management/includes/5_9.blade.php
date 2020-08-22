
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 5.9. Conferences
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Conference title and theme</th>
                                    <th>Date</th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($conferences as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->conference}}</td>
                                        <td>{{$data->date}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>