
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.2. Program courses</caption>
                                <thead>
                                    <th>No.</th>
                                    <th>Course code and title</th>
                                    <th>Credit hours</th>
                                    <th>Prerequisite if any</th>

                                </thead>
                                <tbody>

                                    <tr>
                                        <td></td>
                                        <td><b>Core course</b></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    @foreach($programCourses as $data)

                                    @if($data->courseTypeName=="Core")
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->title}} {{$data->code}}</td>
                                        <td>{{$data->credit_hours}}</td>
                                        <td>{{$data->prerequisite}}</td>

                                    </tr>
                                    @endif
                                    @endforeach


                                    <tr>
                                        <td></td>
                                        <td><b>Support course</b></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    @foreach($programCourses as $data)

                                    @if($data->courseTypeName=="Elective")
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->title }} {{$data->code}}</td>
                                        <td>{{$data->credit_hours}}</td>
                                        <td>{{$data->prerequisite}}</td>

                                    </tr>
                                    @endif
                                    @endforeach



                                     <tr>
                                        <td></td>
                                        <td><b>Electives</b></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                     @foreach($programCourses as $data)

                                    @if($data->courseTypeName=="Support")
                                    <tr>
                                        <td>{{@$loop->index+1}}</td>
                                        <td>{{@$data->title }} {{$data->code}}</td>
                                        <td>{{@$data->credit_hours}}</td>
                                        <td>{{@$data->prerequisite}}</td>

                                    </tr>
                                    @endif
                                    @endforeach



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
