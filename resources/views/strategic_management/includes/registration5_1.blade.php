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
                                <caption style="text-align: center;color: red">
Table 5.1. Summary of research output
</caption>
                                <thead>
                                    <th class="" style="text-align: center;">Publication<br> category</th>
                                    <th>Publication type</th>
                                    <th>Total number of items</th>
                                    <th >Number of contributing core faculty members</th>
                                    <th>Number of items jointly produced in collaboration with other institutions</th>
                                    <th>Number of items jointly produced by more than 3 authors</th>


                                </thead>
                                <tbody>
                                    <?php
                                    //print_r($researchOutput);
                                    $countResearch=0;
                                    $countBooks=0;
                                    $countOthers=0;
                                    for ($i=0; $i <count($researchOutput) ; $i++) {
                                        if($researchOutput[$i]->publicationType=="Academic research articles"){
                                            $countResearch++;
                                        }else   if($researchOutput[$i]->publicationType=="Books"){
                                            $countBooks++;
                                        }else   if($researchOutput[$i]->publicationType=="Other Publications"){
                                            $countOthers++;
                                        }
                                    }

                                    for ($i=0; $i <1; $i++) { if($researchOutput)
                                        if($researchOutput[$i]->publicationType=="Academic research articles"){
                                    ?>
                                    <tr>
                                        <td class="" rowspan="<?php echo $countResearch; ?>" style="text-align: center;">Academic research articles</td>
                                        <td><?php 
                                        print_r($researchOutput[$i]->publicationName)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->total_items)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->contributing_core_faculty)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_other)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_multiple)
                                        ?></td>

                                    </tr>
                                    <?php }}

                                    for ($i=1; $i <$countResearch+2; $i++) { 
                                        if($researchOutput)
                                        if($researchOutput[$i]->publicationType=="Academic research articles"){
                                     ?>
                                     <tr>
                                         <td><?php
                                        print_r($researchOutput[$i]->publicationName)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->total_items)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->contributing_core_faculty)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_other)
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_multiple)
                                        ?></td>


                                    </tr>
                                    <?php }}
                                   /* echo "<pre>";
                                    print_r($researchOutput);
                                    echo "</pre>";
                                    die;*/
                                    for ($i=0; $i <$countResearch+1; $i++) { 
                                        if($researchOutput)
                                        if($researchOutput[$i]->publicationType=="Books"   ){

                                     ?>
                                    
                                     <tr>
                                        <td class="" rowspan="<?php echo $countBooks; ?>" style="text-align: center;">Books</td>
                                        <td><?php print_r($researchOutput[$i]->publicationName);
                                        $booksLoop=$researchOutput[$i]->publicationName;  ?></td> 
                                        <td><?php print_r($researchOutput[$i]->total_items);  ?></td>
                                        <td><?php print_r($researchOutput[$i]->contributing_core_faculty);  ?></td> 
                                        <td><?php print_r($researchOutput[$i]->jointly_produced_other);  ?></td>
                                        <td><?php print_r($researchOutput[$i]->jointly_produced_multiple);  ?></td>  
                                    </tr>
                                    <?php  }} 
                                     for ($i=1; $i <count($researchOutput); $i++) { 
                                        if($researchOutput[$i]->publicationType=="Books" ){
                                            if($researchOutput[$i]->publicationName==$booksLoop){continue; }
                                    ?>
                                     <tr>
                                        <td ><?php print_r($researchOutput[$i]->publicationName);  ?></td>
                                        <td><?php print_r($researchOutput[$i]->total_items);  ?></td> 
                                        <td><?php print_r($researchOutput[$i]->contributing_core_faculty);  ?></td>
                                        <td><?php print_r($researchOutput[$i]->jointly_produced_other);  ?></td> 
                                        <td><?php print_r($researchOutput[$i]->jointly_produced_multiple);  ?>  </td>
                                    </tr>
                                     <?php }}

                                     for ($i=0; $i <$countResearch+$countBooks+1 ; $i++) { 
                                        if($researchOutput)
                                        if($researchOutput[$i]->publicationType=="Other Publications"){
                                         
                                      ?>
                                        
                                    <tr>
                                        <td class="" rowspan="<?php print_r($countOthers);?>" style="text-align: center;">Other Publications</td>
                                        <td><?php
                                        print_r($researchOutput[$i]->publicationName);
                                        $othersLoop=$researchOutput[$i]->publicationName;
                                        ?></td> 
                                        <td><?php
                                        print_r($researchOutput[$i]->total_items);
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->contributing_core_faculty);
                                        ?></td> 
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_other);
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_multiple);
                                        ?></td>                                

                                    </tr>
                                    <?php }}
                                    for ($i=0; $i <$countResearch+$countBooks+$countOthers ; $i++) { 
                                        if($researchOutput[$i]->publicationType=="Other Publications"){
                                            if($researchOutput[$i]->publicationName==$othersLoop){continue; }
                                     ?>
                                     <tr>
                                        <td ><?php
                                        print_r($researchOutput[$i]->publicationName);
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->total_items);
                                        ?></td> 
                                        <td><?php
                                        print_r($researchOutput[$i]->contributing_core_faculty);
                                        ?></td>
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_other);
                                        ?></td> 
                                        <td><?php
                                        print_r($researchOutput[$i]->jointly_produced_multiple);
                                        ?></td>
                                                                        

                                    </tr>
                                  
                                    <?php }} ?>
                                  
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>