<?php
    
    require_once "../database/connection.php";


    function validateCompany($email, $name, $password){
        // Validação leve
        $result = ["status" => true, 
            "errors" => [], 
            "data" => [
                    "email" => $email, 
                    "name" => $name, 
                    "password" => $password
                    ]
            ];
        if(!isset($name) || empty($name)){
            $result["status"] = false;
            array_push($result["errors"],"O nome da empresa é inválido");
        }
        
        if(!isset($email) || empty($email)){
            $result["status"] = false;
            array_push($result["errors"],"O e-mail é inválido");
        }

        if(!isset($password) || empty($password)){
            $result["status"] = false;
            array_push($result["errors"],"A senha é inválida");
        }

        // Se algum erro acontecer na validação leve, retorne todos eles.
        if(!$result["status"]){
            return $result;
        }

        // Validação de comprimento de senha
        if(strlen($password) < 6){
            $result["status"] = false;
            array_push($result["errors"],"A senha é muito curta");
        }

        if(isEmailRegistered($email)){
            $result["status"] = false;
            array_push($result["errors"],"O e-mail já está cadastrado");
        }

        return $result;
        
    }


    function createCompany($email, $name, $password)
    {
        $result = validateCompany($email,$name,$password);

        if($result["status"]){
            try{
                global $database;
                $query = $database->prepare("INSERT INTO companies(email, name, password) VALUES (:email, :name, :password)");
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query->bindValue(":email",$email, PDO::PARAM_STR);
                $query->bindValue(":name",$name, PDO::PARAM_STR);
                $query->bindValue(":password",$hash);
                $query->execute();
                return $result;
            }catch(Exception $e){
                $result = ["status" => false, "errors" => ["Error interno"]];
                return $result;
            }
        }else{
            return $result;
        }
    }

    function isEmailRegistered($email){
        try{
            global $database;
            $query = $database->prepare("SELECT * FROM companies WHERE email = :email");
            $query->bindValue(":email",$email);
            $query->execute();
            $companies = $query->fetchAll(PDO::FETCH_OBJ);

            if(isset($companies)){
                if(count($companies) > 0){
                    return true;
                }
            }else{
                return false;
            }
        }catch(Exception $e){
            return true;
        }
    } 

?>