
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 4.4. Student to teacher ratio</caption>
                                <thead>
                                    <th>Program(s) under review</th>
                                    <th>Total enrollment (B)</th>
                                    <th>Total FTE(C)</th>
                                    <th>Total VFE(D)</th>
                                    <th>Student to teacher ratio=B/(C+D)</th>

                                </thead>
                                <tbody>
                                @if($studentTeachersRatio)
                                    @foreach(@$studentTeachersRatio as $data)
                                    <tr>
                                        <td>{{$data->programName}}</td>
                                        <td>{{$data->total_enrollments}}</td>
                                        <td>{{number_format((float)$FTE, 3, '.', '')}}</td>
                                        <td>{{number_format((float)$VFE, 3, '.', '')}}</td>
                                        <td>{{number_format((float)@$data->total_enrollments/@$FTE+@$VFE, 3, '.', '')}}</td>


                                    </tr>
                                    @endforeach
                                @endif


                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
