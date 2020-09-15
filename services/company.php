<?php
    
    require_once "../database/connection.php";


    function validateCompany($email, $name, $password, $responsible, $phone, $state, $city, $address, $zip, $bnumber){
        // Validação leve
        $result = ["status" => true, 
            "errors" => [], 
            "data" => [
                    "email" => $email, 
                    "name" => $name, 
                    "password" => $password,
                    "responsible" => $responsible,
                    "phone" => $phone,
                    "state" => $state,
                    "city" => $city,
                    "address" => $address,
                    "zip" => $zip,
                    "bnumber" => $bnumber
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



        if(!isset($responsible) || empty($responsible)){
            $result["status"] = false;
            array_push($result["errors"],"O nome do responsável é inválido");
        }
        
        if(!isset($phone) || empty($phone)){
            $result["status"] = false;
            array_push($result["errors"],"O número de celular é inválido");
        }

        if(!isset($state) || empty($state)){
            $result["status"] = false;
            array_push($result["errors"],"O estado é inválido");
        }




        if(!isset($city) || empty($city)){
            $result["status"] = false;
            array_push($result["errors"],"A cidade é inválida");
        }
        
        if(!isset($address) || empty($address)){
            $result["status"] = false;
            array_push($result["errors"],"O endereço é inválido");
        }

        if(!isset($zip) || empty($zip)){
            $result["status"] = false;
            array_push($result["errors"],"O CEP é inválido");
        }

        if(!isset($bnumber) || empty($bnumber)){
            $result["status"] = false;
            array_push($result["errors"],"O CNPJ é inválido");
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


    function createCompany($email, $name, $password, $responsible, $phone, $state, $city, $address, $zip, $bnumber)
    {
        $result = validateCompany($email,$name,$password, $responsible, $phone, $state, $city, $address, $zip, $bnumber);

        if($result["status"]){
            try{
                global $database;
                $query = $database->prepare("INSERT INTO companies(email, name, password, responsible, phone, credits, state, city, address ,zip , bnumber) VALUES (:email, :name, :password, :responsible, :phone, :credits, :state, :city, :address ,:zip, :bnumber)");
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query->bindValue(":email",$email, PDO::PARAM_STR);
                $query->bindValue(":name",$name, PDO::PARAM_STR);
                $query->bindValue(":password",$hash);
                $query->bindValue(":responsible",$responsible, PDO::PARAM_STR);
                $query->bindValue(":phone",$phone, PDO::PARAM_STR);
                $query->bindValue(":credits",10);
                $query->bindValue(":state", $state, PDO::PARAM_STR);
                $query->bindValue(":city", $city, PDO::PARAM_STR);
                $query->bindValue(":address",$address, PDO::PARAM_STR);
                $query->bindValue(":zip",$zip, PDO::PARAM_STR);
                $query->bindValue(":bnumber",$bnumber,PDO::PARAM_STR);
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

    function getCompanies(){
        global $database;
        $result = [];
        $query = $database->query("SELECT email, name, responsible, phone, credits, bnumber FROM companies LIMIT 4");
        //array_push($result,);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

?>