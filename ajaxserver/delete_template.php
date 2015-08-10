<?php
    //get id of template to be deleted
	$id = $data['template_id'];
	//check if template present in the database
	$result = database::SQL("SELECT id FROM template WHERE id=?",array('i',$id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'Template not in the database.';
	}
	else{		
		//check if template is used by any api or not
		$result = database::SQL("SELECT id,name,code FROM api WHERE template_id = ?",array('i',$id));
		if(!empty($result)){
			$output_string = '';
			for ($i=0; $i < count($result); $i++) {
				$api_name = $result[$i]['name'];
				$api_code = $result[$i]['code'];
				$output_string .= "<li>".$api_name." (".$api_code.")</li>";			
			}
			$output['error'] = true;
			$output['message'] = "Template is in use by API(s):".$output_string;
		}
		else{
			//delete the parameters from database
			$result = database::SQL("DELETE FROM api_params WHERE template_id=?",array('i',$id));
			//delete the links from database
			$result = database::SQL("DELETE FROM links WHERE template_id=?",array('i',$id));
			//delete the template from database
			$result = database::SQL("DELETE FROM template WHERE id=?",array('i',$id));
			$output['error'] = false;
			$output['message'] = 'Template deleted.';
		}
	}	
?>