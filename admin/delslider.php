<?php
	include '../lib/session.php';
	session::checkSession();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php
    $db = new Database();
?>
<?php
    if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php';</script>";
    } else {
        $sliderid = $_GET['sliderid'];
        $query = "select * from table_slider where id='$sliderid'";
        $getData = $db->select($query);
        if ($getData) {
            while ($delimg = $getData->fetch_assoc()) {
                $dellink = $delimg['image'];
                unlink($dellink);
            }
        }

        $delquery = "delete from table_slider where id = '$sliderid'";
        $delData = $db->delete($delquery);
        if ($delData) {
            echo "<script>alert('Slider Deleted Successfully.')</script>";
            echo "<script>window.location = 'sliderlist.php';</script>";
        } else {
            echo "<script>alert('Slider Not Deleted.')</script>";
            echo "<script>window.location = 'sliderlist.php';</script>";
        }
    }
?>