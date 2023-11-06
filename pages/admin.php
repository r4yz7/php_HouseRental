<?
if (!isset($_SESSION['radmin']))
{
echo "<h3/><span style='color:red;'>For Administrators Only!
</span><h3/>";
exit();
}
?>
<div class="container">
    <h2>Admin panel</h2>
</div>
<div class="container  border rounded">
    <div class="row row-cols-2">
        <div class="col">
            <?
            include_once("admin/countries.php");
            ?>
        </div>
        <div class="col">
            <?
            include_once("admin/cities.php");
            ?>
        </div>
    </div>
    <hr>
    <div class="row row-cols-2">
        <div class="col">
            <?
            include_once("admin/streets.php");
            ?>
        </div>
        <div class="col">
            <?
            include_once("admin/houses.php");
            ?>
        </div>
    </div>
    <div class="row row-cols-2">
        <div class="col-auto">
            <?
                include_once("admin/photos.php");
            ?>
        </div>
        <div class="col">
            <table class="table table-striped">        
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Login</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?
                $link = connectDb("localhost","root","","houseDb",3306);
                $querySelectUsers = "SELECT U.Id, U.Login, R.RoleName FROM USER U LEFT JOIN Roles R on R.Id = U.RoleId";
                
                $res = mysqli_query($link,$querySelectUsers);
                while($row = mysqli_fetch_array($res,MYSQLI_NUM)){
                    $querySelectRole = "SELECT * FROM Roles";
                $resRole = mysqli_query($link,$querySelectRole);
                    echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<form method='post'>
                        <input type='hidden' value = '$row[0]' name = 'userId'>
                    <td><select class='form-select' name='roleName' id='roleName'>";
                        while($r2 = mysqli_fetch_array($resRole,MYSQLI_NUM)){
                                echo "<option value='$r2[0]'>$r2[1]</option>";
                        }
                    echo"</select></td>";
                    echo "<td><button name='changeRole' id = 'changeRole' class='btn btn-sm btn-outline-success'>Role Change</button></td>";
                    echo "</form>";
                    echo "</tr>";
                }

                if(isset($_POST["changeRole"])){
                    $userId = $_POST["userId"];
                    $roleId = $_POST["roleName"];
                    $queryUpdateUser = "UPDATE `User` SET `RoleId`='$roleId' WHERE Id = $userId";
                    mysqli_query($link,$queryUpdateUser);
                }
            ?>  
            </tbody>   
            </table>
  
        </div>

    </div>
</div>