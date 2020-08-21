
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 8.5. Placement activities 
</caption>
                                <thead>
                                    <th >No.</th>
                                     <th>Date</th>
                                    <th>Title of activity </th>
                                    <th>Participating organizations</th>

                                    
                                </thead>
                                <tbody>
                                    
                                    @foreach($placementActivities as $data)
                                    <tr>
                                        
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->activity_title}}</td>
                                        <td>{{$data->org_participate}}</td>
                                        
                                       
                                        
                                    </tr>
                                    @endforeach
                                   
                                   
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>