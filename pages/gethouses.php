<?
    include_once("functions.php");
    $link = connectDb("localhost","root","","houseDb",3306);
    if(isset($_GET["id"])){
         $streetId = $_GET["id"];
        $q1 = "SELECT Id, Title FROM Houses WHERE StreetId = $streetId";
    $str = "<option value='0' selected>Choose house...</option>";
    $res = mysqli_query($link, $q1);
    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        $str.="<option value='" . $row[0] . "'>" . $row[1] . "</option>";
    }
    echo $str;
    mysqli_free_result($res);
}
