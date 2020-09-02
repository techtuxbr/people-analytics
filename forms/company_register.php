<?php
    session_start();

    require_once "../services/company.php";

    if(isset($_POST)){

        $name = $_POST["companyName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $responsible = $_POST["responsible"];
        $phone = $_POST["phone"];
        $state= $_POST["state"];
        $city = $_POST["city"];
        $address = $_POST["address"];
        $zip = $_POST["zip"];
        $bnumber = $_POST["bnumber"];

        $result = createCompany($email, $name, $password, $responsible, $phone, $state, $city, $address, $zip, $bnumber);

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