<?php include 'verify.php' ?>
<?php include 'message.php' ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'header.php' ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<?php
include 'comfig.php'; // Include your database configuration

// Fetch all cities
$cityQuery = "SELECT
        c.`city-id`,
        c.`city-name`,
        c.`state-id`,
        s.`state-name`,
        c.`city-created-date`
    FROM
    `city` c
    JOIN
    `state` s ON c.`state-id` = s.`state-id`;
    ";
$cityResult = mysqli_query($connect, $cityQuery);


?>

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
                    <h3 class="title"> City</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div>
            <div class=" d-flex  justify-content-between mb-3 ">
                <div class="box-head">
                    <h4 class="title">City List</h4>
                </div>



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add City
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class=" container ">
                                <h2>Add City</h2>
                                <form action="add-city.php" method="post">
                                    <label for="stateId">Select State:</label>
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
                                    <div class="form-group mt-4 ">
                                        <label for="stateName">City Name:</label>
                                        <input type="text" class="form-control" id="cityName"  pattern="[A-Za-z\s]+" title="(only letters and spaces)" name="cityName" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-30">
                <div class="box">
                    <!-- <div class="box-head">
                        <h3 class="title">Default Table</h3>
                    </div> -->
                    <!-- Area Table -->
                    <div class="QA_table mb_30 gap-5 col-12" style="display:flex; flex-wrap:wrap;">
                        <div class="col-12">

                            <table class="table col-12">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr No</th>
                                        <th scope="col">State name</th>
                                        <th scope="col">City Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 0;
                                    while ($cityRow = mysqli_fetch_assoc($cityResult)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ++$count; ?>
                                            </td>
                                            <td>
                                                <?php echo $cityRow['state-name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $cityRow['city-name']; ?>
                                            </td>
                                            <td class=" d-flex gap-2 ">
                                                <a href="#" class=" btn btn-primary" data-toggle="modal"
                                                    data-target="#editModalCity<?php echo $cityRow['city-id']; ?>">Edit</a>
                                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModalCity<?php echo $cityRow['city-id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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
<!-- Modal for Delete Confirmation (Area) -->

<!-- Modal for Delete Confirmation (City) -->
<?php
$cityResult = mysqli_query($connect, $cityQuery); // Re-fetch the data
while ($cityRow = mysqli_fetch_assoc($cityResult)) {
    ?>
    <div class="modal fade" id="deleteModalCity<?php echo $cityRow['city-id']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation (City)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this City?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="delete-city.php?id=<?php echo $cityRow['city-id']; ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalCity<?php echo $cityRow['city-id']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center W-100">
                    <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="edit-city.php?id=<?php echo $cityRow['city-id']; ?>" method="POST"
                        class=" d-flex gap-2  justify-content-center flex-column align-items-center">
                        <label for="formLayoutUsername1" class=" text-start W-100 ">Select State<span
                                style="color:red;">*</span>:</label>

                        <select class="form-control" id="stateId" name="stateId" required>
                            <option disabled value="">Select State</option>
                            <?php
                            // Fetch states from the state table
                            $stateQuery = "SELECT `state-id`, `state-name` FROM `state`";
                            $stateResult = $connect->query($stateQuery);

                            if ($stateResult->num_rows > 0) {
                                while ($row = $stateResult->fetch_assoc()) {
                                    $selected = ($row['state-id'] == $cityRow['state-id']) ? 'selected' : '';
                                    echo "<option value='" . $row["state-id"] . "' " . $selected . ">" . $row["state-name"] . "</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="formLayoutUsername1" class=" mt-3 text-start W-100">City Name<span
                                style="color:red;">*</span>:</label>
                        <input type="text" class=" form-control" pattern="[A-Za-z\s]+" title="(only letters and spaces)"
                            value="<?php echo $cityRow['city-name']; ?>" name="cityName">
                        <button type="submit" name="submit" class="btn btn-primary"> Update </button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
<?php } ?>
</body>

</html>