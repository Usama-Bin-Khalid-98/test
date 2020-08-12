
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 4.5. Faculty stability</caption>
                                <thead>
                                    <th>Year</th>
                                    <th>Total faculty</th>
                                    <th>Resigned</th>
                                    <th>Retired</th>
                                    <th>Terminated</th>
                                    <th>New induction</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyStability as $data)
                                    <tr>
                                        <td>{{$data->year}}</td>
                                        <td>{{$data->total_faculty}} </td>
                                        <td>{{$data->resigned}} </td>
                                        <td>{{$data->retired}} </td>
                                        <td> {{$data->terminated}}</td>
                                        <td>{{$data->new_induction}}</td>
                                       
                                       
                                    </tr>
                                   @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>