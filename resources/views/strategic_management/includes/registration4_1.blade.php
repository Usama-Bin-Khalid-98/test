
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.1. Summary of business schools’ faculty</caption>
                                <thead>
                                    <th></th>
                                    @foreach($faculty_disciplines as $discipline)
                                    <th>{{$discipline}}</th>
                                    @endforeach
                                    <th>Total</th>
                                </thead>
                                @php
                                    $discipline_total = [];
                                    $grand_total = 0
                                @endphp
                                <body>
                                    @foreach($faculty_qualifications as $qualification=>$faculty_counts)
                                    @php
                                        $qualification_total = 0;
                                    @endphp
                                    <tr>
                                    <td>{{$qualification}}</td>
                                        @foreach($faculty_counts as $faculty_count)
                                        <td>{{$faculty_count}}</td>
                                        @php
                                            if(count($discipline_total) == $loop->index){
                                                $discipline_total[] = $faculty_count;
                                            }else{
                                                $discipline_total[$loop->index] += $faculty_count;
                                            }
                                            $qualification_total += $faculty_count;
                                            $grand_total += $faculty_count;
                                        @endphp
                                        @endforeach
                                        <td style="font-weight: bold;">{{$qualification_total}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td style="background-color: grey;color: white;">Total</td>
                                        @foreach($discipline_total as $total)
                                            <td style="font-weight: bold;">{{$total}}</td>
                                        @endforeach
                                        <td style="font-weight: bold;">{{$grand_total}}</td>
                                    </tr>
                                </body>
                                <tfoot></tfoot>
                            </table>
                        </div>
