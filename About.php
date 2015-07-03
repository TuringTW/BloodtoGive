
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
<?php $sidebar = 2; ?>
<?php require_once('_show_status.php'); ?>
<?php require_once('_site_header.php'); ?>
<div class="container marketing">

      <!-- Three columns of text below the carousel -->
    <h1>關於BloodtoGive熱血樂捐</h1>
    <p style="text-indent: 2em;font-size:24px">BloodtoGive是一個血庫與捐血人間的平台，目的是要補足兩者之間溝通不易的問題，協助捐血人排養出捐血習慣，並提升血庫庫存的穩定性。</p>
    <p style="text-indent: 2em;font-size:24px">過去捐血中心在缺血時主要透過新聞媒體報導，在年輕世代普遍不易接收到這樣的資訊，因此我們想要透過網路資訊的傳播來增加這樣訊息的曝光度，並提供更便利的捐血後台服務。我們透過<a href="https://docs.google.com/a/phys.tw/forms/d/1pKfCeGs-pb0RrdflLSK85eRCfgYLzgcYDoIc-5j-HQo/viewanalytics">問卷</a>分析，發現多數捐血人似乎沒有紀錄習慣，而沒有捐血的人似乎在缺血通知後會提升捐血動機。問卷有顯示，經過有效規劃的資訊傳遞，捐血意願可能可以提升不少。</p>
    <p style="text-indent: 2em;font-size:24px">因此我們規劃我們的功能，須能清楚的表示各地區血量情形，並且在適當時機做出主動的推播通知，最後我們提供一個即時導航，讓使用者有時間時在任何地點都可以找到最近的捐血中心。</p>
    <hr class="featurette-divider">


    

      <!-- START THE FEATURETTES -->

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">即時的血庫存量<span class="text-muted"></span></h2>
          <p class="lead" style="font-size:24px">利用g0v的twgeojson，與台灣血液基金會的資料作連接，血情狀況一目了然。</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="img/storageDEMO.png" alt="500x500"  data-holder-rendered="true">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="500x500" src="img/move.jpg" data-holder-rendered="true">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">即刻捐血&nbsp;<span class="text-muted">把關心化作行動</span></h2>
          <p class="lead">透過GPS定位與Google Direction API，搜尋與你最近的捐血地點。</p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">捐血日誌&nbsp;<span class="text-muted">記錄你每一次熱血</span></h2>
          <p class="lead">經過你的授權後，我們會從台灣血液基金會取得你每次捐血紀錄，並提醒你下一次捐血時間。</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="500x500" src="img/diary.jpg" data-holder-rendered="true">
        </div>
      </div>
      <hr class="featurette-divider">
      <h1>What have we done?</h1>
    <div style="font-size:24px;">
        <li>問卷進行使用者調查</li>
        <li>與台灣血液基金會進行聯繫，希望能夠協助其將可用資料公開</li>
        <li>網頁APP的展示</li>
        <li><a href="https://www.google.com/maps/d/edit?mid=zGq2VJ5NdtUs.kDYAcwSlWkN8">台灣捐血車地圖</a></li>

    </div>
    <hr class="featurette-divider">
      <hr class="featurette-divider">
        <h1>開發中項目</h1>
        <div style="font-size:24px;">
            <li>iOS和Android 專用 APP</li>
            <li>APP推播服務，主動在資料庫中搜尋可捐血人並透過APP推播主動邀請來捐血</li>
            <li>捐血預約系統</li>
            <li>協助台灣血液基金會進行資料系統的架構，並將可用資訊開放</li>
            <li>將捐血量經過計算後轉為成就點數，並找尋合作廠商提供優惠活動</li>
            <li>血庫端的操作介面，讓血庫端人員可在特殊情況下向特殊族群推播缺血通知，例如稀有血型</li>
        </div>
        <hr class="featurette-divider">
        <h1>資料來源</h1>
        <div style="font-size:24px;">
            <li>台灣血液基金會</li>
            
        </div>        
      <hr class="featurette-divider" id="team">
      <!-- /END THE FEATURETTES -->
    <h1 >關於BloodtoGive團隊</h1>
    <p style="text-indent: 2em;font-size:24px">我們是由三位台大學生組成的團隊，起初參與防災APP設計比賽的過程中，我們不斷思索除了物資與人員資訊的即時傳遞之外，什麼樣的資訊與資源是我們目前社會所忽略、所缺乏的？</p>
    <p style="text-indent: 2em;font-size:24px">我們注意到多半的災害都會伴隨人員的傷亡，但似乎目前有關醫療資源、狀態的資訊傳遞平台仍然是相當貧瘠，尤其缺乏血液儲存、供給與使用量的應用軟體，於是，我們決定建立一個能將各地捐血地點、捐血情況與一般民眾連結的捐血平台，發揮我為人人、人人為我的精神，捲起袖子、救人一命。</p>
    <p style="text-indent: 2em;font-size:24px">同時這樣的資訊也能提供各地的政府機關在血液疾病的研究或是賑災中血袋的調度提供一些幫助。希望我們的應用軟體能為社會盡一些微薄的力量。</p>
    <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="img/guo.jpg" alt="Generic placeholder image" style="width: 200px; height: 200px;">
          <h2>郭仲耘</h2>
          <p>台大物理系</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="img/lee.jpg" alt="Generic placeholder image" style="width: 200px; height: 200px;">
          <h2>李耕銘</h2>
          <p>台大電機所</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="img/lin.jpg" alt="Generic placeholder image" style="width: 200px; height: 200px;">
          <h2>林子路</h2>
          <p>台大物研所</p>
        </div><!-- /.col-lg-4 -->
        
      </div><!-- /.row -->




















<?php require_once('_site_footer.php') ?>
<?php function js_section(){ ?>
<script src="style/js/jquery-2.1.0.js"></script>

<?php } ?>