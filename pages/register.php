<div class="container">


    <?
    
    $errLog = "";
    $errEmail = "";
    $errPass = "";
    if (isset($_POST["signup"])) {
        $name = $_POST["username"];
        $email = $_POST["email"];
        $pass1 = $_POST["psswrd"];
        $pass2 = $_POST["psswrd2"];
        $t = 0;
       
        if (!validateLogin($name)) {
            $t++;
            $errLog = "Enter another login";
        }
        if (!validateEmail($email)) {
            $t++;
            $errEmail = "Enter another email";
        }
        if (!validatePass($pass1, $pass2)) {
            $t++;
            $errPass = "Password must be 8 characters or more and they must match";
        }
        if ($t == 0) {
            $errPass = "";
            $errLog = "";
            $errEmail = "";
            $link = connectDb("localhost", "root", "", "houseDb", 3306);
            $queryReg = "INSERT INTO `User`(`Login`, `Email`, `Password`, `RoleId`) VALUES ('$name','$email','$pass1',2)";
            // $res = mysqli_query($link,$queryReg);
            // $err = mysqli_errno($link);
            try{
                mysqli_query($link,$queryReg);
                echo "<script>
                    location = 'index.php?page=2';
            </script>";
            }
            catch(mysqli_sql_exception $ex){
                if($ex->getCode() == 1062){
                    echo "<script>alert('Enter another login or email')</script>";
                    echo "<script>
                            setTimeout(()=>{
                                location = 'index.php?page=3'
                            }, 2500);
                        </script>";
                }
            }
        }
    }
    ?>
    <div class="position-absolute top-50 start-50 translate-middle border p-4 rounded">
        <h3>Register to the website</h3>
    <form method="post">
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <span class='errMsg'>*<?echo $errLog?></span>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <span class='errMsg'>*<?echo $errEmail?></span>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label class="form-label" for="psswrd">Password</label>
            <span class='errMsg'>*<?echo $errPass?></span>
            <input type="password" class="form-control" name="psswrd" id="psswrd">
        </div>
        <div class="mb-3">
            <label class="form-label" for="psswrd2">Confirm password</label>
            <span class='errMsg'>*<?echo $errPass?></span>
            <input type="password" class="form-control" name="psswrd2" id="psswrd2">
        </div>
        <button type="submit" class="btn btn-outline-success" name="signup">Sign Up</button>
        <a href="?page=2" class="btn btn-outline-primary">Log In</a>
    </form>
    </div>
    
</div>

<?


?>