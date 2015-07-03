<?php $sidebar = 1; ?>

<?php require_once('_site_header.php'); ?>
<?php require_once('_show_status.php'); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                         <h2 style="font-weight:bold">地方的血庫</h2>
                         <h1>需要熱血！！！</h1>
                        <br>
                        <br>            
                        <p style="text-align:center"><a class="btn btn-primary btn-lg" href="findsite.php" role="button">馬上行動 &raquo;</a></p>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5 " >
                        <div id="maploading" class="well"style="margin-top: 100px;margin-left: 35%; z-index:2;position: absolute;top:0px ;text-align:center">
                            <img class="img" src="img/loading.gif" >
                            <p style="margin-bottom:5px">取得血庫資料中...</p>

                        </div>
                        <svg id="map" style="width: 100%;height: 320px;z-index: 1;position: absolute; top:0px "></svg>
                        <!-- <img src="img/storage.png" alt="已可和台灣血液基金會資料做連線，但暫時先以圖片表示" style="width:60%;margin-left:10%"> -->
                        <div id="storageinfo" class="panel panel-default" style="display:none;width: 120px;z-index: 1;position: absolute; top:120px;left: 85%; ">
                            <table class="table">
                                <tr><td><span class="glyphicon glyphicon-tint" style="color:#66DD00"></span></td><td>足夠</td></tr>
                                <tr><td><span class="glyphicon glyphicon-tint" style="color:#FFBB00"></span></td><td>稍緊</td></tr>
                                <tr><td><span class="glyphicon glyphicon-tint" style="color:#f00"></span></td><td>缺乏</td></tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
                       
            </div>
        </div>

        <div class="container">
          <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>How it works?</h2>
                    <p>系統簡介特色、運作方式、預期製作項目等等</p>
                    <p></p>
                    <p><a class="btn btn-default" href="about.php" role="button">View details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Who are we?</h2>
                    <p>我們是三位來自台大各個角落的學生...</p>
                    <p><a class="btn btn-default" href="about.php#team" role="button">View details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>台灣血液基金會</h2>
                    <p>台灣最大的捐血機構，在各地設有捐血車與血庫。是本次專案主要想要合作的對象</p>
                    <p><a class="btn btn-default" href="http://www.blood.org.tw/Internet/main/index.aspx" role="button">網站 &raquo;</a></p>
                </div>
            </div>

<?php function js_section(){ ?>
<script src="style/d3js/js/d3.v3.min.js"></script>
<script src="style/d3js/js/d3.geo.projection.v0.min.js"></script>
<script src="style/d3js/js/topojson.v1.min.js"></script>
<script>
 
 d3.json("style/d3js/twmap/json/twCounty2010.topo.json", function (error, data) {

    topo = topojson.feature(data, data.objects.layer1);
  prj = d3.geo.mercator().center([123.779531, 22.078567]).scale(4000);

  path = d3.geo.path().projection(prj);

  // locks = d3.select("svg#map").selectAll("path").data(topo.features).enter()
  // .append("path").attr("d", path).attr("fill", '#333');;
  // alert(locks);
 });

 </script> 

 <script type="text/javascript">
function colormaping(){
d3.json("data.json", function (error,popData) { 

    var population = new Array();
    var city = new Array();
    city.push('台北市');
    city.push('新北市');
    city.push('基隆市');
    city.push('桃園市');
    city.push('新竹市');
    city.push('新竹縣');
    city.push('苗栗縣');
    city.push('台中市');
    city.push('南投縣');
    city.push('彰化縣');
    city.push('台南市');
    city.push('嘉義市');
    city.push('嘉義縣');
    city.push('雲林縣');
    city.push('高雄市');
    city.push('屏東縣');
    city.push('花蓮縣');
    city.push('宜蘭縣');
    city.push('台東縣');

    for(var i = 0, len = popData.length; i < len; i+=1) {
        population[i] = popData[i].population;
        
    }
    
    for(var i = 0, len = topo.features.length; i < len; i+=1) {
        
        if (city.indexOf(topo.features[i].properties.COUNTYNAME)==-1 ) {
            topo.features[i].properties.value = 0;
        }else{
            topo.features[i].properties.value = population[city.indexOf(topo.features[i].properties.COUNTYNAME)];
        }
        // alert(topo.features[i].properties.value);
    }

    colorMap = d3.scale.linear().domain([0,1,2,3]).range(["#333","#f00","#FFBB00","#66DD00"]);
    // alert(topo.features[1].properties.value);
    // alert(colorMap(topo.features[1].properties.value));
    locks = d3.select("svg#map").selectAll("path").data(topo.features).enter().append("path")
    .attr("fill",function(d){ 
                            return colorMap(d.properties.value); 
            })
    .attr("d", path)
    .attr("stroke",'black') ;  
});
document.getElementById('storageinfo').style.display='inline';
}

 </script>
<script type="text/javascript">
function getStorage()  
    {  
        
        var xhr;  
        if (window.XMLHttpRequest) { // Mozilla, Safari, ...  
            xhr = new XMLHttpRequest();  
        } else if (window.ActiveXObject) { // IE 8 and older  
            xhr = new ActiveXObject("Microsoft.XMLHTTP");  
        }  
        var data = "json=";  
        xhr.open("POST", "_show_status.php", true);   
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
        xhr.send(data);  
        xhr.onreadystatechange = display_data;  
        function display_data() {  
            if (xhr.readyState == 4) {  
                // alert(xhr.status);
                if (xhr.status == 200) {  
                    // alert(xhr.responseText);
                    colormaping();    
                    var remove_item = document.getElementById('maploading');
                    remove_item.parentElement.removeChild(remove_item);
                    
                } else {  
                    alert('There was a problem with the request.');  
                }  
            }  
        }  
    } 
    getStorage();
</script>
<?php } ?>
<?php require_once('_site_footer.php'); ?>
            




