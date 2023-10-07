
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 5.1. Basic information of ORIC</caption>
                                <thead>
                                   
                                     
                                    
                                    
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($orics as $data)
                                    <tr>
                                        <td class="left">a) Year of establishment</td>
                                        <td>{{$data->year_establishment}}</td>
                                    </tr>

                                    <tr>
                                        <td class="left">b)  Head/supervisor of the research center</td>
                                        <td>{{$data->head}}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">c)  Qualification of the main  head/supervisor of research center</td>
                                        <td>{{$data->qualification}}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">d)  Head/Supervisor reports to</td>
                                        <td>{{$data->reports_to}}</td>
                                    </tr>
                                    @endforeach
                                  
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>