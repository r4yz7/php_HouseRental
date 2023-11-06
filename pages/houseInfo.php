<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Аренда дома</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>


<main class="container my-5">
  <section>
   
    <div class="card">
      <div class="row g-0">
        <div class="col-md-6">
          <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <?
        $id = $_GET["id"];
        $link = connectDb("localhost","root","","houseDb",3306);
        // $querySelectImages = "SELECT H.ImagePath FROM Images I LEFT JOIN Houses H on H.Id = I.HouseId WHERE H.Id = $id";
        $querySelectImages = "SELECT I.ImagePath FROM Houses H LEFT JOIN Images I ON I.HouseId = H.Id WHERE H.Id = $id";
        $res = mysqli_query($link, $querySelectImages);
        $err = mysqli_errno($link);
        if($err){
            echo "<div class='alert alert-warning'>$err</div>";
        }
        else{
          $temp = 0;
             while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                
             
    ?>

              <div class="carousel-item <?echo $temp == 0 ? "active" : " "?>">
                <img src="<?echo $row[0]?>" class="d-block w-100" alt="Фото <?echo $temp?>">
              </div>
              <?
              $temp++;
              }}
              mysqli_free_result($res)
            ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
        </div>
        <?
        $link = connectDb("localhost","root","","houseDb",3306);
        // $querySelectImages = "SELECT H.ImagePath FROM Images I LEFT JOIN Houses H on H.Id = I.HouseId";
        $querySelectHouse = "SELECT H.Id, H.Title, H.Description, H.Price, H.HouseNumber,I.ImagePath, S.StreetName, Ci.CityName, Co.CountryName FROM Houses H LEFT JOIN Images I ON I.HouseId = H.Id LEFT JOIN Streets S ON S.Id = H.StreetId LEFT JOIN Cities Ci ON Ci.Id = S.CityId LEFT JOIN Countries Co ON Co.Id = Ci.CountryId WHERE H.Id = $id" ;
        $res = mysqli_query($link, $querySelectHouse);
        $err = mysqli_errno($link);
        if($err){
            echo "<div class='alert alert-warning'>$err</div>";
        }
        else{
          $row = mysqli_fetch_array($res,MYSQLI_NUM);
          ?>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title"><?echo $row[1]?></h5>
            <p class="card-text">Location: <? echo "$row[8], $row[7], $row[6] $row[4]"?></p>
            <p class="card-text">Description: <?echo $row[2]?></p>
            <p class="card-text">Price: <? echo "$row[3] UAH в месяц"?></p>
            <button class="btn btn-outline-primary">Write to the seller</button>
          </div>
        </div>
        <?
        }?>
      </div>
    </div>
  </section>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

