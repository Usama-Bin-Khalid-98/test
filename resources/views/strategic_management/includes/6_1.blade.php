
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 6.1. Student clubs/societies</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Society/Club name</th>
                                    <th>Total members</th>
                                    <th>Number of members from business school</th>
                                    <th>Purpose </th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($studentsClubs as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->total_members}}</td>
                                         <td>{{$data->no_of_members}}</td>
                                        <td>{{$data->purpose}}</td>
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>