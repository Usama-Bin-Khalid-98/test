
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.11 International faculty</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Faculty name</th>
                                    <th>International association</th>
                                    <th>Time periods (months)</th>
                                    
                                    
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($internationalFaculties as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->association}}</td>
                                        <td>{{$data->time_periods}}</td>
                                       
                                    </tr>
                                   @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>