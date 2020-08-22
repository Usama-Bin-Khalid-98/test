
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 5.6. Top ten research outputs with impact
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Title of research publication</th>
                                    <th>Description of impact on real life and/or industry</th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($topTenResearchOutput as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->research}}</td>
                                        <td>{{$data->description}}</td>
                                    </tr>
                                   @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>