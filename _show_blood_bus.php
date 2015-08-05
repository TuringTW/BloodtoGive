<?php 
//storageA 
//storageB
//storageAB
//storageO 
	set_time_limit(0);
	header("Content-Type:text/html; charset=utf-8");
	require_once('simple_html_dom.php');
	$link = mysqli_connect('localhost','client','1qaz2wsx','blood');
	mysqli_query($link, "SET NAMES 'UTF8'");


	$url = "http://www.blood.org.tw/Internet/main/map.aspx";
	$length = 5;
	$data = array();
	for ($i=1; $i < $length; $i++) { 
		$row = array();
		$response = cURL($url.'?spotID='.$i,'');
		$html = str_get_html($response);
		$res = $html -> find('td[id=date_place]',0)->plaintext;

		if (trim($res)!="") {
			$row['name'] = trim($res);
			$res = $html -> find('table[id=map_ifrom]',0)->find('tr');
		
			foreach ($res as $key => $value) {
				$text = ($value->find('td',1)->plaintext);
				array_push($row, trim($text));
			}


			$text = explode('(', trim($row['name']));
			$row['name'] = $text[0];
			if (isset($text[1])) {
				$row[3] .= '<br>'.explode(')', $text[1])[0];
			}


			$text = explode('(', trim($row[0]));
			$row[0] = $text[0];
			if (isset($text[1])) {
				$row[3] .= '<br>'.explode(')', $text[1])[0];
			}
			$res = $html->find('iframe[id=ctl00_contentPlaceHolder1_frame_map]',0);
			$res = $res->find('div',0);
			echo $res->class;
			$res = $res->find('a',0);
			$res = $res->href;
			echo "$res";

			$sql = "INSERT INTO `site` (`id`, `name`, `address`, `tel`, `openhour`, `note`)
						VALUES (NULL, '".$row['name']."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."')";
			echo "$sql";
			$result = mysqli_query($link,$sql);
			array_push($data, $row);
		}
			
	}
	

	
	

	

	echo "<pre>";
	print_r($data);
	echo "</pre>";
	// echo "$res";














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