
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.5. Program Learning Outcomes (PLO)</caption>
                                <thead>
                                    
                                    
                                </thead>
                                <tbody>
                                    @foreach($programLearningOutcomes as $data)
                                    <tr>
                                        <td>{{$data->plo_name}}</td>
                                        <td>{{$data->program}}</td>
                                        <td>{{$data->plo}}</td>
                                     
                                    </tr>
                                   @endforeach
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>