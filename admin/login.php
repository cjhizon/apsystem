<?php 
session_start();
    include 'includes/conn.php';
    
    if(isset($_SESSION['admin'])){
        header("location:admin/home.php");
    }

    require "includes/conn.php";
    $sql = "SELECT * FROM admin";
    $res = $db->query($sql);

    while($row = $res->fetch_assoc()){

        $username = $row['username'];
        $password = $row['password'];/*
   $password = md5($_POST["password"]);*/
       

        if( !empty($_POST) ){
            if (($_POST['username'] == $username) && (md5($_POST["password"]) == $password)) {
                  $_SESSION['username'] = true;
                  
                   
                    header("location:../admin/home.php");
                  } else if(($_POST['username'] != $username) && (md5($_POST["password"]) != $password)){

                    echo "<script>
    alert('Incorrect input')
    location.href='index.php';</script>";
                }
            
        }
    }

?>