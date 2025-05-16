<?php
session_start();
include 'message.php';
include 'comfig.php';
?>
<!doctype html>
<html class="no-js" lang="en">

<head>

    <?php include 'header.php' ?>

</head>

<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Sign-Up</h1>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                            </div>

                            <div class="login-register-form">
                                <form action="seller-sign-up.php" method="POST">
                                    <div class="row">
                                        <!-- <div class="col-12 mb-20">
                                           <p>Owner Name<span style="color:red;">*</span></p>
                                            <input class="form-control" type="text" placeholder="Owner Name"
                                                pattern="[A-Za-z\s]+" title="(only letters and spaces)" required=""
                                                name="owner">
                                        </div> -->
                                        <div class="col-12 mb-20">
                                            <p>Owner Name<span style="color:red;">*</span></p>
                                            <input class="form-control" type="text" placeholder="Owner Name" required=""
                                                pattern="[A-Za-z\s]+" title="(only letters and spaces)" name="owner">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <p>Shop Name<span style="color:red;">*</span></p>
                                            <input class="form-control" type="text" placeholder="Shop Name" required=""
                                                pattern="[A-Za-z\s]+" title="(only letters and spaces)" name="name">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <p> Email ID <span style="color:red;"> *</span></p>
                                            <input class="form-control" type="email" placeholder=" Email ID" required=""
                                                name="email">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <p>Phone Number<span style="color:red;"> *</span></p>

                                            <input class="form-control" type="text" placeholder="Phone Number"
                                                required="" pattern="[0-9]{10}"
                                                title="Please enter a 10-digit numeric value" name="number">
                                        </div>

                                        <h4 for="formLayoutEmail1">Address<span style="color:red;"> *</span></h4>
                                        <div class="col-6 mb-20">
                                            <label for="">State<span style="color:red;"> *</span></label>
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
                                            <label for="formLayoutEmail1">Area<span style="color:red;"> *</span></label>
                                            <select class="form-control" id="areaId" name="addres" required>


                                            </select>
                                        </div>





                                        <div class="col-12 mb-20">
                                            <label for="stateId">Password<span style="color:red;">
                                                    *</span></label><input class="form-control" type="password"
                                                placeholder="Password" required="Enter Password" name="password">
                                        </div>
                                        <div class="col-12">

                                        </div>
                                        <div class="col-12 mt-10 d-flex justify-content-between">
                                            <button class="button button-primary button-outline">Sign Up
                                                <b>></b></button>
                                            <a href="../index.php" class="btn">Menu</a>
                                            <a href="login.php" class="btn">Log in There > > ></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12" style="height: auto;">
                        <div class="content">
                            <h1>Sign in</h1>
                            <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                        </div>
                    </div>

                </div>
            </div>
            <!--  -->
            <?php include 'footer.php' ?>
        </div><!-- Content Body End -->

    </div>

    <!-- JS
============================================ -->

    <?php include 'js-links.php' ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $("select#stateId").change(function () {
                var st = $("#stateId option:selected").val();
                console.log(st);
                // $("#areaId").html("<option selected disabled value="">Select State</option>");
                // console.log(data);
                // alert(st);
                $.ajax({
                    type: "POST",
                    url: "city-api.php",
                    data: { stateId: st }
                }).done(function (data) {
                    $("#cityId").html(data);
                    console.log(data);
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("select#cityId").change(function () {
                var st = $("#stateId option:selected").val();
                var ct = $("#cityId option:selected").val();
                console.log(st);
                // alert(st);
                $.ajax({
                    type: "POST",
                    url: "area-api.php",
                    data: { stateId: st, cityId: ct }
                }).done(function (data) {
                    $("#areaId").html(data);
                    console.log(data);
                });
            });
        });
    </script>




</body>

</html>