
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.1. Summary of business schools’ faculty</caption>
                                <thead>
                                    <th></th>
                                    <th>Business administration</th>
                                    <th>Public administration</th>
                                    <th>Management sciences</th>
                                    <th>Commerce/Economics</th>
                                    <th>Others</th>
                                    <th>Total</th>

                                </thead>
                                <tbody>
                                    <?php
//                                    echo "<pre>";
//                                    print_r($facultySummary); echo "<pre>";
//                                    exit;
                                    for ($i=0; $i <count($facultySummary[0]) ; $i++) {
                                                                            ?>

                                    <tr>
                                        <td><?php print_r($facultySummary[0][$i]->name);?></td>
                                        <td>
                                            @php
    $facSum =  App\Http\Controllers\RegistrationPrintController::getfacultySummary($i,$facultySummary[0],auth()->user()->campus_id);
   @endphp
   <?php
   $total=$totalPA=$totalMS=$totalCE=$totalO=0;
    for($j=0;$j<count($facSum);$j++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$j]->disciplineName=='Business Administration'){
            echo $facSum[$j]->number_faculty;
            $total +=$facSum[0]->number_faculty;
        }

    }
   ?>
                                        </td>
                                        <td>
                                          <?php

    for($k=0;$k<count($facSum);$k++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$k]->disciplineName=='Public Administration'){
            echo $facSum[$k]->number_faculty;
            $totalPA +=$facSum[0]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                            <?php

    for($l=0;$l<count($facSum);$l++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$l]->disciplineName=='Management Sciences'){
            echo $facSum[$l]->number_faculty;
            $totalMS +=$facSum[0]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                               <?php

    for($m=0;$m<count($facSum);$m++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$m]->disciplineName=='Commerce/Economics'){
            echo $facSum[$m]->number_faculty;
            $totalCE +=$facSum[0]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                              <?php

    for($n=0;$n<count($facSum);$n++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$n]->disciplineName=='Other'){
            echo $facSum[$n]->number_faculty;
            $totalO +=$facSum[0]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td><?php
//                                            dd($total+$totalPA+$totalMS+$totalCE+$totalO);
                                            echo $total+$totalPA+$totalMS+$totalCE+$totalO;
                                        ?></td>

                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr style="background-color: grey;color: white;">
                                        <td style="font-weight: bold;">Total</td>
                                        <td style="font-weight: bold;"></td>
                                        <td style="font-weight: bold;"></td>
                                        <td style="font-weight: bold;"></td>
                                        <td style="font-weight: bold;"></td>
                                        <td style="font-weight: bold;"></td>
                                        <td style="font-weight: bold;"></td>
                                    </tr>



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
