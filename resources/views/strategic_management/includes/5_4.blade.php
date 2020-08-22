
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 5.4. Details of research projects
</caption>
                                <thead>
                                    <th >Project title</th>
                                    <th>Start & end dates 
                                    (mm-yy/mm-yy)
                                    </th>
                                    <th>Principal investigator</th>                                    
                                    <th >Funding agency</th>
                                    <th>Funding amount  (PKR)</th>
                                     
                                    
                                </thead>
                                <tbody>
                                    @foreach($researchProjects as $data)
                                    <tr>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->start_date}}/{{$data->end_date}}</td>
                                        <td>{{$data->investigator}}</td>
                                        <td>{{$data->funding_agency}}</td>
                                        <td>{{$data->amount}} </td>
                                    </tr>
                                    @endforeach
                                      
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>