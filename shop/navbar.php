<div class="header-section" style=" z-index: 10;">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">

            <!-- Header Logo (Header Left) Start -->
            <div class="header-logo col-auto">
                <a href="index.php">
                    <!-- <img src="assets/images/logo/logo.png" alt="">
                    <img src="assets/images/logo/logo-light.png" class="logo-light" alt=""> -->
                    <h1 class=" fw-700">Shop</h1>
                </a>
            </div><!-- Header Logo (Header Left) End -->

            <!-- Header Right Start -->
            <div class="header-right flex-grow-1 col-auto">
                <div class="row justify-content-between align-items-center">

                    <!-- Side Header Toggle & Search Start -->
                    <div class="col-auto">
                        <div class="row align-items-center">

                            <!--Side Header Toggle-->
                            <div class="col-auto"><button class="side-header-toggle"><i
                                        class="zmdi zmdi-menu"></i></button></div>

                            <!--Header Search-->
                            <div class="col-auto">

                                <div class="header-search">

                                    <button class="header-search-open d-block d-xl-none"><i
                                            class="zmdi zmdi-search"></i></button>

                                    <div class="header-search-form">
                                        <form action="#">
                                            <input type="text" placeholder="Search Here">
                                            <button><i class="zmdi zmdi-search"></i></button>
                                        </form>
                                        <button class="header-search-close d-block d-xl-none"><i
                                                class="zmdi zmdi-close"></i></button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- Side Header Toggle & Search End -->

                    <!-- Header Notifications Area Start -->
                    <div class="col-auto">

                        <ul class="header-notification-area">



                            <!--Mail-->




                            <!--User-->
                            <li class="adomx-dropdown col-auto">
                                <a class="toggle" href="#">
                                    <span class="user">
                                        <span class="avatar">
                                            <img src="assets/images/avatar/avatar-1.png" alt="">
                                            <span class="status"></span>
                                        </span>
                                        <span class="name">
                                            <?php echo $_SESSION["Owner"] ?>
                                        </span>
                                    </span>
                                </a>

                                <!-- Dropdown -->
                                <div class="adomx-dropdown-menu dropdown-menu-user">
                                    <div class="head">
                                        <h5 class="name"><a href="#">
                                                <?php echo $_SESSION["Owner"] ?>
                                            </a></h5>
                                        <a class="mail" href="#">
                                            <?php echo $_SESSION["ShopEmail"] ?>
                                        </a>
                                    </div>
                                    <div class="body">
                                        <ul>
                                            <li><a href="#" data-toggle="modal" data-target="#changePasswordModal"><i
                                                        class="zmdi zmdi-account"></i>Change Password</a></li>
                                            <!-- <li><a href="#"><i class="zmdi zmdi-wallpaper"></i>Activity</a></li> -->
                                            <li><a href="logout.php"><i class="zmdi zmdi-email-open"></i>Log-Out</a>
                                            </li>
                                        </ul>


                                    </div>
                                </div>

                            </li>

                        </ul>

                    </div><!-- Header Notifications Area End -->

                </div>
            </div><!-- Header Right End -->

        </div>
    </div>
</div>
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