
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 1.7. Approval of strategic plan</caption>
                                <thead>
                                    <th>No.</th>
                                    <th>Period of the strategic plan</th>
                                    <th>Date of approval</th>
                                    <th>Approving authority </th>
                                </thead>
                                <tbody>
                                    @foreach($strategicPlans as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->plan_period}}</td>
                                        <td>{{$data->aproval_date}}</td>
                                        <td>{{$data->aproving_authority}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
