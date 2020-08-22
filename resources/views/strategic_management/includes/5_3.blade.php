
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 5.3. Details of research funding (in PKR)
</caption>
                                <thead>
                                    <th rowspan="2">Time </th>
                                    <th>University’s R&D budget allocation(A)</th>
                                    <th>Business school’s R&D budget allocation(B)</th>                                    
                                    <th style="text-align: center;" colspan="3">Funds secured by faculty</th>
                                    <th>Total R&D funds available to business school=B+C+D+E</th>
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Government grants(C)</td>
                                        <td> Corporate grants(D)</td>
                                        <td> International grants(E)</td>
                                        <td> </td>
                                         
                                     
                                     
                                    </tr>
                                    @foreach($researchFundings as $data)
                                     <tr>
                                        <td>{{$data->year}}</td>
                                        <td>{{$data->uni_budget}}</td>
                                        <td>{{$data->bs_budget}}</td>
                                        <td>{{$data->gov_grant}}</td>
                                        <td>{{$data->corp_grant}}</td>
                                        <td>{{$data->int_grant}}</td>
                                        <td>{{$data->total}}</td>
                                        
                                     
                                     
                                    </tr>
                                    @endforeach
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>