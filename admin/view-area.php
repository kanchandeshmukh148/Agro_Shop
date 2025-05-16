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

// Fetch all areas
$areaQuery = "SELECT
        a.`area-id`,
        a.`state-id`,
        a.`city-id`,
        a.`area-name`,
        a.`area-address`,
        c.`city-name`,
        s.`state-name`
    FROM
        area a
    JOIN
        city c ON a.`city-id` = c.`city-id`
    JOIN
        state s ON a.`state-id` = s.`state-id`;


    ";
$areaResult = mysqli_query($connect, $areaQuery);
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
                        <h3 class="title"> Area </h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div>
                <div class=" d-flex  justify-content-between mb-3 ">
                    <div class="box-head">
                        <h4 class="title">Area List</h4>
                    </div>



                    <!-- Button trigger modal -->
                    <a href="add-location.php" class="btn btn-primary">
                        Add Area
                    </a>
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
                                            <th scope="col">State Name</th>
                                            <th scope="col">City Name</th>
                                            <th scope="col">Area Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0;
                                        while ($areaRow = mysqli_fetch_assoc($areaResult)) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ++$count ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $areaRow['state-name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $areaRow['city-name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $areaRow['area-name']; ?>
                                                    </td>
                                                    <td class=" d-flex gap-2 ">
                                                        <a href="#" class=" btn btn-primary" data-toggle="modal"
                                                            data-target="#editModalArea<?php echo $areaRow['area-id']; ?>">Edit</a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModalArea<?php echo $areaRow['area-id']; ?>">Delete</a>
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
$areaResult = mysqli_query($connect, $areaQuery); // Re-fetch the data
while ($areaRow = mysqli_fetch_assoc($areaResult)) {
    ?>

    <!-- Delete Area Modal -->
    <div class="modal fade" style="z-index: index;" id="deleteModalArea<?php echo $areaRow['area-id']; ?>" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation (Area)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Area?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="delete-area.php?id=<?php echo $areaRow['area-id']; ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Area Modal -->
    <div class="modal fade" id="editModalArea<?php echo $areaRow['area-id']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form method="POST" action="edit-area.php?id=<?php echo $areaRow['area-id'] ?>">
                            <div class="row mbn-20">
                                <div class="col-6 mb-20">
                                    <label for="formLayoutUsername1">Select State<span style="color:red;">*</span>:</label>

                                    <select class="form-control" id="stateId<?php echo $areaRow['area-id']; ?>"
                                        name="stateId" required>
                                        <option disabled value="">Select State</option>
                                        <?php
                                        // Fetch states from the state table
                                        $stateQuery = "SELECT `state-id`, `state-name` FROM `state`";
                                        $stateResult = $connect->query($stateQuery);

                                        if ($stateResult->num_rows > 0) {
                                            while ($row = $stateResult->fetch_assoc()) {
                                                $selected = ($row['state-id'] == $areaRow['state-id']) ? 'selected' : '';
                                                echo "<option value='" . $row["state-id"] . "' " . $selected . ">" . $row["state-name"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6 mb-20">
                                    <label for="formLayoutEmail1">City<span style="color:red;"> *</span></label>
                                    <select class="form-control" id="cityId<?php echo $areaRow['area-id']; ?>" name="cityId"
                                        required>
                                        <option disabled value="">Select City</option>
                                        <?php
                                        // Fetch cities based on the selected state
                                        $cityQuery = "SELECT `city-id`, `city-name` FROM `city` WHERE `state-id` = " . $areaRow['state-id'];
                                        $cityResult = $connect->query($cityQuery);

                                        if ($cityResult->num_rows > 0) {
                                            while ($row = $cityResult->fetch_assoc()) {
                                                $selected = ($row['city-id'] == $areaRow['city-id']) ? 'selected' : '';
                                                echo "<option value='" . $row["city-id"] . "' " . $selected . ">" . $row["city-name"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="formLayoutUsername1">Area<span style="color:red;">
                                            *</span></label>
                                    <input type="text" id="formLayoutUsername1" class="form-control"  pattern="[A-Za-z\s]+" title="(only letters and spaces)"
                                        placeholder="Enter Area" name="area" value="<?php echo $areaRow['area-name'] ?>"
                                        required="">
                                </div>
                                <!-- <div class="col-12 mb-20">
                                    <label for="formLayoutUsername1">Addres</label>
                                    <textarea type="text" id="formLayoutUsername1" class="form-control"
                                        placeholder="Addres--"
                                        name="areaAddress"><?php echo $areaRow['area-address'] ?></textarea>
                                </div> -->

                                <div class="col-12 mb-20">
                                    <input type="submit" value="submit" name="submit" class="button button-primary"
                                        placeholder="Update">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("select#stateId<?php echo $areaRow['area-id']; ?>").change(function () {
                var st = $("#stateId<?php echo $areaRow['area-id']; ?> option:selected").val();
                console.log(st);
                // alert(st);
                $.ajax({
                    type: "POST",
                    url: "addres-api.php",
                    data: { stateId: st }
                }).done(function (data) {
                    $("#cityId<?php echo $areaRow['area-id']; ?>").html(data);
                    console.log(data);
                });
            });
        });
    </script>

<?php } ?>

</body>

</html>