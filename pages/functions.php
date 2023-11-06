<?
    function connectDb($hostname, $name,$pass,$dbname,$port){
        $link = mysqli_connect($hostname,$name,$pass,$dbname,$port) or die ("Error connecting to server");
        mysqli_query($link,"set names 'utf8'");
        return $link;
    }
    function validateLogin($login){
        if(!preg_match('/^[a-zA-Z0-9]+$/',$login)){
            return false;
        }
        return true;
    }
    function validateEmail($email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
    }
    function validatePass($pass1,$pass2){
        if($pass1!=$pass2 and $pass1!=null){
            return false;
        }
        return true;
    }
?>