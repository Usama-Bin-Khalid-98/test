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
Table 6.2. Business schools’ resources
</caption>
                                <thead>
                                    
                                </thead>
                                <?php
                                if($BIResources){
                                ?>
                                <tbody>
                                    <?php
                                    $countbusiness = $countFaculty = $countLecture = $countLibrary = $countLaboratry = $countAuditorium = $countHostels = $countTransportation = $countOthers = 0;
                                    for ($i=0; $i<count($BIResources) ; $i++) { 
                                        if($BIResources[$i]->facilityType=="Business School"){
                                            $countbusiness++;
                                        }else   if($BIResources[$i]->facilityType=="Faculty Offices"){
                                            $countFaculty++;
                                        }else   if($BIResources[$i]->facilityType=="Lecture Halls"){
                                            $countLecture++;
                                        }else   if($BIResources[$i]->facilityType=="Library"){
                                            $countLibrary++;
                                        }else   if($BIResources[$i]->facilityType=="Laboratories"){
                                            $countLaboratry++;
                                        }else   if($BIResources[$i]->facilityType=="Multipurpose hall/auditorium"){
                                            $countAuditorium++;
                                        }else   if($BIResources[$i]->facilityType=="Hostels/accommodation"){
                                            $countHostels++;
                                        }else   if($BIResources[$i]->facilityType=="Transportation"){
                                            $countTransportation++;
                                        }else   if($BIResources[$i]->facilityType=="Other Facilities"){
                                            $countOthers++;
                                        }
                                    }

                                    for ($i=0; $i <1; $i++) { if($BIResources)
                                        if($BIResources[$i]->facilityType=="Business School"){
                                            dd($BIResources[$i]);
                                    ?>
                                    <tr>
                                        <td class="" rowspan="<?php echo $countbusiness; ?>" style="text-align: center;">Business school</td>
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                                                       

                                    </tr>
                                    <?php }} 

                                    for ($i=1; $i <$countbusiness+2; $i++) { 
                                        if($BIResources)
                                        if($BIResources[$i]->facilityType=="Business School"){
                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }} 

                                    for ($i=0; $i <$countbusiness+1; $i++) { 
                                        //if($BIResources)
                                        if($BIResources[$i]->facilityType=="Faculty Offices"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countFaculty; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $facultyLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=1; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Faculty Offices" ){
                                            if($BIResources[$i]->facilityName==$facultyLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }} 

                                    for ($i=0; $i <$countbusiness+$countFaculty+1; $i++) { 
                                        if(isset($BIResources[$i]->facilityType))
                                        if($BIResources[$i]->facilityType=="Lecture Halls"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countLecture; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $lectureLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=1; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Lecture Halls" ){
                                            if($BIResources[$i]->facilityName==$lectureLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }} 

                                    for ($i=0; $i <$countbusiness+$countFaculty+$countLecture; $i++) { 
                                        if($BIResources[$i]->facilityType=="Library"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countLibrary; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $libraryLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=1; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Library" ){
                                            if($BIResources[$i]->facilityName==$libraryLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}



                                    
                                    for ($i=0; $i <$countbusiness+$countFaculty+$countLecture+$countLibrary+1; $i++) { 
                                        if($BIResources)
                                        if($BIResources[$i]->facilityType=="Laboratories"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countLaboratry; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $labLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=1; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Laboratories" ){
                                            if($BIResources[$i]->facilityName==$labLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}





                                    for ($i=0; $i <$countbusiness+$countFaculty+$countLecture+$countLibrary+$countLaboratry+1; $i++) { 
                                        if(isset($BIResources[$i]->facilityType))
                                        if($BIResources[$i]->facilityType=="Multipurpose hall/auditorium"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countAuditorium; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $audiLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=0; $i <count($BIResources); $i++) { 
                                        if(isset($BIResources[$i]->facilityType))
                                        if($BIResources[$i]->facilityType=="Multipurpose hall/auditorium" ){
                                            if($BIResources[$i]->facilityName==$audiLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                    $hostelsLoop=0;


                                     for ($i=0; $i <$countbusiness+$countFaculty+$countLecture+$countLibrary+$countLaboratry+$countAuditorium+1; $i++) { 
                                        if(isset($BIResources[$i]->facilityType)){
                                        if($BIResources[$i]->facilityType=="Hostels/accommodation"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countHostels; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $hostelsLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}}
                                    if($hostelsLoop>0){
                                     for ($i=0; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Hostels/accommodation" ){

                                            if($BIResources[$i]->facilityName==$hostelsLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}}



                                     for ($i=0; $i <$countbusiness+$countFaculty+$countLecture+$countLibrary+$countLaboratry+$countAuditorium+$countHostels+1; $i++) {
                                     if(isset($BIResources[$i]->facilityType)) 
                                        if($BIResources[$i]->facilityType=="Transportation"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countTransportation; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $transportLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=0; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Transportation" ){
                                            if($BIResources[$i]->facilityName==$transportLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}



                                     for ($i=0; $i <$countbusiness+$countFaculty+$countLecture+$countLibrary+$countLaboratry+$countAuditorium+$countHostels+$countTransportation+1; $i++) {
                                     if(isset($BIResources[$i]->facilityType)) 
                                        if($BIResources[$i]->facilityType=="Other Facilities"   ){
                                    ?>
                                    
                                    
                                    <tr>
                                        <td class="" rowspan="<?php echo $countOthers; ?>" style="text-align: center;"><?php echo $BIResources[$i]->facilityType; ?></td>
                                        <td><?php echo $BIResources[$i]->facilityName;
                                        $othersLoop=$BIResources[$i]->facilityName;
                                         ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}

                                     for ($i=0; $i <count($BIResources); $i++) { 
                                        if($BIResources[$i]->facilityType=="Other Facilities" ){
                                            if($BIResources[$i]->facilityName==$othersLoop){continue; }
                                     ?>
                                    <tr>
                                        
                                        <td><?php echo $BIResources[$i]->facilityName; ?></td> 
                                        <td><?php echo $BIResources[$i]->remark; ?></td>
                                    </tr>
                                    <?php }}
                                    ?>



                                    

                                    
                                   




                                    


                                    
                                </tbody>
                                <?php }else{ ?>
                                 <tbody>
                                    <tr>
                                        <td class="" rowspan="5" style="text-align: center;">Business school</td>
                                        <td>Total area (sq.ft)</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Covered area (sq.ft)</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Open area (sq.ft)</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                         
                                        <td>Total student enrollment</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                     <tr>
                                        
                                        <td>Open area per student</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    
                                    <tr>
                                        <td class="" rowspan="8" style="text-align: center;">Faculty offices</td>
                                        <td>Total number of offices</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Total faculty members</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Average number of faculty members per office</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                         
                                        <td>Facilities available at faculty offices</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                     <tr>
                                        
                                        <td>a)  Workstations/laptops</td> 
                                        <td>Yes/No</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>b)  Printer/photocopier</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                         
                                        <td>c)  Air conditioning</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                     <tr>
                                        
                                        <td>d)  Safe cabinets</td> 
                                        <td>Yes/No</td>
                                    </tr>

                                     <tr>
                                        <td class="" rowspan="8" style="text-align: center;">Lecture halls</td>
                                        <td>Total number of lecture halls</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Seating capacity (minimum-maximum)</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Facilities available at lecture halls</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                         
                                        <td>a)  Multimedia</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>b)  Whiteboard/blackboard</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>c)  Proper lighting</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                         
                                        <td>d)  Air conditioning</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                         
                                        <td>Multimedia and whiteboard simultaneously useable?</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        <td class="" rowspan="14" style="text-align: center;">Library</td>
                                        <td>Number of libraries</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Total seating capacity</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Number of business text books (hardcopy)</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>                                         
                                        <td>Number of business reference books </td> 
                                        <td>Hardcopies
                                        Softcopies
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td>Number of local journal subscriptions</td> 
                                        <td>Hardcopies
                                        Softcopies</td>
                                    </tr>
                                    <tr>                                        
                                        <td>Number of new books added in current year </td> 
                                        <td> </td>
                                    </tr>
                                    <tr>                                         
                                        <td>Budget spent on new books in current year (PKR)</td> 
                                        <td> </td>
                                    </tr>
                                    <tr>                                         
                                        <td>Number of international journal subscriptions</td> 
                                        <td> </td>
                                    </tr>
                                    <tr>                                         
                                        <td>Number of business magazines </td> 
                                        <td> 
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td>Access to HEC digital library</td> 
                                        <td>Yes/No</td>
                                    </tr>
                                    <tr>                                        
                                        <td>Access to HEC digital library</td> 
                                        <td> Yes/No</td>
                                    </tr>
                                    <tr>                                         
                                        <td>Access to other online databases</td> 
                                        <td> Yes/No</td>
                                    </tr>
                                    <tr>                                         
                                        <td>Database of research publications</td> 
                                        <td> Yes/No</td>
                                    </tr>
                                    <tr>                                         
                                        <td>Students to computers ratio in library</td> 
                                        <td>  </td>
                                    </tr>

                                    
                                     <tr>
                                        <td class="" rowspan="6" style="text-align: center;">Laboratories</td>
                                        <td>Number of laboratories</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>LAN/WAN networking</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Internet bandwidth (GBs)</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>                                         
                                        <td>Total number of workstations in labs </td> 
                                        <td> 
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td>Students to computers ratio</td> 
                                        <td> </td>
                                    </tr>
                                    <tr>                                        
                                        <td>List of available softwares</td> 
                                        <td> </td>
                                    </tr>



                                     <tr>
                                        <td class="" rowspan="2" style="text-align: center;">Multipurpose hall/auditorium</td>
                                        <td>Number of multipurpose halls</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>                                        
                                        <td>Seating capacity</td> 
                                        <td></td>
                                    </tr>


                                     <tr>
                                        <td class="" rowspan="6" style="text-align: center;">Hostels/accommodation</td>
                                        <td>Number of faculty hostels</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Total capacity of faculty hostel(s)</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Number of female student hostels</td> 
                                        <td></td>
                                         
                                                                        

                                    </tr>
                                    <tr>                                         
                                        <td>Total capacity of female student hostel(s) </td> 
                                        <td> 
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td>Number of male student hostels</td> 
                                        <td> </td>
                                    </tr>
                                    <tr>                                        
                                        <td>Total capacity of male student hostel(s)</td> 
                                        <td> </td>
                                    </tr>


                                    <tr>
                                        <td class="" rowspan="2" style="text-align: center;">Transportation</td>
                                        <td>Number of vans for faculty transportation</td> 
                                        <td></td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Number of vans for students transportation</td> 
                                        <td></td>
                                    </tr>



                                     <tr>
                                        <td class="" rowspan="6" style="text-align: center;">Other facilities</td>
                                        <td>Female students common room</td> 
                                        <td>Yes/No</td>
                                                                       

                                    </tr>
                                    <tr>
                                        
                                        <td>Male students common room</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>
                                        
                                        <td>Prayer room</td> 
                                        <td>Yes/No</td>
                                         
                                                                        

                                    </tr>
                                    <tr>                                         
                                        <td>Canteen/cafeteria</td> 
                                        <td>Yes/No 
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td>Gymnasium</td> 
                                        <td> Yes/No</td>
                                    </tr>
                                    <tr>                                        
                                        <td>Playground</td> 
                                        <td> Yes/No</td>
                                    </tr>

                                    
                                    
                                </tbody>
                                <?php } ?>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>



