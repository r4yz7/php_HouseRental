
<div class="position-absolute top-50 start-50 translate-middle border p-4 rounded">
        <h3>Login to the website</h3>
<?
if(isset($_SESSION["ruser"]) or isset($_SESSION["radmin"]))
echo "<script>
location = document.URL;
</script>";
    unset($_SESSION["ruser"]);
    unset($_SESSION["radmin"]);
?>
<form method="post">
    <div class="mb-3">
        <label class="form-label" for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="mb-3">
        <label class="form-label" for="psswrd">Password</label>
        <input type="password" class="form-control" name="psswrd" id="psswrd">
    </div>
    <button type="submit" class="btn btn-outline-success" name="login">Log In</button>
    <a href="?page=3" class="btn btn-outline-primary">Sign Up</a>
</form>
</div>

<?
if(isset($_POST["login"])){
    $name= $_POST["username"];
    $passwrd = $_POST["psswrd"];
    $link = connectDb("localhost","root","","houseDb",3306);
    $querySelectUser =  "SELECT Login,Password,RoleId FROM `User` WHERE `Login` = '$name' and `Password` = '$passwrd'";
    $res = mysqli_query($link,$querySelectUser);
    if(mysqli_num_rows($res)>0){
        $row = mysqli_fetch_array($res,MYSQLI_NUM);
        $id= $row[2];
        if($id==1){
            $_SESSION["radmin"] = $name;
        }else{
            $_SESSION["ruser"]= $name;
        }
        echo "<script>
        location = 'index.php';
    </script>";
    }
    else{
        echo "<script>
         alert('Incorrect login or password');
     </script>"; 
    }
}
?>
