<h4 class="mt-3">Add countries</h2>
                    <div class="mb-3">
                        <table class="table table-striped mb-3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Country name</th>
                                    <th>City name</th>
                                    <th>Delete</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?
                                $querySelectCities = "SELECT Ci.Id, Ci.CityName, Co.CountryName FROM Cities Ci LEFT JOIN Countries Co ON Co.Id = Ci.CountryId";
                                $link = connectDb("localhost", "root", "", "houseDb", 3306);
                                $res = mysqli_query($link, $querySelectCities);
                                $err = mysqli_errno($link);
                                if (!$err) {
                                    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                        echo "<tr>";
                                        echo "<td>$row[0]</td>";
                                        echo "<td>$row[1]</td>";
                                        echo "<td>$row[2]</td>";
                                        echo "<td><input type='checkbox' class='form-check-input' name='delcities[]' value='" . $row[0] . "' form='cityform'></input></td>";
                                        echo "</tr>";
                                    }
                                    mysqli_free_result($res);
                                }
                                ?>
                            </tbody>
                        </table>
                        <form method="POST" id="cityform">
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="countryid">
                                    <option value="0" selected>Choose country</option>
                                    <?
                                    $q5 = "SELECT * FROM Countries";
                                    $res = mysqli_query($link, $q5);
                                    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                                    }
                                    ?>
                                    mysqli_free_result($res);
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cityname" class="form-label">City name</label>
                                <input type="text" class="form-control" id="cityname" placeholder="Add new city..." name="cityname">
                            </div>
                            <button type="submit" class="btn btn-sm btn-outline-primary" name="addCity">Add</button>
                            <button type="submit" class="btn btn-sm btn-outline-danger" name="delCity">Delete</button>
                        </form>
                        <?
                        if (isset($_POST["delCity"])) {
                            if (isset($_POST["delcities"])) {

                                $delcities = $_POST["delcities"];
                                $count = count($delcities);
                                var_dump($delcities);
                                foreach ($delcities as $cityId) {
                                    $q3 = "DELETE FROM Cities WHERE Id='$cityId'";
                                    mysqli_query($link, $q3);
                                }
                                echo "<script>
                            alert('" . $count . " countries removed!');
                            location = document.URL;
                            </script>";
                            }
                            mysqli_free_result($res);
                        }
                        if (isset($_POST["addCity"])) {

                            $name = $_POST["cityname"];
                            $countryId = $_POST["countryid"];
                            $link = connectDb("localhost", "root", "", "houseDb", 3306);
                            $queryInsertCity = "INSERT INTO `Cities`(`CityName`, `CountryId`) VALUES ('$name','$countryId')";
                            $res = mysqli_query($link, $queryInsertCity);
                            $err = mysqli_errno($link);
                            if (!$err) {
                                echo "<script>
                        alert('City added successfully!');
                        location = document.URL;
                    </script>";
                            } else {
                                echo "<script>
                        alert('An error occurred while adding a city');
                    </script>";
                            }
                            mysqli_free_result($res);
                        }

                        ?>
                    </div>
