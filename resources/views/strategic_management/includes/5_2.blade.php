
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 5.2. Basic information of research centers</caption>
                                <thead>
                                   
                                    
                                    
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($researchCenters as $data)
                                    <tr class="left">
                                        <td >a)  Name of research center</td>
                                        <td>{{$data->research_center}}</td>
                                    </tr>
                                    <tr class="left">
                                        <td>b)  Hierarchical position</td>
                                        <td>{{$data->hierarchical_position}}</td>
                                    </tr>
                                    <tr class="left">
                                        <td>c)  Year of  establishment </td>
                                        <td>
                                           {{$data->year_establishment}}
                                        </td>
                                    </tr>
                                    <tr class="left">
                                        <td>d)  Head/supervisor of research center</td>
                                        <td>{{$data->head}}
                                        </td>
                                    </tr>
                                    <tr class="left">
                                        <td>e)  Qualification of head/supervisor of research center</td>
                                        <td>{{$data->qualification}}</td>
                                    </tr>
                                    <tr class="left">
                                        <td>f)  Head/Supervisor reports to</td>
                                        <td>{{$data->reports_to}}</td>
                                    </tr>
                                    <tr class="left">
                                        <td>g)  Research committee composition</td>
                                        <td>{{$data->composition}}</td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>