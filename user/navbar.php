<!-- Header Notifications Area Start -->
<?php
// session_start(); 
if (isset($_SESSION['User-Email'])) { ?>

    <div class="w-100 d-flex justify-content-between align-items-center ">
        <!-- Header Logo (Header Left) Start -->
        <div class="header-logo col-auto">
            <a href="index.php">
                <!-- <img src="assets/images/logo/logo.png" alt="">
                    <img src="assets/images/logo/logo-light.png" class="logo-light" alt=""> -->
                <h1 class=" fw-700">AGRO Shop</h1>
            </a>
        </div><!-- Header Logo (Header Left) End -->
        <div class="col-auto p-3 container w-75 gap-4  mt-0" style="    display: flex; justify-content: end; ">



            <ul class="header-notification-area">



                <!--Mail-->
                <div class="col-auto">

                    <ul class="header-notification-area d-flex  gap-4 ">

                        <!--Language-->
                        <li class="adomx-dropdown position-relative col-auto">
                            <a class=" fw-bold" href="index.php">Product</a>
                        </li>

                        <li class="adomx-dropdown position-relative col-auto">
                            <a class=" fw-bold" href="my-order.php">My Order</a>
                        </li>

                    </ul>

                </div>

            </ul>
            <ul class="header-notification-area d-flex gap-4 ">



                <!--Mail-->
                <div class="col-auto">

                    <ul class="header-notification-area">

                        <!--Language-->
                        <li class="adomx-dropdown position-relative col-auto">
                            <a href="cart.php"><i class="ti-shopping-cart"></i></a>


                        </li>



                    </ul>

                </div>


                <!--User-->
                <li class="adomx-dropdown col-auto">
                    <a class="toggle" href="#">
                        <span class="user">
                            <span class="avatar">
                                <img src="assets/images/avatar/avatar-1.png" alt="">
                                <span class="status"></span>
                            </span>
                            <span class="name">
                                <?php echo $_SESSION["User-Name"] ?>
                            </span>
                        </span>
                    </a>

                    <!-- Dropdown -->
                    <div class="adomx-dropdown-menu dropdown-menu-user">
                        <div class="head">
                            <h5 class="name"><a href="#">
                                    <?php echo $_SESSION["User-Name"] ?>
                                </a></h5>
                            <a class="mail" href="#">
                                <?php echo $_SESSION["User-Email"] ?>
                            </a>
                        </div>
                        <div class="body">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#changePasswordModal"><i
                                            class="zmdi zmdi-account"></i>Change Password</a></li>


                                <!-- <li><a href="#"><i class="zmdi zmdi-wallpaper"></i>Activity</a></li> -->
                                <li><a href="logout.php"><i class="zmdi zmdi-email-open"></i>Log-Out</a></li>
                            </ul>


                        </div>
                    </div>

                </li>

            </ul>
        </div>
    </div>
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your change password form goes here -->
                    <form id="changePasswordForm" class="d-flex flex-column gap-2" method="POST"
                        action="chang-password.php">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="col-auto p-3 container " style="    display: flex; justify-content: end; ">
        <ul class="header-notification-area">



            <!--Mail-->
            <div class="col-auto">

                <ul class="header-notification-area">

                    <!--Language-->
                    <li class="adomx-dropdown position-relative col-auto">
                        <a class=" fw-bold button button-primary" href="login.php">Login</a>
                    </li>
                    <!-- 
                    <li class="adomx-dropdown position-relative col-auto">
                        <a class=" fw-bold" href="my-order.php">My Order</a>
                    </li> -->

                </ul>

            </div>

        </ul>

    </div>
    <?php
}
;
?>