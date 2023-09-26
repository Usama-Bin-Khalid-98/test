
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 3.2. Graduated students</caption>
                                <thead>
                                    <th>Program(s) under review</th>
                                    <th>{{@$getYear->year_t_2}}</th>
                                    <th>{{@$getYear->year_t_1}}</th>
                                    <th>{{@$getYear->tyear}}</th>

                                </thead>
                                <tbody>
                                    @foreach(@$graduatedStudents as $data)
                                    <tr>
                                        <td>{{@$data->programName}}</td>
                                        <td>{{@$data->grad_std_t_2}}</td>
                                        <td>{{@$data->grad_std_t_1}}</td>
                                        <td>{{@$data->grad_std_t}}</td>

                                    </tr>
                                    @endforeach


                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
