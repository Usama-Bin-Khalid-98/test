
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 3.1. Student enrolment</caption>
                                <thead>
                                    <th >Year <sup>4</sup></th>
                                    <th style="text-align: center;" colspan="3">Enrollment in all study programs</th>

                                </thead>
                                 <tbody>
                                    <tr>
                                        <td></td>
                                        <td>16 year programs
(A)
</td>
                                        <td>18 year programs
(B)
</td>
                                        <td>Doctoral programs
(C)
</td>


                                    </tr>
                                    <?php
                                    $pa=$pb=$pc=$pTotal=0;
                                    ?>
                                   @foreach($studentsEnrolment as $data)
                                   <?php
                                   $pa+=$data->bs_level;
                                   $pb+=$data->ms_level;
                                   $pc+=$data->phd_level;
                                   $pTotal+=$data->total_students;
                                   ?>
                                    <tr>
                                        <td>{{$data->year}}</td>
                                        <td>{{$data->bs_level}}</td>
                                        <td>{{$data->ms_level}}</td>
                                         <td>{{$data->phd_level}}</td>

                                    </tr>

                                   @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>Total</th>
                                    <th>{{$pa}}</th>
                                    <th>{{$pb}}</th>
                                    <th>{{$pc}}</th>
                                    </tr>
                                    <tr>
                                        <th>Grand Total</th>
                                        <th>{{$pTotal}}</th>
                                    </tr>
                                </tfoot>



                            </table>
                        </div>
