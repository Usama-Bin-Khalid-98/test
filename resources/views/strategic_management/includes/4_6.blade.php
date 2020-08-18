
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 4.6. Gender mix</caption>
                                <thead>
                                    <th>Gender</th>
                                    <th>Permanent/Regular</th>
                                    <th>Adjunct</th>
                                    <th>Visiting</th>


                                </thead>
                                <tbody>
                                   <?php
                                   @$facPer = $facPerm = array();
                                   //print_r($facultyGenders);
//                                    for ($i=0;$i<count(@$facultyGenders);$i++) {
//                                         if($facultyGenders[$i]->facultyTypeName=='Permanent'){
//                                            $facPer[$i] = $facultyGenders[$i]->male;
//                                            $facPerm[$i] = $facultyGenders[$i]->female;
//                                         }
//                                         else if($facultyGenders[$i]->facultyTypeName=='Visiting'){
//                                            $facPer[$i] = $facultyGenders[$i]->male;
//                                            $facPerm[$i] = $facultyGenders[$i]->female;
//                                         }
//                                        else if($facultyGenders[$i]->facultyTypeName=='Adjacent'){
//                                            $facPer[$i] = $facultyGenders[$i]->male;
//                                            $facPerm[$i] = $facultyGenders[$i]->female;
//                                         }
//                                         //print_r($facPer);
//                                     }

                                   ?>
                                    <tr>
                                        <td>Male</td>
                                        <td><?php
                                        if($facPer) print_r($facPer[0]); ?></td>
                                        <td><?php  if($facPer) print_r($facPer[1]); ?></td>
                                        <td><?php  if($facPer) print_r($facPer[2]); ?></td>
                                       
                                       
                                       
                                    </tr>

                                    <tr>
                                        <td>Female</td>
                                        <td><?php  if($facPer) print_r($facPerm[0]); ?></td>
                                        <td><?php  if($facPer) print_r($facPerm[1]); ?></td>
                                        <td><?php  if($facPer) print_r($facPerm[2]); ?></td>
                                    
                                        
                                        
                                    </tr>


                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>