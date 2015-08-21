<?php
$sessObj = new session();

if (!$sessObj->state) {
	redirect_to("index.php");
}
$id = session::getUserID();
$newuser = new user($id);

$result = database::SQL("SELECT `secret` FROM `admin` WHERE `id`=? LIMIT 1",array('i',$id));
$secret_key = $result[0]['secret'];

if(count($_POST)!=0){

	$getKey = $_POST['key'];
	$search_key = '%'.$getKey.'%';

	//check for Admins in the database
	$search_admin = array();
	$result = database::SQL("SELECT `id`, `email`, `last_login` FROM `admin` WHERE `email` LIKE ? " , array('s' , $search_key) );
	if(!empty($result)) {
		foreach ($result as $key => $value) {
			$campaigns = database::SQL("SELECT COUNT(`campaign`.`id`) AS `campaigns` FROM `campaign`,`admin` WHERE `campaign`.`secret_key`=`admin`.`secret` AND `admin`.`id`=?",array('i',$value['id']));
			$search_admin[] = array('id'=> $value['id'] , 'email' =>$value['email'], 'last_login'=>$value['last_login'], 'campaigns'=>$campaigns[0]['campaigns']); 
		}	
	}

	//check for Campaigns in the database
	$search_campaign = array();
	$result = database::SQL("SELECT `campaign`.`id`, `subject`, `api_code`, `payload_length`, `mails_processed`, `time_started`, `time_finished` FROM `campaign`,`admin` WHERE `campaign`.`id` LIKE ? OR `subject` LIKE ? AND `campaign`.`secret_key`=`admin`.`secret` AND `admin`.`secret`=? GROUP BY `campaign`.`id`" , array('sss' , $search_key, $search_key, $secret_key) );
	if(!empty($result)) {
		foreach ($result as $key => $value) {
			$clicks = database::SQL("SELECT SUM(`clicks`) AS `clicks` FROM `mail`, `link_hash` WHERE `mail`.`id` = `link_hash`.`mail_id` AND `campaign_id`=? GROUP BY `campaign_id`",array('s',$value['id']));
			if (empty($clicks)) {
				$total_clicks = 0;
			}
			else
				$total_clicks = $clicks[0]['clicks'];
			$search_campaign[] = array('id'=> $value['id'] , 'subject'=> $value['subject'], 'api_code'=>$value['api_code'], 'payload_length'=>$value['payload_length'], 'mails_processed'=>$value['mails_processed'], 'time_started'=>$value['time_started'], 'time_finished'=>$value['time_finished'], 'clicks'=>$total_clicks ); 
		}	
	}

	//check for APIs in the database
	$search_api = array();
	$result = database::SQL("SELECT `id`, `code` , `name`, `created_on` FROM `api` WHERE `code` LIKE ? OR `name` LIKE ?" , array('ss' , $search_key , $search_key) );
	if(!empty($result)) {
		foreach ($result as $key => $value) {
			$template = database::SQL("SELECT `template`.`name` AS `name` FROM `api`,`template` WHERE `code`=? AND `api`.`template_id`=`template`.`id`",array('s',$value['code']));
			$search_api[] = array('id'=> $value['id'] , 'code'=> $value['code'] , 'name' =>$value['name'], 'created_on'=>$value['created_on'], 'template_name'=>$template[0]['name']); 
		}	
	}

	//check for Templates in the database
	$search_template = array();
	$result = database::SQL("SELECT `id`, `name`, `created_on`, `last_updated` FROM `template` WHERE `name` LIKE ?" , array('s' , $search_key) );
	if(!empty($result)) {
		foreach ($result as $key => $value) {
			$parameters = database::SQL("SELECT COUNT(`name`) AS `parameters` FROM `api_params` WHERE `template_id`=?",array('i',$value['id']));
			$links = database::SQL("SELECT COUNT(`url`) AS `links` FROM `links` WHERE `template_id`=?",array('i',$value['id']));
			$search_template[] = array('id'=> $value['id'] , 'name'=> $value['name'] , 'created_on' =>$value['created_on'], 'last_updated'=>$value['last_updated'], 'parameters'=>$parameters[0]['parameters'], 'links'=>$links[0]['links']); 
		}	
	}

	$total_results = count($search_admin) + count($search_campaign) + count($search_api) + count($search_template);
	$error = false;
}
else{
	$error = true;
}

$_SEARCH_VIEW_ = true;
?>