<div class="container border border-bottom-0 border-top-0 p-3">
    <h2 class="mb-4">Список доступных домов</h2>
    <div class="mb-3">
        <form method="post">
            <div class="form-check form-check-inline">
                <select class="form-select" name="cName" id="cName" onchange="getCities(event)">
                    <option value="0" selected>Choose country...</option>
                    <?
                    $q1 = "SELECT * FROM Countries";
                    $link = connectDb("localhost", "root", "", "houseDb", 3306);
                    $res = mysqli_query($link, $q1);
                    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                        echo "<option value='$row[0]'>$row[1]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-check form-check-inline">
                <select class="form-select" name="ciName" id="ciName">
                    <option value="0" name="cityId" id="cityId" selected>Choose city...</option>
                </select>
            </div>
            <button class="btn btn-sm btn-outline-success" name="search" id="search" type="submit">Search</button>
        </form>
    </div>

    <?
    if (isset($_POST["cName"]) or isset($_POST["ciName"])) {
        $co = $_POST["cName"];
        $ci = $_POST["ciName"];
    }

    if (isset($_POST["search"]) and $co != 0) {
        if ($co != 0 and $ci == 0) {
    ?>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div>
                        <?
                        $link = connectDb("localhost", "root", "", "houseDb", 3306);
                        $querySelectHouse = "SELECT H.Id, H.Title,H.Description,H.Price,S.StreetName,Ci.CityName, Co.CountryName, H.HouseNumber FROM Houses H LEFT JOIN Streets S ON S.Id = H.StreetId LEFT JOIN Cities Ci ON Ci.Id = S.CityId LEFT JOIN Countries Co ON Co.Id = Ci.CountryId WHERE Co.Id = $co";
                        $res1 = mysqli_query($link, $querySelectHouse);
                        $err = mysqli_errno($link);
                        if ($err)
                            echo "<div class='alert alert-warning'>$err</div>";
                        else
                            while ($row = mysqli_fetch_array($res1, MYSQLI_NUM)) {
                                $querySelectPhoto = "SELECT I.ImagePath FROM Houses H LEFT JOIN Images I ON H.Id = I.HouseId WHERE H.Id = $row[0] LIMIT 1 ";
                                $res2 = mysqli_query($link, $querySelectPhoto);
                                $imageRow = mysqli_fetch_array($res2, MYSQLI_NUM);
                                $imagePath = $imageRow[0];
                                if ($imagePath === null)
                                    $imagePath = "images/icon-image-not-found-free-vector.jpg";
                                mysqli_free_result($res2);

                        ?>
                            <div class="row g-0 mb-4">
                                <div class="col-md-4  ">
                                    <?
                                    echo "<img src='$imagePath' class='card-img-top' alt='$row[1]'>"
                                    ?>
                                </div>
                                <div class="col-md-8 border p-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><? echo $row[1] ?></h5>
                                        <p class="card-text">Location: <? echo "$row[6],$row[5],$row[4] $row[7]" ?></p>
                                        <p class="card-text">Price: <? echo "$row[3] UAH" ?></p>
                                        <?
                                         if (isset($_SESSION["radmin"]) or isset($_SESSION["ruser"])){
                                         ?>
                                        <a href="?page=5&id=<? echo $row[0] ?>" class="btn btn-outline-info">More</a>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        <?
                            }
                        mysqli_free_result($res1);
                        ?>
                    </div>


                </div>

            </div>
        <?
        } else if ($ci != 0) {
        ?>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div>
                        <?
                        $link = connectDb("localhost", "root", "", "houseDb", 3306);
                        $querySelectHouse = "SELECT H.Id, H.Title,H.Description,H.Price,S.StreetName,Ci.CityName, Co.CountryName, H.HouseNumber FROM Houses H LEFT JOIN Streets S ON S.Id = H.StreetId LEFT JOIN Cities Ci ON Ci.Id = S.CityId LEFT JOIN Countries Co ON Co.Id = Ci.CountryId WHERE Co.Id = $co and Ci.Id = $ci";
                        $res1 = mysqli_query($link, $querySelectHouse);
                        $err = mysqli_errno($link);
                        if ($err)
                            echo "<div class='alert alert-warning'>$err</div>";
                        else
                            while ($row = mysqli_fetch_array($res1, MYSQLI_NUM)) {
                                $querySelectPhoto = "SELECT I.ImagePath FROM Houses H LEFT JOIN Images I ON H.Id = I.HouseId WHERE H.Id = $row[0] LIMIT 1 ";
                                $res2 = mysqli_query($link, $querySelectPhoto);
                                $imageRow = mysqli_fetch_array($res2, MYSQLI_NUM);
                                $imagePath = $imageRow[0];
                                if ($imagePath === null)
                                    $imagePath = "images/icon-image-not-found-free-vector.jpg";
                                mysqli_free_result($res2);

                        ?>
                            <div class="row g-0 mb-4">
                                <div class="col-md-4  ">
                                    <?
                                    echo "<img src='$imagePath' class='card-img-top' alt='$row[1]'>"
                                    ?>
                                </div>
                                <div class="col-md-8 border p-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><? echo $row[1] ?></h5>
                                        <p class="card-text">Location: <? echo "$row[6],$row[5],$row[4] $row[7]" ?></p>
                                        <p class="card-text">Price: <? echo "$row[3] UAH" ?></p>
                                        <!-- <a href="?page=5&id=<?
                                        //  echo $row[0] 
                                         ?>" class="btn btn-outline-info">More</a> -->
                                         <?
                                         if (isset($_SESSION["radmin"]) or isset($_SESSION["ruser"])){
                                         ?>
                                        <a href="?page=5&id=<? echo $row[0] ?>" class="btn btn-outline-info">More</a>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        <?
                            }
                        mysqli_free_result($res1);
                        ?>
                    </div>


                </div>

            </div>
        <?
        }
    } else {

        ?>


        <div class="row">
            <div class="col-md-12 mb-4">
                <div>
                    <?
                    $link = connectDb("localhost", "root", "", "houseDb", 3306);
                    $querySelectHouse = "SELECT H.Id, H.Title,H.Description,H.Price,S.StreetName,Ci.CityName, Co.CountryName, H.HouseNumber FROM Houses H LEFT JOIN Streets S ON S.Id = H.StreetId LEFT JOIN Cities Ci ON Ci.Id = S.CityId LEFT JOIN Countries Co ON Co.Id = Ci.CountryId";
                    $res1 = mysqli_query($link, $querySelectHouse);
                    $err = mysqli_errno($link);
                    if ($err)
                        echo "<div class='alert alert-warning'>$err</div>";
                    else
                        while ($row = mysqli_fetch_array($res1, MYSQLI_NUM)) {
                            $querySelectPhoto = "SELECT I.ImagePath FROM Houses H LEFT JOIN Images I ON H.Id = I.HouseId WHERE H.Id = $row[0] LIMIT 1 ";
                            $res2 = mysqli_query($link, $querySelectPhoto);
                            $imageRow = mysqli_fetch_array($res2, MYSQLI_NUM);
                            $imagePath = $imageRow[0];
                            if ($imagePath === null)
                                $imagePath = "images/icon-image-not-found-free-vector.jpg";
                            mysqli_free_result($res2);

                    ?>
                        <div class="row g-0 mb-4">
                            <div class="col-md-4  ">
                                <?
                                echo "<img src='$imagePath' class='card-img-top' alt='$row[1]'>"
                                ?>
                            </div>
                            <div class="col-md-8 border p-4">
                                <div class="card-body">
                                    <h5 class="card-title"><? echo $row[1] ?></h5>
                                    <p class="card-text">Location: <? echo "$row[6],$row[5],$row[4] $row[7]" ?></p>
                                    <p class="card-text">Price: <? echo "$row[3] UAH" ?></p>
                                    <!-- <a href="?page=5&id=<? 
                                    // echo $row[0]
                                     ?>" class="btn btn-outline-info">More</a> -->
                                     <?
                                         if (isset($_SESSION["radmin"]) or isset($_SESSION["ruser"])){
                                         ?>
                                        <a href="?page=5&id=<? echo $row[0] ?>" class="btn btn-outline-info">More</a>
                                        <?}?>
                                </div>
                            </div>
                        </div>
                    <?
                        }
                    mysqli_free_result($res1);
                    ?>
                </div>


            </div>

        </div>
    <? } ?>

</div>