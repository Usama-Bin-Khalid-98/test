
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 3.3. Class size</caption>
                                <thead>
                                    <th>Semesters</th>
                                    <th>Program (1)</th>
                                    <th>Program (2)</th>
                                     
                                </thead>
                                <tbody>
                                    @foreach($classSize as $data)
                                    <tr>
                                        <td>Fall t</td>
                                        <td>{{$data->fallA}}</td>
                                        <td>{{$data->fallB}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td> Spring  t</td>
                                        <td>{{$data->springA}}</td>
                                        <td>{{$data->springB}}</td>
                                         
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>