
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 5.8. R&D budget allocation for faculty development
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Name of beneficiary faculty member</th>
                                    <th>Description of training/workshop/conference</th>       
                                    <th>R&D fund spent (PKR)</th>                             
                                    
                                    
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach($facultyDevelopments as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>{{$data->fund_spent}}
                                           @php $total+=$data->fund_spent;@endphp</td>
                                    </tr>
                                     @endforeach

                                    <tr >
                                        <td colspan="3">Total R&D fund spent for faculty development</td>
                                        <td>{{$total}}</td>

                                    </tr>
                                    
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>