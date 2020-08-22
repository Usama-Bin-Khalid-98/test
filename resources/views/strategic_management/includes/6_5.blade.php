n
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 6.5. Complaint resolution
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Date</th>
                                    <th>Complaint description</th>
                                    <th>Arbitrating authority</th>
                                    <th>Solution</th>
                                                                         
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($complaintResolution as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->complaint_desc}}</td>
                                        <td>{{$data->arbitrating_authority}}</td>
                                        <td>{{$data->solution}}</td>
                                    </tr>
                                     @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>