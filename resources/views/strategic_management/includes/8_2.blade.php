
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 8.2. List of MoUs of national and international linkages
</caption>
                                <thead>
                                    <th >S.no </th>
                                     <th style="text-align: center;" colspan="3">Partner institution details</th>
                                    <th style="text-align: center;" colspan="4">MoU details</th>

                                    
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Name</td>
                                        <td>Type</td>
                                        <td>Location</td>
                                        <td>Level</td>
                                        <td>Signing date</td>
                                        <td>Last activity date</td>
                                        <td>Last activity title</td>
                                       
                                    </tr>
                                    @foreach($linkages as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->type}}</td>
                                        <td>{{$data->location}}</td>
                                        <td>{{$data->level}}</td>
                                        <td>{{$data->signing_date}}</td>
                                        <td>{{$data->last_activity_date}}</td>
                                        <td>{{$data->last_activity_title}}</td>
                                       
                                    </tr>
                                    @endforeach
                                   
                                   
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>