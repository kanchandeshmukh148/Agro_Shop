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

<body>
    <?php
    include 'comfig.php'; // Include your database configuration
    
    // Fetch all states
    $stateQuery = "SELECT * FROM `state`";
    $stateResult = mysqli_query($connect, $stateQuery);


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
                        <h3 class="title"> State</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div>
                <div class=" d-flex  justify-content-between mb-3 ">
                    <div class="box-head">
                        <h4 class="title">State List</h4>
                    </div>



                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add State
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class=" container ">
                                    <h2>Add State</h2>
                                    <form action="add-state.php" method="post">
                                        <div class="form-group">
                                            <label for="stateName">State Name:</label>
                                            <input type="text" class="form-control" id="stateName" name="stateName"
                                                pattern="[A-Za-z\s]+" title="(only letters and spaces)" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-30">
                    <div class="box d-flex justify-content-between ">

                        <!-- Area Table -->
                        <div class="QA_table mb_30 gap-5 col-12" style="display:flex; flex-wrap:wrap;">
                            <div class="col-12">

                                <table class="table col-12">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr NO</th>
                                            <th scope="col">State Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0;
                                        while ($stateRow = mysqli_fetch_assoc($stateResult)) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo ++$count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $stateRow['state-name']; ?>
                                                </td>
                                                <td class=" d-flex gap-2 ">
                                                    <a href="#" class=" btn btn-primary" data-toggle="modal"
                                                        data-target="#editModalState<?php echo $stateRow['state-id']; ?>">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModalState<?php echo $stateRow['state-id']; ?>">Delete</a>
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
    <!-- Modal for Delete Confirmation (State) -->
    <?php
    $stateResult = mysqli_query($connect, $stateQuery); // Re-fetch the data
    while ($stateRow = mysqli_fetch_assoc($stateResult)) {
        ?>
        <div class="modal fade" id="deleteModalState<?php echo $stateRow['state-id']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation (State)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this State?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="delete-state.php?id=<?php echo $stateRow['state-id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editModalState<?php echo $stateRow['state-id']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit State</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="edit-state.php?id=<?php echo $stateRow['state-id']; ?>" method="POST"
                                class=" d-flex gap-2  justify-content-center flex-column align-items-center">
                                <input type="text" class=" form-control" pattern="[A-Za-z\s]+"
                                    title="(only letters and spaces)" value="<?php echo $stateRow['state-name']; ?>"
                                    name="stateName">
                                <button type="submit" name="submit" class="btn btn-primary"> Update </button>
                            </form>
                        </div>
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