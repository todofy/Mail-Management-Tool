<?php
/**
 * @library - apicall
 * @dependencies - database
 */

if(!isset($SECURE)) {
  echo 'We do not show contents to hackers! Try a different way naive!';
  exit;
}
include __DIR__ ."database.php";

class apicall
{
	private $api_name;
	private $api_secret;
	private $params;
	private $template_id;
	private $keys;
	public $state = false;
	public function __construct($parameters)
	{
		if(isset($parameters[0]))
		{
			$api_name = $parameters[0];
			if(isset($parameters[1]))
			{
				$api_secret = $parameters[1];
				if(!empty($parameters[2]))
				{
					foreach ($parameters[2] as $value) {
						$params[] = $value;
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
		//define this
		//if verified get the template id and the param keys
	}
	public function callapi()
	{
		//generate the url for the api call
		$Url = 'localhost/api/' ;
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