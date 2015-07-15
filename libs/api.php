<?php
/**
 * @library - apicall
 * @dependencies - database, session
 */

if(!isset($SECURE)) {
  echo 'We do not show contents to hackers! Try a different way naive!';
  exit;
}
include __DIR__ ."database.php";
include __DIR__ ."session.php";

class api
{	
	private $secret_key;
	private $api_name;
	private $api_params;
	private $template_id;
	private $keys;
	public $state = false;
	public function __construct($parameters)
	{
		if(isset($parameters[0]))
		{
			$secret_key = $parameters[0];
			if(isset($parameters[1]))
			{
				$api_name = $parameters[1];
				if(!empty($parameters[2]))
				{
					foreach ($parameters[2] as $value) {
						$api_params[] = $value;
					}
					$state = true;
				}
				else
					$state = false;
			}
			else
				$state = false;
		}
		else
			$state = false;
	}

	private function validate_call()
	{
		$admin_id = session::getUserID();
		$result = database::SQL("SELECT `secret` FROM `admin` WHERE `id`=? LIMIT 1",array('i',$admin_id));
		if(empty($result))	return false;
		else{
			if($result['secret'] == $secret_key)  return true;
			else return false;
		}
	}

	public function getURL()
	{
		//generate the url for the api call
		$Url = 'localhost/Mail-Management-Tool/api/' ;
		$Url. = $api_name.'.php?';
		//use the keys obtained in validate_function
        $count = count($params);
        for($i = 0; $i < $count; $i++)
        {
            $Url .= $keys[$i];
            $Url . = '='.$params[$i];
            if($i<$count-1)
            $Url .= '&';
        }
        return $Url;

	}
}

?>