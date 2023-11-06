<?
    include_once("functions.php");
    $queryCreateCountries = "CREATE TABLE Countries(
        Id int not null AUTO_INCREMENT PRIMARY KEY,
        CountryName varchar(64) UNIQUE not null
    );";
    $queryCreateCity = "CREATE TABLE Cities(
        Id int not null AUTO_INCREMENT PRIMARY KEY,
        CityName varchar(64) not null,
        CountryId int not null,
        FOREIGN KEY(CountryId) REFERENCES Countries(Id)
    );";
     $queryCreateRole = "CREATE TABLE Roles(
        Id int not null AUTO_INCREMENT PRIMARY KEY,
        RoleName varchar(64) not null
    );";
    $queryCreateUser = "CREATE TABLE User(
        Id int not null AUTO_INCREMENT PRIMARY KEY,
        Login varchar(64) not null UNIQUE,
        Email varchar(128) not null UNIQUE,
        Password varchar(64) not null,
        RoleId int not null,
        FOREIGN KEY(RoleId) REFERENCES Roles(Id)
    );";
    $queryCreateHouse = "CREATE TABLE Houses(
        Id int not null AUTO_INCREMENT PRIMARY KEY,
        Title text not null,
        Description text not null,
        Price INT UNSIGNED not null,
        HouseNumber int not null,
        StreetId int not null,
        FOREIGN KEY(StreetId) REFERENCES Streets(Id)
    );";
    $queryCreateStreet = "CREATE TABLE Streets(
        Id int not null AUTO_INCREMENT PRIMARY KEY,
        StreetName varchar(32) not null,
        CityId int not null,
        FOREIGN KEY(CityId) REFERENCES Cities(Id)
    )";
    $queryCreatePhotos = "CREATE TABLE Images(
    Id int not null auto_increment primary key,
    ImagePath varchar(255),
    HouseId int not null,
    foreign key(HouseId) references Houses(Id)
    ON DELETE CASCADE);";

    $link = connectDb("localhost","root","","houseDb",3306);
//     mysqli_query($link,  $queryCreateCountries);
// $err = mysqli_errno($link);
// if($err)
// echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Countries</div>";
// mysqli_query($link,  $queryCreateCity);
// $err = mysqli_errno($link);
// if($err)
// echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Cities</div>";
mysqli_query($link,  $queryCreateStreet);
$err = mysqli_errno($link);
if($err)
echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Users</div>";
mysqli_query($link,  $queryCreateHouse);
$err = mysqli_errno($link);
if($err)
echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Hotels</div>";
mysqli_query($link,  $queryCreatePhotos);
$err = mysqli_errno($link);
if($err)
echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Images</div>";
mysqli_query($link,  $queryCreateRole);
$err = mysqli_errno($link);
if($err)
echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Roles</div>";

mysqli_query($link,  $queryCreateUser);
$err = mysqli_errno($link);
if($err)
echo "<div class='alert alert-danger' role='alert'>Db error $err. Table Users</div>";

