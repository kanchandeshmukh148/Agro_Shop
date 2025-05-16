<?php
include('comfig.php');
if (isset($_POST["stateId"]) && isset($_POST["cityId"])) {

    $str = $_POST['stateId'];
    $cit = $_POST['cityId'];
    $sql = "SELECT * FROM `area` where `state-id` = " . $str . " AND  `city-id` = " . $cit . ";";
    $select = mysqli_query($connect, $sql) or die(mysqli_error($connectn));
    ?>
    <option selected disabled value="">Select Area</option>
    <?php
    while ($sele = mysqli_fetch_array($select)) {
        echo "<option value=" . $sele['area-id'] . ">" . $sele['area-name'] . "</option>";

    }

}


?>