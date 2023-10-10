
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 4.1(a). Business School Faculty</caption>
                                <thead>
                                    <th></th>
                                    <th>Business administration</th>
                                    <th>Public administration</th>
                                    <th>Management
                                    sciences
                                    </th>
                                    <th>Commerce/
                                        Economics
                                        </th>
                                    <th>Others</th>
                                    <th>Total</th>

                                </thead>
                               <tbody>
                                    <?php //echo "<pre>";
                                    //print_r($facultySummary[1]); echo "<pre>";
                                    for ($i=0; $i <count(@$facultySummary[0]) ; $i++) {
                                                                            ?>

                                    <tr>
                                        <td><?php print_r($facultySummary[0][$i]->name);?></td>
                                        <td>
                                            @php
    $facSum =  App\Http\Controllers\RegistrationPrintController::getfacultySummary($i,@$facultySummary[0],auth()->user()->campus_id);
   @endphp
   <?php
   $total=0;
    for($j=0;$j<count(@$facSum);$j++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$j]->disciplineName=='Business Administration'){
            echo $facSum[$j]->number_faculty;
            $total +=$facSum[$j]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                          <?php

    for($j=0;$j<count($facSum);$j++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$j]->disciplineName=='Public Administration'){
            echo $facSum[$j]->number_faculty;
            $total +=$facSum[$j]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                            <?php

    for($j=0;$j<count($facSum);$j++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$j]->disciplineName=='Management Sciences'){
            echo $facSum[$j]->number_faculty;
            $total +=$facSum[$j]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                               <?php

    for($j=0;$j<count($facSum);$j++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$j]->disciplineName=='Commerce/Economics'){
            echo $facSum[$j]->number_faculty;
            $total +=$facSum[$j]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td>
                                              <?php

    for($j=0;$j<count($facSum);$j++) {
        //print_r($facSum[$j]->disciplineName);

        if($facSum[$j]->disciplineName=='Other'){
            echo $facSum[$j]->number_faculty;
            $total +=$facSum[$j]->number_faculty;
        }


    }
   ?>
                                        </td>
                                        <td><?php
                                            echo $total;
                                        ?></td>

                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <!-- <tr>
                                        <td> 18 years education (MS/MPhil/MBA/MPA/M.Com)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>

                                    <tr>
                                        <td>16 years education (Bachelors/Masters)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td>Others (professional/industry experience)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                       <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr> -->



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
