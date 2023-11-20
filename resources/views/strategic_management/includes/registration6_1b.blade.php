<style type="text/css">
   table {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        table td {
            border: 1px solid #000;
            padding: 12px;
        }

         .rotate {
            white-space:nowrap;
             -webkit-transform: rotate(270deg);
             -moz-transform: rotate(270deg);
             -o-transform: rotate(270deg);
            writing-mode: lr-tb;
          }
          table td {
        border: 1px solid #000;
        padding: 12px;
    }
</style>
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">
Table 6.1. Financial information of the business school
</caption>
                                <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Income/Expense</th>
                                    <!-- <th class="" style="text-align: center;"></th> -->
                                    <th>Particulars</th>
                                    <th>{{@$getYear->tyear - 3}}</th>
                                    <th>{{@$getYear->tyear - 2}}</th>
                                    <th>{{@$getYear->tyear - 1}}</th>
                                    <th>{{@$getYear->tyear}}</th>
                                    <th>{{@$getYear->tyear + 1}}</th>
                                    <th>{{@$getYear->tyear + 2}}</th>
                                    </tr>

                                </thead>
                                <tbody><?php
                                    $iyt_3=$iyt_2=$iyt_1=$iyt=$iyt_p1=$iyt_p2=$eyt_3=$eyt_2=$eyt_1=$eyt=$eyt_p1=$eyt_p2=0;?>
                                      @foreach($financialInfos as $data)
                                      <?php
                                      if($data->particularType=="income"){
                                          
                                        $iyt_3+=floatval($data->year_three);
                                        $iyt_2+=floatval($data->year_two);
                                        $iyt_1+=floatval($data->year_one);
                                        $iyt+=floatval($data->year_t);
                                        $iyt_p1+=floatval($data->year_t_plus_one);
                                        $iyt_p2+=floatval($data->year_t_plus_two);
                                        ?><tr>
                                          <td>{{$loop->iteration}}</td>
                                        <td>{{$data->particularType}}</td>
                                        <td>{{$data->particularName}}</td>
                                        <td>{{$data->year_three}}</td>
                                        <td>{{$data->year_two}}</td>
                                        <td>{{$data->year_one}}</td>
                                        <td>{{$data->year_t}}</td>
                                        <td>{{$data->year_t_plus_one}}</td>
                                        <td>{{$data->year_t_plus_two}}</td>
                                    </tr><?php
                                      }?>

                                      @endforeach
                                      <tr>
                                        <td></td>
                                          <td><b>TOTAL REVENUE (A)</b></td>
                                          <td><b><?php echo $iyt_3; ?></b></td>
                                          <td><b><?php echo $iyt_2; ?></b></td>
                                          <td><b><?php echo $iyt_1; ?></b></td>
                                          <td><b><?php echo $iyt; ?></b></td>
                                          <td><b><?php echo $iyt_p1; ?></b></td>
                                          <td><b><?php echo $iyt_p2; ?></b></td>

                                      </tr>
                                      @foreach($financialInfos as $data)
                                      <?php
                                       if($data->particularType=="expense"){
                                        $eyt_3+=floatval($data->year_three);
                                        $eyt_2+=floatval($data->year_two);
                                        $eyt_1+=floatval($data->year_one);
                                        $eyt+=floatval($data->year_t);
                                        $eyt_p1+=floatval($data->year_t_plus_one);
                                        $eyt_p2+=floatval($data->year_t_plus_two);
                                        ?><tr>
                                          <td>{{$loop->iteration}}</td>
                                        <td>{{$data->particularType}}</td>
                                        <td>{{$data->particularName}}</td>
                                        <td>{{$data->year_three}}</td>
                                        <td>{{$data->year_two}}</td>
                                        <td>{{$data->year_one}}</td>
                                        <td>{{$data->year_t}}</td>
                                        <td>{{$data->year_t_plus_one}}</td>
                                        <td>{{$data->year_t_plus_two}}</td>
                                    </tr><?php
                                      }
                                      ?>
                                    @endforeach
                                   <tr>
                                        <td></td>
                                          <td><b>TOTAL EXPENSES  (B)</b></td>
                                          <td><b><?php echo $eyt_3; ?></b></td>
                                          <td><b><?php echo $eyt_2; ?></b></td>
                                          <td><b><?php echo $eyt_1; ?></b></td>
                                          <td><b><?php echo $eyt; ?></b></td>
                                          <td><b><?php echo $eyt_p1; ?></b></td>
                                          <td><b><?php echo $eyt_p2; ?></b></td>

                                      </tr>

                                       <tr style="border: 1px solid black">
                                        <td></td>
                                        <td >ANNUAL BALANCE (A–B)</td>
                                        <td><?php echo $iyt_3-$eyt_3;?></td>
                                        <td><?php echo $iyt_2-$eyt_2;?></td>
                                        <td><?php echo $iyt_1-$eyt_1;?></td>
                                        <td><?php echo $iyt-$eyt;?></td>
                                        <td><?php echo $iyt_p1-$eyt_p1;?></td>
                                        <td><?php echo $iyt_p2-$eyt_p2;?></td>


                                    </tr>








                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
