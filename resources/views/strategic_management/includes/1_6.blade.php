
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 1.6. Budgetary information</caption>
                                <thead>
                                    <th>Year</th>
                                    <th>University budget</th>
                                    <th>Budget proposed by business school</th>
                                    <th>Budget received by business school</th>
                                    <th>Budget type</th>
                                </thead>
                                <tbody>
                                    @foreach($budgetoryInfo as $data)
                                    <tr>
                                        <td>{{$data->year}}</td>
                                        <td>{{number_format($data->uni_budget)}}</td>
                                        <td>{{number_format($data->uni_proposed_budget)}}</td>
                                        <td>{{number_format($data->budget_receive)}}</td>
                                        <td>{{$data->budget_type}}</td>
                                    </tr>
                                    @endforeach



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
