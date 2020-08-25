
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.8. Managerial skills</caption>
                                <thead>
                                    <th>Main managerial skill</th>
                                    <th>Course title</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($managerialSkills as $data)
                                    <tr>
                                        <td>{{$data->skill}}</td>
                                        <td>{{$data->course_title}}</td>
                                     
                                    </tr>
                                    @endforeach
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>