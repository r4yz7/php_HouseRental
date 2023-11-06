<h3>Photos</h3>
            <form method="post" id="photosform" enctype="multipart/form-data">
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
                    <select class="form-select" name="streetId" id="streetId" onchange="getHouses(event)">
                        <option value="0" selected>Choose street...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="house" id="house">
                        <option value="0" selected>Choose house...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Upload hotel photos</label>
                    <input class="form-control" type="file" id="images" name="images[]" multiple>
                </div>
                <button type="submit" class="btn btn-sm btn-success" name="addphotos">Add</button>
            </form>
            <?
            if (isset($_POST["addphotos"])) {
                $house = $_POST["house"];
                foreach ($_FILES["images"]["name"] as $k => $v) {
                    if ($_FILES["images"]["error"][$k] != 0) {
                        echo "<script>alert('Upload file error: " . $v . " ')</script>";
                        continue;
                    }
                    if (move_uploaded_file($_FILES["images"]["tmp_name"][$k], "images/" . $v)) {
                        $path = "images/" . $v;
                        $q11 = "INSERT Images(HouseId, ImagePath) 
                        VALUES(" . $house . ", '" . $path . "')";
                        $res = mysqli_query($link, $q11);
                        $err = mysqli_errno($link);
                        if ($err)
                            $_SESSION["photosadderr"] = "Error when adding photo!";
                        else {
                            unset($_SESSION["photosadderr"]);
                            echo "<script>
                location = document.URL;
                </script>";
                        }
                    }
                }
                mysqli_free_result($res);
            }
            ?>