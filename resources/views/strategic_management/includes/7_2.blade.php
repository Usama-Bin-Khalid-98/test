
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 7.2. Financial risks of the business school
</caption>
                                <thead>
                                    <th >Risk identified </th>
                                    <th>Stakeholders involved</th>
                                    <th>Remedial measures </th>
                                    
                                                                         
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($financialRisks as $data)
                                    <tr>
                                        <td>{{$data->risk_identified}}</td>
                                        <td>{{$data->stakeholder_involved}} </td>
                                        <td>{{$data->remedial_measure}}</td>
                                        
                                    </tr>
                                      @endforeach
                                    
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>