
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.8. Consultancy projects of core business faculty</caption>
                                <thead>
                                    <th>No</th>
                                    <th>Name of faculty</th>
                                    <th>Name of project</th>
                                    <th>Name of client</th>
                                    <th>Start and end date mm/yy-mm/yy</th>
                                    <th>Name of all partners in the project</th>
                                  
                                    
                                </thead>
                                <tbody>
                                    @foreach($facultyConsultancyProjects as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->faculty_name}}</td>
                                        <td>{{$data->project_name}}</td>
                                        <td>{{$data->client_name}}</td>
                                        <td>{{$data->start_date}}{{"/ "}}{{$data->end_date}}</td>
                                        <td>{{$data->all_participants}}</td>
                                       
                                       
                                       
                                    </tr>
                                   @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>