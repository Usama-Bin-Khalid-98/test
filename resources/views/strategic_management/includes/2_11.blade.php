
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.11. List of academic dishonesty and plagiarism cases</caption>
                                <thead>
                                    <th>Date of incident</th>
                                    <th>Initial of students</th>
                                    <th>Degree program</th>
                                    <th>Nature of dishonesty</th>
                                    <th>Penalty/consequences</th>
                                </thead>
                                <tbody>
                                    @foreach($plagiarismCases as $data)
                                    <tr>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->students_initial}}</td>
                                        <td>{{$data->degree}}</td>
                                        <td>{{$data->nature}}</td>
                                        <td>{{$data->penalty}}</td>
                                    </tr>
                                     @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>