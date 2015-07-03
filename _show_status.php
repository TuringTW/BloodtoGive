<?php 
//storageA 
//storageB
//storageAB
//storageO 

require_once('simple_html_dom.php');
if (isset($_POST['json'])) {
	$city = array(	array('COUNTYNAME'=>'台北市','region'=>0),
					array('COUNTYNAME'=>'新北市','region'=>0),
					array('COUNTYNAME'=>'基隆市','region'=>0),
					array('COUNTYNAME'=>'桃園市','region'=>1),
					array('COUNTYNAME'=>'新竹市','region'=>1),
					array('COUNTYNAME'=>'新竹縣','region'=>1),
					array('COUNTYNAME'=>'苗栗縣','region'=>1),
					array('COUNTYNAME'=>'台中市','region'=>2),
					array('COUNTYNAME'=>'南投縣','region'=>2),
					array('COUNTYNAME'=>'彰化縣','region'=>2),
					array('COUNTYNAME'=>'台南市','region'=>3),
					array('COUNTYNAME'=>'嘉義市','region'=>3),
					array('COUNTYNAME'=>'嘉義縣','region'=>3),
					array('COUNTYNAME'=>'雲林縣','region'=>3),
					array('COUNTYNAME'=>'高雄市','region'=>4),
					array('COUNTYNAME'=>'屏東縣','region'=>4),
					array('COUNTYNAME'=>'花蓮縣','region'=>5),
					array('COUNTYNAME'=>'宜蘭縣','region'=>5),
					array('COUNTYNAME'=>'台東縣','region'=>5));
	$data = getStorage(-1);
	foreach ($city as $key => &$value) {
		$temp = 3;
		foreach ($data[$value['region']] as $key1 => $datum) {
			if ($temp>$datum&&(strcmp($key1,'region')!=0)) {
				$temp = $datum;
				// echo "$datum";
			}

			$data[$value['region']]['total']=$temp;
		}
		// $data[$value['region']]
		$value['population'] = $temp;
	}
	$handle = fopen("data.json", "w");
	fwrite($handle,json_encode($city));
	fclose($handle);
}
if (isset($_POST['findstatus'])) {
	$cityname=$_POST['cityname'];
	$city = array(array('台北市',0),array('新北市',0),array('基隆市',0),array('桃園市',1),array('新竹市',1),array('新竹縣',1),array('苗栗縣',1),array('台中市',2),array('南投縣',2),array('彰化縣',2),array('台南市',3),array('嘉義市',3),array('嘉義縣',3),array('雲林縣',3),array('高雄市',4),array('屏東縣',4),array('花蓮縣',5),array('宜蘭縣',5),array('台東縣',5));
	$storageNum = -1;
	foreach ($city as $key => $value) {
		if ($value[0]==$cityname) {
			$storageNum = $value[1];
		}
	}
	if ($storageNum==-1) {
		$data = array();
		for ($i=0; $i < 6; $i++) { 
			array_push($data, getStorage($i)[0]);
		}?>
		<ul class="nav nav-tabs" role="tablist">
			<?php foreach ($data as $key => $datum): ?>
				<li style="padding-left:0px"role="presentation" class="<?=($key==0)?'active':''?>"><a style="padding-left:4px;padding-right:4px;font-size:12px" href="#tab<?=$key?>" aria-controls="tab<?=$key?>" role="tab" data-toggle="tab"><?=str_replace('捐血中心', '', $datum['region'])?></a></li>			
				<?php endforeach ?>
		</ul>
		<div class="tab-content">
			<?php foreach ($data as $key => $datum): ?>
				<div role="tabpanel" class="tab-pane <?=($key==0)?'active':''?>" id="tab<?=$key?>">
					<table class="table">
						<tr <?=showstate($datum['StorageA'],1)?>>
							<th>A型</th>
							<td><span style="font-size: 18px" <?=showstate($datum['StorageA'],2)?>></span></td>
							<td><?=showstate($datum['StorageA'],3)?></td>
						</tr>
						<tr <?=showstate($datum['StorageB'],1)?>>
							<th>B型</th>
							<td><span style="font-size: 18px" <?=showstate($datum['StorageB'],2)?>></span></td>
							<td><?=showstate($datum['StorageB'],3)?></td>
						</tr>
						<tr <?=showstate($datum['StorageAB'],1)?>>
							<th>AB型</th>
							<td><span style="font-size: 18px" <?=showstate($datum['StorageAB'],2)?>></span></td>
							<td><?=showstate($datum['StorageAB'],3)?></td>
						</tr>
						<tr <?=showstate($datum['StorageO'],1)?>>
							<th>O型</th>
							<td><span style="font-size: 18px" <?=showstate($datum['StorageO'],2)?>></span></td>
							<td><?=showstate($datum['StorageO'],3)?></td>
						</tr>
					</table>

				</div>
			<?php endforeach ?>
		    
		 </div>

		<?php
	}else{
		$data = getStorage($storageNum)[0];
	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";
?>
	<div class="panel panel-default">
		<div class="panel-heading">地方血庫狀態&nbsp;:&nbsp;<?=$data['region']?></div>

		<table class="table">
			<tr <?=showstate($data['StorageA'],1)?>>
				<th>A型</th>
				<td><span style="font-size: 18px" <?=showstate($data['StorageA'],2)?>></span></td>
				<td><?=showstate($data['StorageA'],3)?></td>
			</tr>
			<tr <?=showstate($data['StorageB'],1)?>>
				<th>B型</th>
				<td><span style="font-size: 18px" <?=showstate($data['StorageB'],2)?>></span></td>
				<td><?=showstate($data['StorageB'],3)?></td>
			</tr>
			<tr <?=showstate($data['StorageAB'],1)?>>
				<th>AB型</th>
				<td><span style="font-size: 18px" <?=showstate($data['StorageAB'],2)?>></span></td>
				<td><?=showstate($data['StorageAB'],3)?></td>
			</tr>
			<tr <?=showstate($data['StorageO'],1)?>>
				<th>O型</th>
				<td><span style="font-size: 18px" <?=showstate($data['StorageO'],2)?>></span></td>
				<td><?=showstate($data['StorageO'],3)?></td>
			</tr>
		</table>

	</div>
<?php
	}

}
function showstate($status,$type){
	switch ($status) {
		case '3':
			if ($type==1) {
				return '';
			}else if($type == 2){
				return ' class="glyphicon glyphicon-ok-sign""';
			}else{
				return '充足';
			}
			break;
		case '2':
			if ($type==1) {
				return ' class="warning"';
			}else if($type == 2){
				return ' class="glyphicon glyphicon-exclamation-sign""';
			}else{
				return '稍緊';
			}
			break;
		case '1':
			if ($type==1) {
				return ' class="danger"';
			}else if($type == 2){
				return ' class="glyphicon glyphicon-remove-sign""';
			}else{
				return '缺乏';
			}
			break;

		default:
			return '';
			break;
	}
}
function getStorage($storageNum){

	
	$url = "http://www.blood.org.tw/Internet/main/index.aspx";
	$response = cURL($url,'');

	$html = str_get_html($response);
	$res = $html -> find('div[id=tool_blood_cube]',0)->find('div[class=Storage]');
	
	

	$data = array();
	foreach ($res as $key => $value) {
		if ($storageNum == $key||$storageNum==-1) {
			$row = array();
			$row['region'] = $value-> find('div[id=StorageHeader]',0)->plaintext;
			$temp = $value-> find('div',1)->find('div');
			foreach ($temp as $key1 => $blood) {
				$id = $blood ->getAttribute('id');
				$type = $blood ->find('img',0)->getAttribute('alt');
				
				switch ($type) {
					case '庫存量7日以上':
						$row[$id] = 3;
						break;
					case '庫存量4到7日':
						$row[$id] = 2;
						break;
					case '庫存量4日以下':
						$row[$id] = 1;
						break;
					default:
						$row[$id] = 0;
						break;
				}
			}
			array_push($data, $row);
		}
		
	}

	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";
	// // echo "$res";
	return $data;

}












	function cURL($url, $post)
	{
	    $header=NULL;
	    $cookie=NULL;
	    //$user_agent = $_SERVER['HTTP_USER_AGENT; 
	    $user_agent = 'Mozilla/5.0 (Windows NT 5.1; rv:10.0.2) Gecko/20100101 Firefox/10.0.2';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, $header);
	    curl_setopt($ch, CURLOPT_NOBODY, $header);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    
	    // if ($post) {
	    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    //     curl_setopt($ch, CURLOPT_POST, 1);
	    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    // }
	    $result = curl_exec($ch);
	    $error = curl_error($ch);
	    curl_close($ch);
	    
	    if($result){
	        return $result;

	    }else{
	        return $error;
	    }
	}

?>