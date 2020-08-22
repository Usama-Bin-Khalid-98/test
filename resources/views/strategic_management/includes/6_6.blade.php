
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 6.6. Internal community welfare programs
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Internal community welfare program</th>
                                    <th>Number of individual covered</th>
                                    
                                                                         
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($internalCommunityWelfareProgram as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td class="left">{{$data->welfareProgram}}</td>
                                        <td>{{$data->no_of_individual_covered}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>