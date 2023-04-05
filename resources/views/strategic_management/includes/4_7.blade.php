
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.7. Training/workshops organized by core business faculty</caption>
                                <thead>
                                    <th>No</th>
                                    <th>No. of faculty with terminal degree (foreign institutions)</th>
                                    <th>No. of faculty with terminal degree (domestic institutions)</th>
                                    <th>No. of faculty with international work experience</th>
                                  
                                    
                                </thead>
                                <tbody>
                                    @isset($facultyDegree)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$facultyDegree->faculty_foreign}}</td>
                                        <td>{{$facultyDegree->faculty_domestic}}</td>
                                        <td>{{$facultyDegree->faculty_international}}</td>
                                    </tr>
                                    @endisset
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>