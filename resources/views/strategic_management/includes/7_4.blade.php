
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 7.4. Basic information of QEC
</caption>
                                <thead>
                                     
                                    
                                                                         
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($qecInformation as $data)
                                    <tr class="left">
                                        <td>{{$data->qecName}}</td>
                                        <td>{{$data->level}} </td>
                                        
                                        
                                    </tr>
                                     @endforeach
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>