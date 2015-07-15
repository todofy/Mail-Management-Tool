<?php
/**
 * @library - apicall
 * @dependencies - database, session
 */

if(!isset($SECURE)) {
  echo 'We do not show contents to hackers! Try a different way naive!';
  exit;
}

include __DIR__ .'/database.php';
include __DIR__ .'/session.php';

class api
{	
	private $secret_key;
	private $api_name;
	private $api_params;
	private $template_id;
	private $response;
	private $keys;
	public $state = false;
	public function __construct($secret_key, $api_name, $parameters)
	{
		if(isset($secret_key))
		{
			$this->secret_key = $secret_key;
			if(isset($api_name))
			{
				$this->api_name = $api_name;
				if(!empty($parameters))
				{
					foreach ($parameters as $value) {
						$this->api_params[] = $value;
					}
					$this->state = true;
				}
				else
					$this->state = false;
			}
			else
				$this->state = false;
		}
		else
			$this->state = false;
	}

	//function to check if secret key sent is correct
	private function validate_call()
	{
		$admin_id = session::getUserID();
		$result = database::SQL("SELECT `secret` FROM `admin` WHERE `id`=? LIMIT 1",array('i',$admin_id));
		if(empty($result))	return false;
		else{
			if($result['secret'] == $this->secret_key)  return true;
			else return false;
		}
	}

	//function to generate url for api call //There is some error in here...use $this
	/*public function getURL()
	{
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

	}*/

	//function to replace parameters in template with their values
	public function replace_params()
	{
		//get the template id
		$result = database::SQL("SELECT `template_id` FROM `api` WHERE `name` = ? LIMIT 1",array('s',$this->api_name));
		$this->template_id = $result[0]['template_id'];
		//get template text
		$result = database::SQL("SELECT `template` FROM `template` WHERE `id` = ? LIMIT 1",array('i',$this->template_id));
		$this->response = $result[0]['template'];
		//replace parameters with values
		preg_match_all('/{{(.*?)}}/', $this->response, $temp);
		$count = count($temp[1]);
		for ($i=0; $i < $count ; $i++) { 
			str_replace($temp[0][$i], $this->api_params[$i], $this->$response);
		}
		return $this->response;
	}

	//function to return api name
	public function name(){
		return $this->api_name;
	}
	//function to execute the api
};


?>