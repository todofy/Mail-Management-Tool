<?php
    //get email and new access list
	$email = $data['email'];
	$access = $data['access[]'];
	//get id of the admin to be edited
	$result = database::SQL("SELECT id from admin where email = ? LIMIT 1",array('s',$email));
	if(!empty($result)){
		$id = $result[0]['id'];
		//delete previous accesses of admin
    	$result = database::SQL("DELETE FROM admin_access WHERE admin_id = ? ",array('i',$id));
    	//insert the new accesses
    	if(!empty($access)){
    		if(is_array($access)){
	    		foreach ($access as $value){
	    			$result = database::SQL("INSERT into admin_access values (?,?)",array('ii',$id,$value));
	    		}
	    	}else
	    	$result = database::SQL("INSERT into admin_access values (?,?)",array('ii',$id,$access));
	    }
	    $output['error'] = false;
		$output['message'] = 'Successfully edited.';
	}
    else{
    	$output['error']=true;
	    $output['message']='Admin is not present in database.';
    }
?>