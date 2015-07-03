
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
<?php $sidebar = 3; ?>
<?php require_once('_show_status.php'); ?>
<?php require_once('_site_header.php'); ?>
<div class="container"style="">
	<div id="row"style="width:100%;">
		<div class="col-md-9">
			<div id="map" style="width:100%;height:500px"></div>
		</div>
		<div class="col-md-3">
			<br>
			<div>
				<table class="table" style="margin-bottom:0px">
					<tr>
						<th>您所在位置</th>
						<td><span id="countryname"></span></td>
					</tr>
					
					<tr>
						<td colspan="2" id="storagestatus">
							載入血庫狀態中...

						</td>
					</tr>
				</table>
			</div>
			
			<div id="direction-panel" style="height:200px; overflow:auto">
			</div>
		</div>
	</div>
	<br>
	<br>


<?php require_once('_site_footer.php') ?>
<?php function js_section(){ ?>
<script src="style/js/jquery-2.1.0.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=zh-TW&libraries=geometry"></script>
<script src="http://maps.gstatic.com/maps-api-v3/api/js/19/10/intl/zh_tw/geometry.js"></script>
<script type="text/javascript" src="http://app.essoduke.org/tinyMap/jquery.tinyMap-2.8.5.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="style/js/jQuery-tinyMap-master/jquery.tinyMap.min.js"></script>

<script type="text/javascript">
function findsite(lati,longi,wtd){
	var map = $('#map');

	// 模擬目前位置
	var current = [String(lati),String(longi)];
	var loc = [
		<?php 
			global $sites;
			foreach ($sites as $key => $site) { ?>
			<?php if ($site['lati']!='NaN'&&$site['longi']!='NaN') { ?>
				{'addr': ["<?=$site['lati']?>","<?=$site['longi']?>"],'mid':<?=$site['id']?>, 'text': "<strong><?=$site['name']?></strong><br><span>地址<?=$site['address']?></span><br><span>開放時間:<?=$site['openhour']?></span><br><span>電話:<?=$site['tel']?></span>"},
    		<?php } ?>
    	<?php } ?>
	    // 新增一標記為目前位置
	    {'addr': current, 'text': '<strong>目前位置</strong>', 
	    'icon': 'http://app.essoduke.org/tinyMap/4.png', 'label': '目前位置', 'css': 'label'},
	];	
	if (wtd==0) {
		map.tinyMap({

	    'marker': loc,
	    'event': {
	        'idle': {
	            'func': function () {
	            	// alert('123');
	                var i = 0,
	                    icon = {},
	                    pos = {},
	                    distance = [],
	                    nearest = false,
	                    // 取得目前位置的 LatLng 物件
	                    now = new google.maps.LatLng(current[0], current[1]),
	                    // 取得 instance
	                    m = map.data('tinyMap'),
	                    // 取得已建立的標記
	                    markers = m._markers;
	                // 使用迴圈比對標記（忽略最末個）
	                for (i; i < loc.length - 1; i += 1) {
	                    // 建立標記的 LatLng 物件
	                    // if (loc[i].addr[0]!='NaN'&&loc[i].addr[1]!='NaN') {
	                   		pos = new google.maps.LatLng(loc[i].addr[0], loc[i].addr[1]);
		                    /**
		                     * 利用幾何圖形庫比對標記與目前位置的測地線直線距離並存入陣列。
		                     * http://goo.gl/ncP2Gz
		                     */                    
		                     distance.push(google.maps.geometry.spherical.computeDistanceBetween(pos, now));
	                    // };
		            }
	                //console.dir(distance);
	                // 尋找陣列中最小值的索引值
	                nearest = distance.indexOf(Math.min.apply(Math, distance));
	                if (false !== nearest) {
	                    if (undefined !== markers[nearest].infoWindow) {
	                        
	                        // 開啟此標記的 infoWindow
	                        markers[nearest].infoWindow.open(m.map, markers[nearest]);

	                        // 更換此標記的圖示
	                        markers[nearest].setIcon('img/bus.png');
	                        markers[nearest].infoWindow.content += '<p>距離: ' + Math.round(distance[nearest].toString()) + ' 公尺</p>';
	                        var npos = current;
	                        var spos = markers[nearest].position;
	                        map.tinyMap('modify',{
	                        	'direction': [
								        {
								            'from': current,
								            'fromText': '目前所在位置',
								            'to': spos,
								            'toText': '最近捐血車位置',
								            'panel': '#direction-panel',
								            'autoViewport':'false',
								            'event': {
									            'directions_changed': {
									                'func': function () {
									                    console.log('路徑規劃完成');
									                }
									            }
									        }
								         }]
	                        });
	                    }
	                }
	            },
	            'once': true
	        }
	    },
						    
		});
	}else{
		map.tinyMap({

	    'marker': loc
						    
		});
	}
}

	


</script>
<script type="text/javascript">
function getStorage(city)  
	{  
		
		var xhr;  
		if (window.XMLHttpRequest) { // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject) { // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}  
		var data = "findstatus=&cityname=" + city;  
		xhr.open("POST", "_show_status.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);  
		xhr.onreadystatechange = display_data;  
		function display_data() {  
			if (xhr.readyState == 4) {  
				// alert(xhr.status);
				if (xhr.status == 200) {  
					// alert(xhr.responseText);
					document.getElementById('storagestatus').innerHTML = xhr.responseText;        
				} else {  
					alert('There was a problem with the request.');  
				}  
			}  
		}  
	} 
</script><script type="text/javascript">
function findstatus(lati,longi){
   var geocoder = new google.maps.Geocoder();

	   if (geocoder) {
	      geocoder.geocode({ 'location':  {"lat": lati,"lng": longi } }, function (results, status) {
	         if (status == google.maps.GeocoderStatus.OK) {
	            for (var i = results.length - 1; i >= 0; i--) {
	            	if (results[i].address_components[0].types[0]=='administrative_area_level_1') {
	            		document.getElementById('countryname').innerHTML = results[i].address_components[0].long_name+results[i-2].address_components[0].long_name;
	            		getStorage(results[i].address_components[0].long_name);
	            	};
	            };
	            // 
	         }
	         else {
	            console.log("Geocoding failed: " + status);
	         }
	      });
	   } 
}
</script>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    } else {

        alert("無法取得地理資訊位址");
    }
}
function showPosition(position) {
	findstatus(position.coords.latitude,position.coords.longitude);
	findsite(position.coords.latitude,position.coords.longitude,0);

}
function showError(error) {
  	findsite(0,0,1);
  	document.getElementById('countryname').innerHTML = '無法取得';
  	getStorage(0);
}
</script>

<script type="text/javascript">
getLocation();

</script>
<?php } ?>