
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 6.3. List of environmental protection activities
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Date</th>
                                    <th>Activity description</th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($environmentalProtectionActivities as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->activity_desc}}</td>
                                    </tr>
                                     @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>