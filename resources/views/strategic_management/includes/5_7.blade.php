
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 5.7. Role of R&D in curriculum
</caption>
                                <thead>
                                    <th >No. </th>
                                    <th>Title of research publication</th>
                                    <th>Course title</th>                                    
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($curriculumRoles as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$data->research_publication}}</td>
                                        <td>{{$data->course_title}}</td>
                                    </tr>
                                   @endforeach
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>