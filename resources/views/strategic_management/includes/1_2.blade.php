
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped" style="width: 100%">
                                <caption style="text-align: center;color: red">Table 1.2. Scope of accreditation</caption>
                                <thead>
                                    <th>Degree Program</th>
                                    <th>Level (Graduate/Undergraduate)</th>
                                    <th>Program Commencement Date</th>
                                </thead>
                                <tbody>
                                    @foreach($scopeOfAcredation as $data)
                                    <tr>
                                        <td>{{$data->programName}}</td>
                                        <td>{{$data->levelName}}</td>
                                        <td>{{$data->date_program}}</td>
                                    </tr>
                                   @endforeach

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
