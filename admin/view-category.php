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
    
    // Fetch all areas
    $Query = "SELECT * FROM category;";
    $Result = mysqli_query($connect, $Query);
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
                        <h3 class="title">  category </h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div>
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-head d-flex justify-content-between">
                            <h3 class="title">Category List</h3>
                            <a href="#" class="btn btn-success" data-toggle="modal"
                                data-target="#addModalCategory">Add Category</a>
                        </div>
                        <!-- Area Table -->
                        <div class="QA_table mb_30 gap-5 col-12" style="display:flex; flex-wrap:wrap;">
                            <div class="col-12">

                                <table class="table col-12">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr No </th>
                                            <th scope="col">Category Name</th>
                                            <!-- <th scope="col">Category Description</th> -->
                                            <th scope="col">Create Date</th>
                                            <th scope="col">Last Up-Date</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0 ;  while ($Row = mysqli_fetch_assoc($Result)) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo ++$count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $Row['CategoryName']; ?>
                                                </td>
                                                <!-- <td>
                                                    <?php echo $Row['Description']; ?>
                                                </td> -->
                                                <td>
                                                    <?php echo $Row['create-at']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $Row['update-at']; ?>
                                                </td>
                                                <td class=" d-flex gap-2 ">
                                                    <a href="#" class=" btn btn-primary" data-toggle="modal"
                                                        data-target="#editModalArea<?php echo $Row['CategoryID']; ?>">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModalArea<?php echo $Row['CategoryID']; ?>">Delete</a>
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
    <?php
    $Result = mysqli_query($connect, $Query); // Re-fetch the data
    while ($Row = mysqli_fetch_assoc($Result)) {
        ?>
        
        <div class="modal fade" style="z-index: index;" id="deleteModalArea<?php echo $Row['CategoryID']; ?>" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete
                        <?php echo $Row['CategoryName']; ?> Category?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="delete-category.php?id=<?php echo $Row['CategoryID']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editModalArea<?php echo $Row['CategoryID']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="edit-category.php?id=<?php echo $Row['CategoryID']; ?>" method="POST"
                                class=" d-flex gap-2  justify-content-center flex-column align-items-center">
                                <input type="text" class=" form-control" value="<?php echo $Row['CategoryName']; ?>" name="category">

                                <textarea name="description" class=" form-control" id="" cols="30" rows="10"
                                    value=""><?php echo $Row['Description']; ?></textarea>
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
    <div class="modal fade" id="addModalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="add-category.php" method="POST"
                            class="d-flex gap-2 justify-content-center flex-column align-items-center">
                            <input type="text" class="form-control" required placeholder="Category Name" name="category">

                            <textarea name="description" class="form-control" placeholder="Category Description"
                                cols="30" rows="10"></textarea>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>