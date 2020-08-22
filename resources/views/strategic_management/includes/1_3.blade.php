
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 1.3. Contact information</caption>
                                <thead>
                                    <th></th>
                                    <th>Dean of school</th>
                                    <th>Head of school</th>
                                    <th>Focal person for NBEAC</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $deanName = $deanJobTitle = $deanTelOff = $deanTelCell = $deanEmail = $headName = $headJobTitle = $headTelOff = $headTelCell = $headEmail = $focalName = $focalJobTitle = $focalTelOff = $focalTelCell = $focalEmail = '';
                                         
                                         
                                    ?>
                                    @foreach($contactInformation as $data)@if($data->designationName=='Dean of school')
                                        <?php
                                            $deanName = $data->name;
                                            $deanJobTitle = $data->designationName;
                                            $deanTelOff = $data->school_contact;
                                            $deanTelCell = $data->contact_no;
                                            $deanEmail = $data->email;
                                        ?>
                                    @endif

                                    @if($data->designationName=='Head of school')
                                        <?php
                                            $headName = $data->name;
                                            $headJobTitle = $data->designationName;
                                            $headTelOff = $data->school_contact;
                                            $headTelCell = $data->contact_no;
                                            $headEmail = $data->email;
                                        ?>
                                    @endif



                                    @if($data->designationName=='NBEAC focal person')
                                        <?php
                                            $focalName = $data->name;
                                            $focalJobTitle = $data->designationName;
                                            $focalTelOff = $data->school_contact;
                                            $focalTelCell = $data->contact_no;
                                            $focalEmail = $data->email;
                                        ?>
                                    @endif

                                    @endforeach
                                    <tr>
                                        <td>Name: </td>
                                        <td>{{$deanName}}</td>
                                        <td>{{$headName}}</td>
                                        <td>{{$focalName}}</td>
                                    </tr>
                                    <tr>
                                        <td>Job title: </td>
                                        <td>{{$deanJobTitle}}</td>
                                        <td>{{$headJobTitle}}</td>
                                        <td>{{$focalJobTitle}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tel (off): </td>
                                        <td>{{$deanTelOff}}</td>
                                        <td>{{$headTelOff}}</td>
                                        <td>{{$focalTelOff}}</td>
                                    </tr>
                                      <tr>
                                        <td>Tel (cell): </td>
                                        <td>{{$deanTelCell}}</td>
                                        <td>{{$headTelCell}}</td>
                                        <td>{{$focalTelCell}}</td>
                                    </tr>
                                      <tr>
                                        <td>Email:  </td>
                                        <td>{{$deanEmail}}</td>
                                        <td>{{$headEmail}}</td>
                                        <td>{{$focalEmail}}</td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>