<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
             <div class="form-group">
                    <label for="employee_id" class="col-sm-3 control-label">Employee ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee_id" name="employee_id" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required>
                    </div>
                </div>
          		  <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="field_ucfirst" name="firstname" autocomplete="off" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" required>
                  	</div>
                </div>
              
                <div class="form-group">
                  	<label for="password" class="col-sm-3 control-label">Password</label>

                  	<div class="col-sm-9">
                      <input type="password" class="form-control" name="password" id="password"></input>
                  	</div>
                </div>
              <div class="form-group">
                    <label for="campaign" class="col-sm-3 control-label">Campaign</label>

                     <div class="col-sm-9">
                      <select class="form-control" name="campaign" id="campaign" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM campaign";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['campaign_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Position Status</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="position" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="batch" class="col-sm-3 control-label">Batch</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="batch" id="batch" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM batch";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['batch']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="schedule" name="schedule" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $db->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" name="photo" id="photo">
                    </div>
                </div>
          	</div>
            <script>

  document.getElementById("field_ucfirst").addEventListener("keypress", function(e) {
    if(this.selectionStart == 0) {
      // uppercase first letter
      forceKeyPressUppercase(e);
    } else {
      // lowercase other letters
      forceKeyPressLowercase(e);
    }
  }, false);

</script>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_edit.php">
            		<input type="hidden" class="empid" name="id">
                 <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-3 control-label">Employee ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_employee_id" name="employee_id" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
                    </div>
                </div>
              
                        <div class="form-group">
                    <label for="edit_campaign" class="col-sm-3 control-label">Campaign</label>

                     <div class="col-sm-9">
                      <select class="form-control" name="campaign" id="edit_campaign" required>
                        <option selected id= "campaign_val">- Select -</option>
                        <?php
                          $sql = "SELECT * FROM campaign";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['campaign_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Position Status</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="edit_position" required>
                        <option selected id= "position_val">- Select -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="batch" class="col-sm-3 control-label">Batch</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="batch" id="batch" required>
                        <option  selected id= "batch_val">- Select -</option>
                        <?php
                          $sql = "SELECT * FROM batch";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['batch']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
            
          
                <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="schedule" name="schedule">
                        <option selected id="schedule_val"></option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $db->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_delete.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>DELETE EMPLOYEE</p>
	                	<h2 class="bold del_employee_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>   
