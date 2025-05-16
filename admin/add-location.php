<?php include 'verify.php' ?>
<?php include 'message.php' ?>
<?php include 'comfig.php' ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'header.php' ?>

</head>

<body>

    <div class="main-wrapper">


        <!-- Header Section Start -->
        <?php include 'navbar.php' ?>
        <!-- Header Section End -->
        <!-- Side Header Start -->
        <?php include 'sidebar.php' ?>
        <!-- Side Header End -->

        <!-- Content Body Start -->
        <div class="content-body">

            <!-- Page Headings Start -->
            <div class="row justify-content-between align-items-center mb-10">

                <!-- Page Heading Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3 class="title">Add Area</span></h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div>
                <div class="row  justify-content-center ">

                    <!--Default Form Start-->
                    <div class="col-lg-10 col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <!-- <h4 class="title">Default Form</h4> -->
                            </div>
                            <div class="box-body">
                                <form method="POST">
                                    <div class="row mbn-20">

                                        <div class="col-6 mb-20">
                                            <label for="formLayoutUsername1">Select State<span
                                                    style="color:red;">*</span>:</label>

                                            <select class="form-control" id="stateId" name="stateId" required>
                                                <option selected disabled value="">Select State</option>
                                                <?php
                                                // Replace these with your database credentials
                                                

                                                // Fetch states from the state table
                                                $stateQuery = "SELECT `state-id`, `state-name` FROM `state`";
                                                $stateResult = $connect->query($stateQuery);

                                                if ($stateResult->num_rows > 0) {
                                                    while ($row = $stateResult->fetch_assoc()) {
                                                        echo "<option value='" . $row["state-id"] . "'>" . $row["state-name"] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-20">
                                            <label for="formLayoutEmail1">City<span style="color:red;"> *</span></label>
                                            <select class="form-control" id="cityId" name="cityId" required>

                                            </select>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label for="formLayoutUsername1">Area<span style="color:red;">
                                                    *</span></label>
                                            <input type="text" id="formLayoutUsername1" class="form-control"
                                                placeholder="Enter Area" name="area" required="">
                                        </div>
                                        <!-- <div class="col-12 mb-20">
                                            <label for="formLayoutUsername1">Addres</label>
                                            <input type="text" id="formLayoutUsername1" class="form-control"
                                                placeholder="Addres--" name="areaAddress">
                                        </div> -->

                                        <div class="col-12 mb-20">
                                            <input type="submit" value="submit" name="submit" pattern="[A-Za-z\s]+"
                                                title="(only letters and spaces)" class="button button-primary"
                                                placeholder="Submit">
                                        </div>

                                    </div>
                                </form>


                                <?php
                                include 'comfig.php'; // Include your database configuration
                                
                                if (isset($_POST['submit'])) {
                                    // Retrieve the values from the form
                                    $areaName = mysqli_real_escape_string($connect, $_POST['area']);
                                    $areaAddress = mysqli_real_escape_string($connect, $_POST['areaAddress']);
                                    $cityId = (int) $_POST['cityId'];
                                    $stateId = (int) $_POST['stateId'];

                                    // Check if the area with the given values already exists
                                    $checkQuery = "SELECT * FROM area WHERE `area-name` = '$areaName' AND `state-id` = $stateId AND `city-id` = $cityId ";
                                    $checkResult = $connect->query($checkQuery);

                                    if ($checkResult->num_rows > 0) {
                                        $_SESSION['Message'] = 'Area with the same details already exists!';
                                        // header('Location: add-area.php');
                                        // exit();add-location.php
                                        echo "<script>"; // Start JavaScript block
                                        echo 'window.location.href="add-location.php";'; // Use JavaScript to change the page
                                        echo "</script>";
                                    } else {
                                        // Perform an SQL INSERT to add the new area to the database
                                        $insertQuery = "INSERT INTO area (`area-name`, `area-address`, `city-id`, `state-id`) VALUES ('$areaName', '$areaAddress', $cityId, $stateId)";
                                        $insertResult = mysqli_query($connect, $insertQuery);

                                        if ($insertResult) {
                                            $_SESSION['Message'] = 'Area added successfully.';
                                            // header('Location: view-area.php');
                                            // exit();
                                            echo "<script>"; // Start JavaScript block
                                            echo 'window.location.href="view-area.php";'; // Use JavaScript to change the page
                                            echo "</script>";
                                        } else {
                                            $_SESSION['Message'] = 'Failed to add area.Please try again.';
                                            // header('Location: add-area.php');
                                            // exit();
                                            echo "<script>"; // Start JavaScript block
                                            echo 'window.location.href="add-location.php";'; // Use JavaScript to change the page
                                            echo "</script>";
                                        }
                                    }
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>


            </div><!-- Content Body End -->

            <!-- Footer Section Start -->
            <?php include 'footer.php' ?>
            <!-- Footer Section End -->

        </div>

        <!-- JS
============================================ -->

        <?php include 'js-links.php' ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $("select#stateId").change(function () {
                    var st = $("#stateId option:selected").val();
                    console.log(st);
                    // alert(st);
                    $.ajax({
                        type: "POST",
                        url: "addres-api.php",
                        data: { stateId: st }
                    }).done(function (data) {
                        $("#cityId").html(data);
                        console.log(data);
                    });
                });
            });
        </script>
</body>

</html>