<?php
include('comfig.php');
if (isset($_POST["areaid"])) {

    $aid = $_POST['areaid'];
    
    $sql = "SELECT * FROM `shop` where `ShopAddress` = " . $aid;
    $select = mysqli_query($connect, $sql) or die(mysqli_error($connectn));
    if ($select->num_rows > 0) {
        ?>
        <!-- <option selected disabled value="0">Select Shop</option> -->
         <option value="0">Select Shop</option>
        <?php

        while ($sele = mysqli_fetch_array($select)) {
            echo "<option value=" . $sele['ShopID'] . ">" . $sele['ShopName'] . "</option>";

        }
    } else {
        echo "<option selected disabled value='0'>Not Shop in This Area</option>";
    }
}
?>