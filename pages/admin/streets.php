<h4>Add street</h4>
            <table class="table table-striped mb-3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Street name</th>
                        <th>City</th>
                        <th>Country</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $querySelectStreet = "SELECT S.Id, S.StreetName, C.CityName, Co.CountryName  FROM Streets S LEFT JOIN Cities C on C.Id = S.CityId LEFT JOIN Countries Co on C.CountryId = Co.Id";
                    $res = mysqli_query($link, $querySelectStreet);
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
                            
                            echo "<td><input type='checkbox' class='form-check-input'
                         name='delstreets[]' value='" . $row[0] . "' form='streetForm'></input></td>";
                            echo "</tr>";
                        }
                    mysqli_free_result($res);
                    ?>
                </tbody>
            </table>

            
            <form method="post" id="streetForm">
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
                    <select class="form-select" name="cityId" id="cityId">
                        <option value="0" selected>Choose city...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="streetName" class="form-label">Street name</label>
                    <input type="text" class="form-control" id="streetName" placeholder="Add new street..." name="streetName">
                </div>
               

                <button type="submit" class="btn btn-sm btn-success" name="addstreet">Add</button>
                <button type="submit" class="btn btn-sm btn-warning" name="delstreet">Delete</button>
            </form>
            <?
            if (isset($_POST["addstreet"])) {
                $cityId = $_POST["cityId"];
                $streetName = $_POST["streetName"];
                $queryAddStreet = "INSERT INTO `Streets`(`StreetName`,`CityId`) VALUES ('$streetName','$cityId')";
                $res = mysqli_query($link, $queryAddStreet);
                $err = mysqli_errno($link);
                if ($err)
                    $_SESSION["streetadderr"] = "Error when adding street!";
                else {
                    unset($_SESSION["streetadderr"]);
                    echo "<script>
                location = document.URL;
                </script>";
                }
                mysqli_free_result($res);
            }
            if (isset($_POST["delstreet"])) {
                if (isset($_POST["delstreets"])) {
                    $delstreets = $_POST["delstreets"];
                    $count2 = count($delstreets);
                    // var_dump($delcountries);
                    foreach ($delstreets as $streetId) {
                        $queryDeleteStreet = "DELETE FROM Streets WHERE Id=$streetId";
                        mysqli_query($link, $queryDeleteStreet);
                    }
                    echo "<script>
                alert('" . $count2 . " streets was deleted!');
                location = document.URL;
                </script>";
                }
            }
            ?>