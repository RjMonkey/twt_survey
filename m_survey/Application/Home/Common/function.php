<?php 
	

function log_in(){

	
	include_once("TWTAPIHelper.php");
	if(I('post.username')){
		//获取请求的数据
		$username = trim(I('post.username'));
		$password = trim(I('post.password'));   //使用I方法增强安全性


		@session_start();
		$TWTAPI=new TWTAPIHelper(array(
			'url'		=>	'http://www.twt.edu.cn/api/',
			'domain'	=>	'ihome',
			'api_key'	=>	'27faadde9acc645dd3499fe0d05470',
		));

		$result=$TWTAPI->query("twt.login",array(
			'username'	=>	$username,
			'password'	=>	$password,
		));

		return $result;

	}
}

function  check_login(){
	$username=I('session.username',0);
	if($username){
		return true;
	}	
	else{

		echo"<script language='javascript'>alert('请先登录！');window.location.href='".U('Index/index')."';</script>";
		return false;
	} 
		
}

//将字符串根据分隔符转换为数组，字符串插入方式为'@..@..'
function to_array($str){
	 return explode("@",$str);
}

function to_array2($str){
	return explode("|",$str);
}


function to_string($arr){
	$string=implode('@',$arr);
	$str='@'.$string;
	 return  $str;
}

function sendMail($to, $title, $content) {


	$mail = new PHPMailer(); //实例化
	$mail->IsSMTP(); // 启用SMTP
	$mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
	$mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
	$mail->Username = C('MAIL_USERNAME'); //你的邮箱名
	$mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
	$mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
	$mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
	$mail->AddAddress($to,"尊敬的同学");
	$mail->WordWrap = 50; //设置每行字符长度
	$mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
	$mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
	$mail->Subject =$title; //邮件主题
	$mail->Body = $content; //邮件内容
	$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
	return($mail->Send());
}

function exportexcel($data=array(),$title=array(),$filename='report',$filetitle){
	vendor(PHPExcel.php);
	vendor(PHPExcel);
	//导出xls 开始
	$objPHPExcel=new PHPExcel();
	$objPHPExcel->getProperties()->setTitle($filetitle)->setSubject($filetitle);
	$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	$titlenum=count($title);
	$datanum=count($data);
	$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellName[$titlenum-1].'1');
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $filetitle.'  导出Excel时间:'.date('Y-m-d H:i:s'));
	for($i=0;$i<$titlenum;$i++){
		$objPHPExcel->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(20);
	}
	for($i=0;$i<$titlenum;$i++){
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $title[$i]);
	}
	for($i=0;$i<$datanum;$i++){
		for($j=0;$j<$titlenum;$j++){
			$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $data[$i][$j]);
		}
	}
	//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Hello');

	ob_end_clean();  //清空缓存
	header("Content-type:application/octet-stream");
	header("Accept-Ranges:bytes");
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:attachment;filename=".$filename.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
}


//将多维数组按某个键值进行排序
 function array_sort($arr, $keys, $type = 'asc') {

        $keysvalue = $new_array = array();

        foreach ($arr as $k => $v) {

            $keysvalue[$k] = $v[$keys];
        }

        if ($type == 'asc') {

            asort($keysvalue);
        } else {

            arsort($keysvalue);
        }

        reset($keysvalue);

        foreach ($keysvalue as $k => $v) {

            $new_array[] = $arr[$k];
        }

        return $new_array;
    }

	function getIP() /*获取客户端IP*/
	{
		if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else if (@$_SERVER["HTTP_CLIENT_IP"])
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		else if (@$_SERVER["REMOTE_ADDR"])
			$ip = $_SERVER["REMOTE_ADDR"];
		else if (@getenv("HTTP_X_FORWARDED_FOR"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (@getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if (@getenv("REMOTE_ADDR"))
			$ip = getenv("REMOTE_ADDR");
		else
			$ip = "Unknown";
		return $ip;
	}

	function cout($str){
		echo "<pre>";
		print_r($str);
		echo "</pre>";
	}

	function getSurvey(){
		$condition['survey_id'] = I('get.survey_id');
		$survey = M('Main')->where($condition)->find();
		$question = M('Question')->where($condition)->select();
		foreach($question as $key => $item){
			$condition_option['question_id'] = $item['question_id'];
			$question[$key]['option'] = M('Option')->where($condition_option)->order('option_num')->select();
		}
		$survey['question'] = $question;
		return $survey;
	}

	function get_sso_object(){
		require('sso.php');
		return new TwTSSO(8, 'xVNxrf0yMuy7Cgs3pqdB', false, true);
	}

?>

	


    