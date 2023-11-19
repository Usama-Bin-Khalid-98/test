
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 2.4. Degree awarding criteria</caption>
                                <thead>
                                    <th>No.</th>
                                    <th>Program(s) under review</th>
                                    <th>Degree awarding criteria/ requirement</th>

                                </thead>
                                <tbody>
                                    @foreach($app_Received as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->programName}} </td>
                                        <td>{!!$data->degree_awarding_criteria!!} </td>

                                    </tr>
                                    @endforeach



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
