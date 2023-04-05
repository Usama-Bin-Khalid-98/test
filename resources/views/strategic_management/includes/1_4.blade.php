
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 1.4. Business school’s statutory committees</caption>
                                <thead>
                                    <th>Body name</th>
                                    <th>Name and designation of Chairperson</th>
                                    <th colspan="4" >Dates of last four meetings</th>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Meeting 1</td>
                                        <td>Meeting 2</td>
                                        <td>Meeting 3</td>
                                        <td>Meeting 4</td>
                                    </tr>
                                    @foreach($statutoryCommitties as $data)
                                    <tr>
                                        <td>{{$data->statutoryName}}</td>
                                        <td>{{$data->name.": ".$data->designation}}</td>
                                        <td>{{$data->date_first_meeting}}</td>
                                        <td>{{$data->date_second_meeting}}</td>
                                        <td>{{$data->date_third_meeting}}</td>
                                        <td>{{$data->date_fourth_meeting}}</td>
                                    </tr>
                                   @endforeach

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
