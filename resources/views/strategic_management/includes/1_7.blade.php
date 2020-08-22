
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 1.7. Sources of funding</caption>
                                <thead>
                                    <th>Sources of funding
                                        (A)
                                        </th>
                                    <th>Amount in million rupees
                                    (B)
                                    </th>
                                    <th>Percent share</th>

                                </thead>
                                <tbody>
                                    <?php
                                        $amount = $percentShare = 0;
                                         
                                    ?>
                                    @foreach($sourceOfFunding as $data)

                                    <tr>
                                        <td>{{$data->incomeSource}}</td>

                                        <td>{{@$data->amount}}</td>
                                        <td>{{@$data->percent_share}}</td>
                                    </tr>
                                    <?php
                                        @$amount += $data->amount;
                                        @$percentShare += $data->percent_share;
                                    ?>
                                    @endforeach
                                      <tr>

                                        <td>Total</td>
                                        <td>{{$amount}}</td>
                                        <td>{{$percentShare}}</td>
                                    </tr>

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
