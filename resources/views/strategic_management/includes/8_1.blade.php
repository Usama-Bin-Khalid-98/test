
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 8.1. Basic information of Placement Office</caption>
                                <thead>
                                  
                                     
                                </thead>
                                <tbody>
                                  @foreach($placementOffices as $data) 
                                  <tr class="left">
                                        <td>a)  Hierarchical position</td>
                                        <td>{{$data->hierarchical_position}} </td>
                                    </tr> 
                                    <tr class="left">
                                        <td>b)  Year of  establishment  </td>
                                        <td>{{$data->year_establishment}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>c)  Head/supervisor of the placement office</td>
                                        <td>{{$data->head}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>d)  Head/Supervisor reports to</td>
                                        <td>{{$data->reports_to}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>e)  Composition of placement committee (if any)</td>
                                        <td>{{$data->composition}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>f)  Total number of staff members</td>
                                        <td>{{$data->total_staff}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>g)  Resources available </td>
                                        <td> </td>
                                    </tr>
                                    <tr class="left">
                                        <td>Number of printers</td>
                                        <td>{{$data->printers}} </td>
                                    </tr>
                                    <tr class="left">
                                        <td>Number of photocopiers</td>
                                        <td>{{$data->photocopiers}} </td>
                                    </tr>
                                    @endforeach
                                     
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>