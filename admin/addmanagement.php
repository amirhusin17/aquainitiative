<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $pengurusan_id = "";
    $staff_name = "";
    $username = "";
    $password = "";

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM pengurusan WHERE pengurusan_id='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $pengurusan_id = $row["pengurusan_id"];
            $staff_name = $row["nama_staf"];
            $username = $row["username"];
        }
    }
    
    if(isset($_POST["btn_save"])){
    $staff_name = mres($con, $_POST["staff_name"]);
    $username = mres($con, $_POST["username"]);
    $password = md5(mres($con, $_POST["password"]));
    $qry = mysqli_query($con, "INSERT INTO pengurusan values('','".$staff_name."','".$username."','".$password."')");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
        }
    }

    if(isset($_POST["btn_edit"])){
    $staff_name = mres($con, $_POST["driver_name"]);
    $username = mres($con, $_POST["username"]);
    $password = md5(mres($con, $_POST["password"]));
    $pengurusan_id = mres($con, $_POST["pengurusan_id"]);
    $qry = mysqli_query($con, "UPDATE pengurusan SET nama_staf='".$staff_name."', username='".$username."', password='".$password."' where pengurusan_id='".$pengurusan_id."'");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Updated.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot Updated.</div>';
        }
    }
?>
   

   <?php include ("header.php"); ?>
    <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
             <?php include ("leftmenu.php"); ?>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="panel panel-info">
                   <div class="panel-heading">
                       <div class="panel-title">Add Subject</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_management" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="pengurusan_id" value="<?php echo $pengurusan_id; ?>">
                           <span class="input-group-addon">Staff Name</span>
                           <input type="text" class="form-control" name="staff_name" id="staff_name" value="<?php echo $staff_name; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Username</span>
                           <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Password</span>
                           <input type="password" class="form-control" name="password" id="password" />
                       </div>
                       <div style="margin-top: 10px" class="form-group">
                           <div class="col-sm-12 controls">
                               <?php if(!isset($_GET["edit_id"])){
                                    echo '<input type="submit" id="btn_save" name="btn_save" class="btn btn-info" value="Register"/>';
                                }else{
                                    echo '<input type="submit" id="btn_edit" name="btn_edit" class="btn btn-info" value="Edit"/>';
                                }
                            ?>
                            </div>
                       </div>
                    </form>
               </div>
            </div>
          </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
              $('input[class="form-control"]').focus(function() {
                  $(this).removeAttr('style');
              });
                $("#btn_save, #btn_edit").click(function(e){
                    if($("#staff_name").val() == ''){
                        $("#staff_name").css("border-color","#DA1908");
                        $("#staff_name").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#username").val() == ''){
                        $("#username").css("border-color","#DA1908");
                        $("#username").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#password").val() == ''){
                        $("#password").css("border-color","#DA1908");
                        $("#password").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_management').unbind('submit').submit();
                    }
                });
            });
    </script>

