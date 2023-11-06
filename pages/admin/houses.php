<h4>Add house</h4>
            <table class="table table-striped mb-3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>House number</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Street</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $querySelectHouse = "SELECT H.Id, H.Title, H.Description, H.Price, H.HouseNumber, Co.CountryName, Ci.CityName, S.StreetName FROM Houses H LEFT JOIN Streets S on S.Id = H.StreetId LEFT JOIN Cities Ci on Ci.Id = S.CityId LEFT JOIN Countries Co on Co.Id = Ci.CountryId";
                    $res = mysqli_query($link, $querySelectHouse);
                    $err = mysqli_errno($link);
                    if ($err) {
                        echo "<div class='alert alert-warning'>$err</div>";
                    } else
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            echo "<tr>";
                            echo "<td>$row[0]</td>";
                            echo "<td>$row[1]</td>";
                            echo "<td>$row[2]</td>";
                            echo "<td>$row[3]</td>";
                            echo "<td>$row[4]</td>";
                            echo "<td>$row[5]</td>";
                            echo "<td>$row[6]</td>";
                            echo "<td>$row[7]</td>";
                            echo "<td><input type='checkbox' class='form-check-input'
                         name='delhouses[]' value='" . $row[0] . "' form='houseForm'></input></td>";
                            echo "</tr>";
                        }
                    mysqli_free_result($res);
                    ?>
                </tbody>
            </table>


            <form method="post" id="houseForm">
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="countryid" onchange="getCities(event)">
                        <option value="0" selected>Choose country</option>
                        <?
                        $q5 = "SELECT * FROM Countries";
                        $res = mysqli_query($link, $q5);
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                        }
                        mysqli_free_result($res);
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="cityId" id="cityId" onchange="getStreets(event)">
                        <option value="0" selected>Choose city...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="streetId" id="streetId">
                        <option value="0" selected>Choose street...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="houseNumber" class="form-label">House number</label>
                    <input type="number" class="form-control" id="houseNumber" placeholder="Add new house number..." name="houseNumber">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Add new title..." name="title">
                </div>
                <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>     
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" placeholder="Add new price..." name="price">
                </div>

                <button type="submit" class="btn btn-sm btn-success" name="addhouse">Add</button>
                <button type="submit" class="btn btn-sm btn-warning" name="delhouse">Delete</button>
            </form>
            <?
            if (isset($_POST["addhouse"])) {
                $streetId = $_POST["streetId"];
                $title = $_POST["title"];
                $houseNumber = $_POST["houseNumber"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                $queryAddHouse = "INSERT INTO `Houses`(`Title`, `Description`, `Price`, `HouseNumber`, `StreetId`) VALUES ('$title','$description','$price','$houseNumber','$streetId')";
                $res = mysqli_query($link, $queryAddHouse);
                $err = mysqli_errno($link);
                if ($err)
                    $_SESSION["houseadderr"] = "Error when adding house!";
                else {
                    unset($_SESSION["houseadderr"]);
                    echo "<script>
                location = document.URL;
                </script>";
                }
                mysqli_free_result($res);
            }
            if (isset($_POST["delhouses"])) {
                if (isset($_POST["delhouses"])) {
                    $delhotels = $_POST["delhouses"];
                    $count2 = count($delhotels);
                    // var_dump($delcountries);
                    foreach ($delhotels as $hotelId) {
                        $queryDeleteHotel = "DELETE FROM Houses WHERE id=$hotelId";
                        mysqli_query($link, $queryDeleteHotel);
                    }
                    echo "<script>
                alert('" . $count2 . " houses was deleted!');
                location = document.URL;
                </script>";
                }
            }
            ?>
