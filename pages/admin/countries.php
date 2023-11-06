<h4 class="mt-3">Add countries</h2>
<div class="mb-3">
<table class="table table-striped mb-3">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Country name</th>
                                <th>Delete</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?
                            $querySelectCountry = "SELECt * FROM Countries";
                            $link = connectDb("localhost", "root", "", "houseDb", 3306);
                            $res = mysqli_query($link, $querySelectCountry);
                            $err = mysqli_errno($link);
                            if (!$err) {
                                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                    echo "<tr>";
                                    echo "<td>$row[0]</td>";
                                    echo "<td>$row[1]</td>";
                                    echo "<td><input type='checkbox' class='form-check-input' name='delcountries[]' value='" . $row[0] . "' form='countryform'></input></td>";
                                    echo "</tr>";
                                }
                                mysqli_free_result($res);
                            }
                            ?>
                        </tbody>
                    </table>
                    <form method="POST" id="countryform">
                        <div class="mb-3">
                            <label for="countryname" class="form-label">Country name</label>
                            <input type="text" class="form-control" id="countryname" placeholder="Add new country..." name="countryname">
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary" name="addCountry">Add</button>
                        <button type="submit" class="btn btn-sm btn-outline-danger" name="delcountry">Delete</button>
                    </form>
                    <?
                    if (isset($_POST["delcountry"])) {
                        if (isset($_POST["delcountries"])) {
                     
                            $delcountries = $_POST["delcountries"];
                            $count = count($delcountries);
                            var_dump($delcountries);
                            foreach ($delcountries as $countryId) {
                                $q3 = "DELETE FROM Countries WHERE id=$countryId";
                                mysqli_query($link, $q3);
                            }
                            echo "<script>
                            alert('" . $count . " countries removed!');
                            location = document.URL;
                            </script>";
                        }
                        mysqli_free_result($res);
                    }
                    if (isset($_POST["addCountry"])) {
                        
                        $name = $_POST["countryname"];
                        $link = connectDb("localhost", "root", "", "houseDb", 3306);
                        $queryInsertCountry = "INSERT INTO `Countries`(`CountryName`) VALUES ('$name')";
                        $res = mysqli_query($link, $queryInsertCountry);
                        $err = mysqli_errno($link);
                        if (!$err) {
                            echo "<script>
                        alert('Country added successfully!');
                        location = document.URL;
                    </script>";
                        } else {
                            echo "<script>
                        alert('An error occurred while adding a country');
                    </script>";
                        }
                        mysqli_free_result($res);
                    }

                    ?>
</div>
