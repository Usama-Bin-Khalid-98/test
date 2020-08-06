
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 3.1. Student enrolment</caption>
                                <thead>
                                    <th rowspan="2">Year <sup>4</sup></th>
                                    <th style="text-align: center;" colspan="3">Enrollment in all study programs</th>
                                    
                                    <th>Total annual enrollment<sup>5</sup> 
                                    A+B+C
                                    </th>
                                    
                                </thead>
                                
                                
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>16 year programs
(A)
</td>
                                        <td>18 year programs
(B)
</td>
                                        <td>Doctoral programs
(C)
</td>
                                        <td></td>
                                     
                                     
                                    </tr>
                                    @foreach($studentEnrolment as $enr)
                                    @if($enr->year==2018)
                                    <tr>
                                        <td>Year t-2</td>
                                        <td>{{$enr->bs_level}}</td>
                                        <td>{{$enr->ms_level}}</td>
                                         <td>{{$enr->phd_level}}</td>
                                        <td></td>
                                    </tr>
                                    @elseif($enr->year==2019)
                                    <tr>
                                        <td>Year t-1</td>
                                        <td>{{$enr->phd_level}}</td>
                                        <td>{{$enr->phd_level}}</td>
                                         <td>{{$enr->phd_level}}</td>
                                        <td></td>
                                        
                                        
                                    </tr>
                                    @elseif($enr->year==2020)
                                    <tr>
                                        <td>Year t</td>
                                        <td>{{$enr->phd_level}}</td>
                                        <td>{{$enr->phd_level}}</td>
                                         <td>{{$enr->phd_level}}</td>
                                        <td></td>
                                    </tr>
                                    @endif
                              @endforeach
                              <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                         <td></td>
                                        <td></td>
                                        
                                        
                                    </tr>
                                </tbody>
                               
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>