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
Table 7.1. Financial information of the business school
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
                                <tbody><?php
                                    $iyt_3=$iyt_2=$iyt_1=$iyt=$iyt_p1=$iyt_p2=$eyt_3=$eyt_2=$eyt_1=$eyt=$eyt_p1=$eyt_p2=0;?>
                                      @foreach($financialInfos as $data)
                                      <?php
                                      if($data->particularType=="income"){
                                        $iyt_3+=$data->year_three;
                                        $iyt_2+=$data->year_two;
                                        $iyt_1+=$data->year_one;
                                        $iyt+=$data->year_t;
                                        $iyt_p1+=$data->year_t_plus_one;
                                        $iyt_p2+=$data->year_t_plus_two;
                                        ?><tr>
                                        <td>{{$data->particularType}}</td>
                                        <td>{{$data->particularName}}</td>
                                        <td>{{number_format($data->year_three)}}</td>
                                        <td>{{number_format($data->year_two)}}</td>
                                        <td>{{number_format($data->year_one)}}</td>
                                        <td>{{number_format($data->year_t)}}</td>
                                        <td>{{number_format($data->year_t_plus_one)}}</td>
                                        <td>{{number_format($data->year_t_plus_two)}}</td>
                                    </tr><?php
                                      }?>
                                      
                                      @endforeach
                                      <tr> 
                                        <td></td>
                                          <td><b>TOTAL REVENUE (A)</b></td>
                                          <td><b><?php echo number_format($iyt_3); ?></b></td>
                                          <td><b><?php echo number_format($iyt_2); ?></b></td>
                                          <td><b><?php echo number_format($iyt_1); ?></b></td>
                                          <td><b><?php echo number_format($iyt); ?></b></td>
                                          <td><b><?php echo number_format($iyt_p1); ?></b></td>
                                          <td><b><?php echo number_format($iyt_p2); ?></b></td>
                                         
                                      </tr>
                                      @foreach($financialInfos as $data)
                                      <?php
                                       if($data->particularType=="expense"){
                                        $eyt_3+=$data->year_three;
                                        $eyt_2+=$data->year_two;
                                        $eyt_1+=$data->year_one;
                                        $eyt+=$data->year_t;
                                        $eyt_p1+=$data->year_t_plus_one;
                                        $eyt_p2+=$data->year_t_plus_two;
                                        ?><tr>
                                        <td>{{$data->particularType}}</td>
                                        <td>{{$data->particularName}}</td>
                                        <td>{{number_format($data->year_three)}}</td>
                                        <td>{{number_format($data->year_two)}}</td>
                                        <td>{{number_format($data->year_one)}}</td>
                                        <td>{{number_format($data->year_t)}}</td>
                                        <td>{{number_format($data->year_t_plus_one)}}</td>
                                        <td>{{number_format($data->year_t_plus_two)}}</td>
                                    </tr><?php
                                      }
                                      ?>
                                    @endforeach
                                   <tr> 
                                        <td></td>
                                          <td><b>TOTAL EXPENSES  (B)</b></td>
                                          <td><b><?php echo number_format($eyt_3); ?></b></td>
                                          <td><b><?php echo number_format($eyt_2); ?></b></td>
                                          <td><b><?php echo number_format($eyt_1); ?></b></td>
                                          <td><b><?php echo number_format($eyt); ?></b></td>
                                          <td><b><?php echo number_format($eyt_p1); ?></b></td>
                                          <td><b><?php echo number_format($eyt_p2); ?></b></td>
                                         
                                      </tr>

                                       <tr style="border: 1px solid black">
                                        <td></td>
                                        <td >ANNUAL BALANCE (A–B)</td>
                                        <td><?php echo number_format($iyt_3-$eyt_3);?></td> 
                                        <td><?php echo number_format($iyt_2-$eyt_2);?></td>
                                        <td><?php echo number_format($iyt_1-$eyt_1);?></td> 
                                        <td><?php echo number_format($iyt-$eyt);?></td>
                                        <td><?php echo number_format($iyt_p1-$eyt_p1);?></td>
                                        <td><?php echo number_format($iyt_p2-$eyt_p2);?></td> 
                                                                        

                                    </tr>
                                   

                                    
                                  
                                   
                                   
                                    
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>