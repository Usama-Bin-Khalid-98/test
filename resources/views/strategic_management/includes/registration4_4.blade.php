
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.4. Student to teacher ratio</caption>
                                <thead>
                                    <th>Program(s) under review</th>
                                    <th>Total enrollment (B)</th>
                                    <th>Total FTE(C)</th>
                                    <th>Total VFE(D)</th>
                                    <th>Student to teacher ratio=B/(C+D)</th>

                                </thead>
                                <tbody>
{{--                                @if($studentTeachersRatio)--}}
{{--                                    @foreach(@$studentTeachersRatio as $data)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$data->programName}}</td>--}}
{{--                                        <td>{{$data->total_enrollments}}</td>--}}
{{--                                        <td>{{number_format((float)$FTE, 3, '.', '')}}</td>--}}
{{--                                        <td>{{number_format((float)$VFE, 3, '.', '')}}</td>--}}
{{--                                        <td>--}}
{{--                                            <?php--}}
{{--                                            if($FTE+$VFE==0)--}}
{{--                                                echo "0";else{--}}
{{--                                            ?>{{number_format((float)$data->total_enrollments/$FTE+$VFE, 3, '.', '')}}--}}
{{--                                            <?php } ?>--}}
{{--                                        </td>--}}


{{--                                    </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}

                                    @foreach($ratios as $req)
                                        <tr>
                                            <td>{{$req->program->name}}</td>
                                            <td>{{$req->total_enrollments}}</td>
                                            <td>{{$totalFTE}}</td>
                                            <td>{{$totalVFE}}</td>
                                            <td>{{$totalFTE+$totalVFE!=0 ?(round($req->total_enrollments/($totalFTE+$totalVFE), 2)):0}}%</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
