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
	public $err;
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
	public function validate_call()
	{
		if($this->state == true)
		{
			$this->state = false;
			$admin_id = session::getUserID();
			$result = database::SQL("SELECT `secret` FROM `admin` WHERE `id`=? LIMIT 1",array('i',$admin_id));
			if($result[0]['secret'] == $this->secret_key)
			{
				//validate the api name
				$result = database::SQL("SELECT `template_id` from `api` where `name` = ?",array('s',$this->api_name));
				if(!empty($result))
				{
					$this->template_id = $result[0]['template_id'];
					//now get the keys
					$result = database::SQL("SELECT `name` from `api_params` where `template_id` = ?",array('i',$this->template_id));
					if(!empty($result))
					{
						foreach ($result as $value) {
							$this->keys[] = trim($value['name'],"{}");
						}
						if(count($this->keys) == count($this->api_params))
						{
							$this->state = true;
						}
						else $this->err = "Check value of parameters.";
					}
					else $this->err = "Parameters not found.";
				}
				else $this->err = "API name wrong.";
			}
			else $this->err = "Secret key wrong.";
		}
		else $this->err = "Check parameters.";
	}

	//function to generate url for api call //There is some error in here...use $this
	public function getURL()
	{
		if($this->state == false)
			return NULL;
		$Url = 'localhost/Mail-Management-Tool/api/index.php?secret_key='.urlencode($this->secret_key).'&api_name=' ;
		$Url.= urlencode($this->api_name).'&';
		//use the keys obtained in validate_function
        $count = count($this->api_params);
        for($i = 0; $i < $count; $i++)
        {
            $Url.= urlencode($this->keys[$i]);
            $Url.= '=';
            $Url.= urldecode($this->api_params[$i]);
            if($i<$count-1)
            $Url.= '&';
        }
        return $Url;

	}

	//function to replace parameters in template with their values
	public function replace_params()
	{
		if($this->state == false)
			return NULL;
		//get template text
		$result = database::SQL("SELECT `template` FROM `template` WHERE `id` = ? LIMIT 1",array('i',$this->template_id));
		$this->response = $result[0]['template'];
		//replace parameters with values
		for ($i=0; $i < count($this->keys) ; $i++) { 
			$this->response =  str_replace("{{".$this->keys[$i]."}}", $this->api_params[$i],$this->response);
		}
		return $this->response;
	}


	//function to return api name
	public function name(){
		return $this->api_name;
	}

	//function to execute the api
	public function execute(){
		if(!$this->state())	return 'Check parameters passed again.';
		//elseif(!$this->validate_call())	return 'Invalid value or number of parameters used.';
		else{
			$mail = $this->replace_params();
			return $mail;
		}
	}
};


?>