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
	private $api_code;
	private $api_id;
	private $api_params;
	private $template_id;
	private $to;
	private $response;
	private $keys;
	public $err;
	public $state = false;
	public function __construct($api_code, $parameters)
	{
		if(isset($api_code))
		{
			$this->api_code = $api_code;
			if(!empty($parameters))
			{
				foreach ($parameters as $key => $value) {
					$this->api_params[$key] = $value;
				}
				$this->state = true;
			}
			else
				$this->state = false;
		}
		else
			$this->state = false;
	}

	//function to check if api call is correct
	public function validate_call()
	{
		if($this->state == true)
		{
			$this->state = false;
			//validate the api code
			$result = database::SQL("SELECT `id`,`template_id` from `api` where `code` = ?",array('s',$this->api_code));
			if(!empty($result))
			{
				$this->api_id = $result[0]['id'];
				$this->template_id = $result[0]['template_id'];
				//now get the keys
				$result = database::SQL("SELECT `name` from `api_params` where `template_id` = ?",array('i',$this->template_id));
				if(!empty($result))
				{
					foreach ($result as $value) {
						$success = true;
						$temp = trim($value['name'],"{}");
						$this->keys[] = $temp;
						//to check whether the keys specified are correct
						if(!isset($this->api_params[$temp]))
						{
							$success = false;
							break;
						}
					}
					if($success)
					{
						if(count($this->keys) == count($this->api_params))
						{
							$this->state = true;
						}
						else $this->err = "Check the value or/and number of parameters.";
					}
					else $this->err = "Wrong keys passed.";							
				}
				else $this->err = "Parameters not found.";
			}
			else $this->err = "API doesn't exist in database.";
		}
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
		foreach ($this->api_params as $key => $value) {
			$this->response =  str_replace("{{".$key."}}", $value,$this->response);
		}
		return $this->response;
	}


	//function to return api name
	public function code(){
		return $this->api_code;
	}

	//function to return api id
	public function id(){
		return $this->api_id;
	}

	//function to return the 'to' parameter
	public function send_to(){
		return $this->to;
	}

};
?>