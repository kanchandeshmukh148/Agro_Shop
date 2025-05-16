<?php
include('comfig.php');
if (isset($_POST["stateId"])) {

    $str = $_POST['stateId'];

    $sql = "SELECT * FROM `city` where `state-id` = " . $str;
    $select = mysqli_query($connect, $sql) or die(mysqli_error($connectn));
    ?>
    <option selected disabled value="">Select City</option>
    <?php
    while ($sele = mysqli_fetch_array($select)) {
        echo "<option value=" . $sele['city-id'] . ">" . $sele['city-name'] . "</option>";

    }

}


?>