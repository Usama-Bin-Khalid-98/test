
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 1.7. Approval of strategic plan</caption>
                                <thead>
                                    <th>Period of the strategic plan</th>
                                    <th>Date of approval</th>
                                    <th>Approving authority </th>
                                </thead>
                                <tbody>
                                    @foreach($strategicPlans as $data)
                                    <tr>
                                        <td>{{$data->plan_period}}</td>
                                        <td>{{$data->aproval_date}}</td>
                                        <td>{{$data->aproving_authority}}</td>
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>