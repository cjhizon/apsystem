<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php error_reporting(0);?>


  
  
<title>Agent attendance</title>
  <!-- Content Wrapper. Contains page content -->
<?php
       $empid = $_GET['employee_id'];
       $sql = "SELECT *, employees.employee_id AS empid FROM employees LEFT JOIN attendance ON attendance.employee_id=employees.employee_id LEFT JOIN position ON position.id=employees.position_id LEFT JOIN campaign ON campaign.id=employees.campaign_id LEFT JOIN batch ON batch.id=employees.batch_id where employees.employee_id= '$empid' ";
        $query = $db->query($sql);
        while($row = $query->fetch_assoc()){
         $startd = date('Y-m-d',strtotime($row['date']));
        $fname = $row['firstname'];
          $lname = $row['lastname'];
          $position= $row['description']; 
          $batch= $row['batch']; 
          $campaign= $row['campaign_name']; 
          

        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                
              <!-- <a href="viewprofile.php?employee_id=<?php echo $empid;?>" type="hidden" ><i ></i>Back</a> -->
              <br><br>
              <?php
  

    if (isset($_POST)) {
        $startdatetext = $db->real_escape_string($_POST['startdatepdf']);
        $enddatetext = $db->real_escape_string($_POST['enddatepdf']);
      
    }

    //print_r($startdatetext);
    //print_r($enddatetext);
     $startdatetext = date('Y-m-d',strtotime($_POST['startdatepdf']));
     $enddatetext =date('Y-m-d',strtotime($_POST['enddatepdf']));

    ?>
   
         
   

 
            </div>

            <div class="box-body" type="hidden" style="">
              <table id="datainfo" class= "table" style="" type="hidden" >
                <thead> 
                  <th class="h4 text-gray-900 mb-4" colspan="15" style="text-align: center; font-size: 30px; ">
                    Sterling Global Call Center<br>Agent Attendance <br></th>

                  </thead>
              <tbody> 
              
               <td colspan="2" style=" font-size: 16px;"><b>Employee ID: <?php echo "".$empid.""; "".$startd."" ?> 
               <br>
               Name: <?php echo "".$fname. ' '.$lname.""; ?>
                  
                   <br>Date: <?php echo "".$startdatetext. ' - '.$enddatetext.""; ?></b>
                   
                  <br><br>
               </td>
               <td colspan="2" style=" font-size: 16px;">
               <b> Campaign: <?php echo "".$campaign.""; ?>
                <br>Position: <?php echo "".$position.""; ?>
                <br>Batch: <?php echo "".$batch.""; ?></b>
               </td>

                
               </tbody>
              
              
                <tbody>
                  <th class="hidden"></th>
                  
                  <th>Date</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                    <th >Late</th>
                    <th>Undertime</th>
                    <th> Overtime</th>
                  <th>  Total Hours</th>
                
                  <th>Total Break</th>
                  <th>Actual Hours</th>
               
                
                </tbody>
                <br>
                <tbody>
                  <?php 
                  $totalMins = 0;
                    

               $sql = "SELECT * , employees.employee_id AS empid, attendance.id FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN late ON late.emp_id=attendance.employee_id and late.date_late=attendance.date LEFT JOIN undertime ON undertime.emp_id=attendance.employee_id and undertime.date_ut=attendance.date LEFT JOIN overtime ON overtime.employee_id=attendance.employee_id and overtime.date_overtime=attendance.date WHERE  date >= '$startdatetext'  and date <= '$enddatetext' and employees.employee_id ='$empid'   
               group by attendance.id
               ORDER BY attendance.date DESC, attendance.time_in DESC";
                if (!mysqli_query($db,$sql))
                  {
                  echo("Error description: " . mysqli_error($db));
                  }
                  $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                    
                      $status = ($row['status'])?'<span ">ontime</span>':'<span class=>late</span>';
                        $statuslt = ($row['status'])?'ontime':'late';
                      
                      if( $row['status_out'] == 1)
                        $status_out = '<span class=>undertime</span>';
                      if( $row['status_out'] == 0)
                        $status_out = '<span class=>overtime</span>';
                      if( $row['status_out'] == NULL)
                        $status_out = '<span class=>NULL</span>';

                      //  $status_out = ($row['status_out'])?'<span class="label label-warning pull-right">undertime</span>':'<span class="label label-danger pull-right">overtime</span>';

                    ?>
                    <tr style="margin-top:5px;">
                      <td ><?php echo "".date('M d, Y', strtotime($row['date'])).""; ?></td>
                    
                     
                                          
                      <td><?php echo "".date('h:i A', strtotime($row['time_in'])).""; ?></td>
                        
                    
                        
                 
                    
                      <?php if(!empty($row['time_out'])){ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['time_out'])).""; ?></td>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
 
                     
                      <?php if($statuslt== 'late'){ ?>
                        <td><?php echo "".($row['mins_late']). " mins"; ?></td>
                        <?php $totallate += (double) $row['mins_late']; ?>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                       <?php if($row['status_out'] == 1 && $row['status_out'] !== NULL){ ?>
                        <td><?php echo "".($row['mins_ut'])." mins"; ?></td>
                        <?php $totalut += (double) $row['mins_ut']; ?>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                       <?php if($row['status_out'] == 0 && $row['status_out'] !== NULL){ ?>
                        <td> &nbsp;<?php echo "".($row['hours'])." mins"; ?></td>
                        <?php $totalot += (double) $row['hours']; 
                        ?>
                      <?php }   else { ?>
                        <td></td>
                      <?php } ?>


                       <td>
 
                    <?php

                          $time_in = new DateTime($row['time_in']);
                          $time_out = new DateTime($row['time_out']);
                          $interval = $time_in->diff($time_out);
                          $hrs = $interval->format('%h');
                          $mins = $interval->format('%i');
                          $mins = $mins;
                          $int = ($hrs*60) + $mins;
                          if($int > 4){
                            $int = $int;
                          }
                          
                          // echo $int - ($break1 + $break2);
                          $total = $int ;
                            $hrss = number_format(($total)/60,0);
                            echo $hrss."hrs ";
                            $mins = ($total)%60;
                            echo $mins." mins";

                       ?>
                    </td>

                   
                  <td>
                    
 
                    <?php

                        $break1 = 0;
                      $break2 = 0;
                      if(!empty($row['break1_in']) || !empty($row['break1_out'])){
                          $break1_in = new DateTime($row['break1_in']);
                          $break1_out = new DateTime($row['break1_out']);
                          $interval = $break1_in->diff($break1_out);
                          $hrs = $interval->format('%h');
                          $mins = $interval->format('%i');
                          $mins = $mins;
                          $break1 = ($hrs*60) + $mins;
                          if($break1 > 4){
                            $break1 = $break1 - 1;
                          }
                          // echo $break1;
                      }

                      if(!empty($row['break2_in']) || !empty($row['break2_out'])){
                          $break2_in = new DateTime($row['break2_in']);
                          $break2_out = new DateTime($row['break2_out']);
                          $interval = $break2_in->diff($break2_out);
                          $hrs = $interval->format('%h');
                          $mins = $interval->format('%i');
                          $mins = $mins;
                          $break2 = ($hrs*60) + $mins;
                          if($break2 > 4){
                            $break2 = $break2 - 1;
                          }
                          // echo $break2;
                      }
                      // echo $break1+$break2;
                     $hrss = number_format(($break1+$break2)/60,0);
                      echo $hrss."hr ";
                      $mins = ($break1+$break2)%60;
                      echo $mins." mins";
                      ?>
                    </td>
                      
                      <td>
                        
                      <?php
                          $time_in = new DateTime($row['time_in']);
                          $time_out = new DateTime($row['time_out']);
                          $interval = $time_in->diff($time_out);
                          $hrs = $interval->format('%h');
                          $mins = $interval->format('%i');
                          $mins = $mins;
                          $int = ($hrs*60) + $mins;
                          if($int > 4){
                            $int = $int;
                          }
                          
                          // echo $int - ($break1 + $break2);
                          $total = $int - ($break1 + $break2);
                            $hrss = number_format(($total)/60,0);
                            echo "".$hrss."hr ";
                            $mins = ($total)%60;
                            echo $mins." mins";
                        $totalMins += $total;
                       ?>
                    </td>
                      
                     
                    
                     </tr>
                <?php  }
                  ?> 

                  <tr> 
       
                    <td colspan="3">OVER-ALL TOTAL:</td>
                        <td colspan=" ">
                       <?php 
                       
                       if($totallate>=60){
                        $hrslt= number_format(($totallate)/60,0);
                        echo $hrslt."hrs ";
                         $minslt = ($totallate)%60;
                            echo $minslt." mins";
                       }else{
                       // $totalLate= ($late + $late);
                      $minsslt=number_format(($totallate));
                      echo $minsslt. " mins";
                            }
                       ?>
                     </td>
                        <td colspan=" ">
                       <?php 
                        if($totalut>=60){
                        $hrsut= number_format(($totalut)/60,0);
                        echo $hrsut."hrs ";
                         $minsut = ($totalut)%60;
                            echo $minsut." mins";
                       }else{
                       
                       // $totalLate= ($late + $late);
                        $minssut=number_format(($totalut));
                      echo $minssut. " mins";
                        }
                       ?>
                     </td>
                     
  <td colspan="3">
                       <?php 
                        
                       if($totalot>=60){
                        $hrsot= number_format(($totalot)/60,0);
                        echo $hrsot."hrs "; 
                          $minsot = ($totalot)%60;
                            echo $minsot." mins";
                      }else{
                       // $totalLate= ($late + $late);
                      
                       $minssot=number_format(($totalot));
                      echo $minssot. " mins";
                       } 
                       ?>
                     </td>
                    <td>&nbsp;<?php 
                    

                            $hrss = number_format(($totalMins)/60,0);
                            echo "".$hrss."hrs ";
                            $mins = ($totalMins)%60;
                            echo $mins." mins";
                     ?></td>

                 
                  </tr>
               </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  
</div>
<?php include 'includes/scripts.php'; ?>


</body>
</html>
