
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 6.4. List of formal relationships
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Name of organization</th>
                                    <th>Title of MoU</th>
                                    <th>Date of signing MoU</th>
                                    <th>Date of last activity</th>
                                    <th>Description of last activity</th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($formalRelationships as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->org_name}}</td>
                                        <td>{{$data->mou_title}}</td>
                                        <td>{{$data->signing_mou_date}}</td>
                                        <td>{{$data->last_activity_date}}</td>
                                        <td>{{$data->last_activity_desc}}</td>
                                    </tr>
                                     @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>