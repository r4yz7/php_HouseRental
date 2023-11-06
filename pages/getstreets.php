<?
    include_once("functions.php");
    $link = connectDb("localhost","root","","houseDb",3306);
    if(isset($_GET["id"])){
         $cityId = $_GET["id"];
        $q1 = "SELECT Id, StreetName FROM Streets WHERE CityId = $cityId";
    $str = "<option value='0' selected>Choose street...</option>";
    $res = mysqli_query($link, $q1);
    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        $str.="<option value='" . $row[0] . "'>" . $row[1] . "</option>";
    }
    echo $str;
    mysqli_free_result($res);
}
