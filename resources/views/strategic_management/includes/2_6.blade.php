
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
                                Table 2.6. Mapping of POs and PLOs
                                </caption>
                                
                                <tbody>
                                   
    
                                    <?php
                                    foreach ($PoMappings as $data) {
                                         
                                                      
                                    
                                    ?>
                                    <tr>
                                        <?php echo "<td>".$data->po."</td>";
                                        $a=  App\Http\Controllers\PrintController::getPLOsByPOId($data->id);
                                      
                                        for ($i=0; $i < 4; $i++) { 
                                         
                                       if(isset($a[$i]->plo)) echo  "<td>".$a[$i]->plo."</td>";else echo "<td></td>";
                                       
                                         } ?>
                                        
                                    </tr>
                                   <?php } ?>
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>