<?php
    session_start();

    require_once "../services/company.php";

    if(isset($_POST)){

        $name = $_POST["companyName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $result = createCompany($email, $name, $password);

        if($result["status"]){
            header('Location: ../index.php');
        }else{
            $_SESSION["errors"] = $result["errors"];
            $_SESSION["formData"] = $result["data"];
            header("Location: ../register.php");
        }
    }else{
        exit();
    }
?>