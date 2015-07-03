
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
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <br><br><br><br><br>
          <strong>一般來說，捐血可分為全血捐血與分離術捐血兩種</strong>
          <h1>(一)全血捐血：</h1>
          一次捐出250ml或500ml（體重60公斤以上者）的血液，只占全身血液量約5%至12%，對一個健康的人來說，很快會再補充新血。
          <h1>(二)分離術捐血：</h1>
          這是一種特殊的捐血方式。是將捐血人的血液抽出，並維持在密閉無菌狀態下，藉由血液分離機自動分離出血小板或血漿等血液成分；其他成分（大部分是紅血球與血漿）隨即回輸捐血人體內。因為必須反覆操作，以獲取足夠之血液成分，所以捐血的時間較長（約1.5～2小時），需要預約並使用分離機設備，才能提供這項服務。
          <br>
          <strong>因兩種不同的捐血方式也有相對應的捐血間隔：</strong>
          <h2>(一)全血捐血：</h2>
          1 本次捐血250ml者，下次捐血應間隔2個月以上；本次捐血500ml者，下次捐血應間隔3個月以上。
          2 男性年捐血量應在1,500ml以內；女性年捐血量應在1,000ml以內。
          <h2>(二)分離術捐血：</h2>
          捐分離術血小板者，每次之間隔為2週以上。

          因血液有保存期限，一般紅血球效期是1個月，血漿約1年，大量的血液在同時湧入反而會造成浪費，
          且每位民眾都有捐血間隔的限制，同時湧入的血液除了造成浪費外也會造成下次捐血人數的下降
          ，因此除了定期捐血的民眾外，建議在捐血站發出訊息時才前網避免浪費
          <br>
          cited from:http://www.blood.org.tw/Internet/main/blood_before/index.html
          <br>
        </div>
        <div class="col-md-3">
        </div>
    </div>


<?php require_once('_site_footer.php') ?>
<?php function js_section(){ ?>
<script src="style/js/jquery-2.1.0.js"></script>

<?php } ?>