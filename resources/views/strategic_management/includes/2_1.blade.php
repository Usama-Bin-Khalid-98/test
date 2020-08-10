
<div class="box-body table-responsive">
                         <table class="table table-bordered table-striped">
                            <caption style="text-align: center;">Table 2.1. Programs portfolio</caption>
                              <thead>
                                <tr>
                                  <th>Program(s) under review </th>
                                  <th>Number of semesters</th>
                                  <th>Course category </th>
                                  <th>Number of courses in program</th>
                                  <th>Credit hours</th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php echo "<pre>";
                                  //print_r(count($programsPortfolio));
                                echo "</pre>";
                                //print_r($programsPortfolio[1]->id);
                                for ($i=0; $i < count($programsPortfolio); $i++) { 
                                 
                                ?>
                              
                                    <tr>
                                      <td style="text-align: center;" ><?php echo $programsPortfolio[$i]->programName;?></td>
                                      <td ><?php echo $programsPortfolio[$i]->total_semesters;?></td>
                                      <td> <?php echo $programsPortfolio[$i]->courseType;?></td>
                                      <td><?php echo $programsPortfolio[$i]-> no_of_course;?></td>
                                      <td><?php echo $programsPortfolio[$i]-> credit_hours;?></td>
                                      
                                    </tr>
                                   
                               
                                <?php } ?>
                               <!--  <tr>
                                    <tr>
                                      <td style="text-align: center;" rowspan="4">Program 2</td>
                                      <td rowspan="4"></td>
                                      <td>Core</td>
                                      <td></td>
                                      <td></td>
                                      
                                    </tr>
                                    <tr>
                                      <td>Elective </td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td>Support </td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td>Total </td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                </tr> -->

                              </tbody>
</table>
                          
                        </div>