<?php 
session_start();
    include 'conn.php';
    
    if(isset($_SESSION['agent'])){
        header("location:agenttime.php");
    }

    require "conn.php";
    $sql = "SELECT employee_id, password FROM employees";
    $res = $db->query($sql);

    while($row = $res->fetch_assoc()){

        $emp = $row['employee_id'];
        $password = $row['password'];
   $password = md5($_POST["password"]);
       
        if( !empty($_POST) ){
            if ($_POST['emp'] == $emp && md5($_POST["password"]) == $password) {
                  $_SESSION['emp'] = true;
                  
                    
                    header("location:agenttime.php?emp=$emp");
                    exit();
               
                
            }
        }
    }

?>