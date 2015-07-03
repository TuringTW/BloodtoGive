
<?php 
    require_once('mysql_info.php');
    // $link = mysqli_connect('localhost','client','1qaz2wsx','blood');
    // mysqli_query($link,"SET NAMES 'UTF8'");
    $sql = "SELECT * from `site`";
    $result = mysqli_query($link,$sql);

    $sites = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($sites, $row);
    }

?>
<?php $sidebar = 5; ?>
<?php require_once('_show_status.php'); ?>
<?php require_once('_site_header.php'); ?>
<div class="container marketing">

<?php require_once('_site_footer.php') ?>
<?php function js_section(){ ?>
<script src="style/js/jquery-2.1.0.js"></script>

<?php } ?>