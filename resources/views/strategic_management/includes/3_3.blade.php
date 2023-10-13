
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.3. Class size</caption>
                                <thead>
                                    <th>Semesters</th>
                                    @foreach($classSize['programs'] as $program)
                                        <th>{{$program}}</th>
                                    @endforeach
                                </thead>
                                <tbody>
                                    @foreach($classSize['sizes'] as $key=>$data)
                                    <tr>
                                        <td>{{$key}}</td>
                                        @foreach($classSize['programs'] as $program)
                                            <td>{{$data[$program] ?? 0}}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>