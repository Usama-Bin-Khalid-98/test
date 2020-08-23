
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.10. Evaluation methods</caption>
                                <thead>
                                    <th>Items</th>
                                    <th>Frequency</th>
                                    <th>Range of marks</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($evaluationMethods as $data)
                                    <tr>
                                        <td>{{$data->evaluationItem}}</td>
                                        <td>{{$data->frequency}}</td>
                                        <td>{{$data->range}}</td>
                                     
                                    </tr>
                                    @endforeach
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>