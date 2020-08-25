
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.7. Indigenous and culturally relevant material</caption>
                                <thead>
                                    <th>Indigenous and culturally relevant material</th>
                                    <th>Course title</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($cultralMaterial as $data)
                                    <tr>
                                        <td>{{$data->cultural_material}}</td>
                                        <td>{{$data->course_title}}</td>
                                     
                                    </tr>
                                    @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>