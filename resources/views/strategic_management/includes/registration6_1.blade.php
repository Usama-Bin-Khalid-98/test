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
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">
Table 6.1. Financial information of the business school
</caption>
                                <thead>
                                    <th class="" style="text-align: center;"></th>
                                    <th>Particulars</th>
                                    <th>Year t-3</th>
                                    <th >Year t-2</th>
                                    <th>Year t-1</th>
                                    <th>Year t</th>
                                    <th>Year t+1</th>
                                    <th>Year t+2</th>


                                </thead>
                                <tbody>
                                    <?php
                                    $countIncome = $countExpense = 0;
                                    $revenuet_3=$revenuet_2=$revenuet_1=$revenuet=$revenuetPlus1=$revenuetPlus2=0;

                                    for ($i=0; $i <count($financialInfos); $i++) {
                                        if($financialInfos[$i]->particularType=="income"){
                                            $countIncome++;
                                        }
                                        else if($financialInfos[$i]->particularType=="expense"){
                                            $countExpense++;
                                        }
                                    }



                                    ?>

                                    <?php   for ($i=0; $i <1; $i++) {
                                        if(@$financialInfos[$i]->particularType=="income"){
                                     ?>
                                    <tr>
                                        <td class="" rowspan="<?php echo $countIncome; ?>" style="text-align: center;">Revenue</td>
                                        <td><?php print_r($financialInfos[$i]->particularName); ?> </td>
                                        <td><?php print_r($financialInfos[$i]->year_three);
                                            $revenuet_3=$financialInfos[$i]->year_three;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_two);
                                            $revenuet_2=$financialInfos[$i]->year_two;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_one);
                                            $revenuet_1=$financialInfos[$i]->year_one;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t);
                                            $revenuet=$financialInfos[$i]->year_t;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t_plus_one);
                                            $revenuetPlus1=$financialInfos[$i]->year_t_plus_one;
                                         ?></td>

                                        <td><?php print_r($financialInfos[$i]->year_t_plus_two);
                                            $revenuetPlus2=$financialInfos[$i]->year_t_plus_two;
                                         ?></td>

                                    </tr>
                                    <?php } } for ($i=1; $i <$countIncome ; $i++) {
                                    if($financialInfos[$i]->particularType=="income"){  ?>
                                     <tr>
                                        <td ><?php print_r($financialInfos[$i]->particularName); ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_three);
                                            $revenuet_3+=$financialInfos[$i]->year_three;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_two);
                                            $revenuet_2+=$financialInfos[$i]->year_two;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_one);
                                            $revenuet_1+=$financialInfos[$i]->year_one;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t);
                                            $revenuet+=$financialInfos[$i]->year_t;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t_plus_one);
                                            $revenuetPlus1+=$financialInfos[$i]->year_t_plus_one;
                                        ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t_plus_two);    $revenuetPlus2+=$financialInfos[$i]->year_t_plus_two;
                                        ?></td>


                                    </tr>
                                    <?php  }} ?>
                                     <?php

                                     $expenset_3=0;
                                     $expenset_2=$expenset_1=$expenset=$expensetPlus1=$expensetPlus2=0;
                                       for ($i=$countIncome; $i <$countIncome+1; $i++) {  ?>
                                    <tr>
                                        <td class="" rowspan="<?php echo $countExpense; ?>" style="text-align: center;">Expenses</td>
                                        <td><?php print_r(@$financialInfos[$i]->particularName); ?> </td>
                                        <td><?php print_r(@$financialInfos[$i]->year_three);
                                            $expenset_3=@$financialInfos[$i]->year_three;
                                        ?></td>
                                        <td><?php print_r(@$financialInfos[$i]->year_two);
                                            $expenset_2=@$financialInfos[$i]->year_two;
                                        ?></td>
                                        <td><?php print_r(@$financialInfos[$i]->year_one);
                                        $expenset_1=@$financialInfos[$i]->year_one;
                                        ?></td>
                                        <td><?php print_r(@$financialInfos[$i]->year_t);
                                        $expenset=@$financialInfos[$i]->year_t;
                                         ?></td>
                                        <td><?php print_r(@$financialInfos[$i]->year_t_plus_one);
                                        @$expensetPlus1=$financialInfos[$i]->year_t_plus_one;
                                         ?></td>

                                        <td><?php print_r(@$financialInfos[$i]->year_t_plus_two);
                                        @$expensetPlus2=$financialInfos[$i]->year_t_plus_two;
                                         ?></td>

                                    </tr>
                                    <?php }  for ($i=$countIncome+1; $i <$countIncome+$countExpense ; $i++) {  ?>
                                     <tr>
                                        <td ><?php print_r($financialInfos[$i]->particularName); ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_three);
                                            $expenset_3+=$financialInfos[$i]->year_three;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_two);
                                        $expenset_2+=$financialInfos[$i]->year_two;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_one);
                                        $expenset_1+=$financialInfos[$i]->year_one;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t);
                                        $expenset+=$financialInfos[$i]->year_t;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t_plus_one);
                                        $expensetPlus1+=$financialInfos[$i]->year_t_plus_one;
                                         ?></td>
                                        <td><?php print_r($financialInfos[$i]->year_t_plus_two);
                                        $expensetPlus2+=$financialInfos[$i]->year_t_plus_two;
                                         ?></td>


                                    </tr>
                                    <?php  }
                                       // print_r($revenuet_3);
                                        //echo "string";
                                        //print_r($expenset_3);
                                    ?>

                                       <tr style="border: 1px solid black">
                                        <td></td>
                                        <td >ANNUAL BALANCE (A–B)</td>
                                        <td><?php echo $revenuet_3-$expenset_3; ?></td>
                                        <td><?php echo $revenuet_2-$expenset_2; ?></td>
                                        <td><?php echo $revenuet_1-$expenset_1; ?></td>
                                        <td><?php echo $revenuet-$expenset; ?></td>
                                        <td><?php echo $revenuetPlus1-$expensetPlus1; ?></td>
                                        <td><?php echo $revenuetPlus2-$expensetPlus2; ?></td>


                                    </tr>








                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
