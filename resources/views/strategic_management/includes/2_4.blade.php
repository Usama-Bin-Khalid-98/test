
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.4. Program Objectives (PO)</caption>
                                <thead>
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($programObjectives as $data)
                                    <tr>
                                        <td>{{$data->po_name}}</td>
                                        <td>{{$data->program}}</td>
                                        <td>{{$data->po}}</td>
                                     
                                    </tr>
                                     @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>