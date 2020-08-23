
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.9. Program delivery methods</caption>
                                <thead>
                                    <th>Teaching Method</th>
                                    <th>Course code and title</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($programDeliveryMethods as $data)
                                    <tr>
                                        <td>{{$data->teachingMethod}}</td>
                                        <td>{{$data->course_code}}{{": "}}{{$data->course_title}}</td>
                                     
                                    </tr>
                                    @endforeach
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>