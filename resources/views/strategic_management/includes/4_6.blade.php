
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 4.6. Gender mix</caption>
                                <thead>
                                    <th>Gender</th>
                                    <th>Permanent/Regular</th>
                                    <th>Adjunct</th>
                                    <th>Visiting</th>


                                </thead>
                                <tbody>
                                   <?php
                                   $facPer = $facPerm = array(0, 0, 0);
                                   //print_r($facultyGenders);
                                   for ($i=0;$i<count(@$facultyGenders);$i++) {
                                        if($facultyGenders[$i]->facultyTypeName=='Permanent'){
                                           $facPer[0] = $facultyGenders[$i]->male;
                                           $facPerm[0] = $facultyGenders[$i]->female;
                                        }
                                        else if($facultyGenders[$i]->facultyTypeName=='Visiting'){
                                           $facPer[2] = $facultyGenders[$i]->male;
                                           $facPerm[2] = $facultyGenders[$i]->female;
                                        }
                                       else if($facultyGenders[$i]->facultyTypeName=='Adjunct'){
                                           $facPer[1] = $facultyGenders[$i]->male;
                                           $facPerm[1] = $facultyGenders[$i]->female;
                                        }
                                        //print_r($facPer);
                                    }

                                   ?>
                                    <tr>
                                        <td>Male</td>
                                        <td><?php
                                        if(isset($facPer[0])) print_r($facPer[0]); ?></td>
                                        <td><?php  if(isset($facPer[1])) print_r($facPer[1]); ?></td>
                                        <td><?php  if(isset($facPer[2])) print_r($facPer[2]); ?></td>



                                    </tr>

                                    <tr>
                                        <td>Female</td>
                                        <td><?php  if(isset($facPer[0])) print_r($facPerm[0]); ?></td>
                                        <td><?php  if(isset($facPer[1])) print_r($facPerm[1]); ?></td>
                                        <td><?php  if(isset($facPer[2])) print_r($facPerm[2]); ?></td>



                                    </tr>


                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
