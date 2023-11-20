
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 4.4. Student to teacher ratio</caption>
                                <thead>
                                    <th>Program(s) under review</th>
                                    <th>Total enrollment (B)</th>
                                    <th>Total FTE(C)</th>
                                    <th>Total VFE(D)</th>
                                    <th>Student to teacher ratio=B/(C+D)</th>

                                </thead>
                                <tbody>
                                    @foreach($ratios as $req)
                                        <tr>
                                            <td>{{$req->program->name}}</td>
                                            <td>{{$req->total_enrollments}}</td>
                                            <td>{{isset($byProgramFTE[$req->program_id]) ? $byProgramFTE[$req->program_id] : ""}}</td>
                                            <td>{{isset($byProgramVFE[$req->program_id]) ? round($byProgramVFE[$req->program_id]/3, 2) : ""}}</td>
                                            <td>{{(isset($byProgramFTE[$req->program_id],$byProgramVFE[$req->program_id]) && $byProgramFTE[$req->program_id]+$byProgramVFE[$req->program_id] !=0) ?(round($req->total_enrollments/($byProgramFTE[$req->program_id]+round($byProgramVFE[$req->program_id]/3, 2)), 2)):0}}%</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
