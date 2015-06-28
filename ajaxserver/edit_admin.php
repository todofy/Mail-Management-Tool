<?php
    //get email and new access list
	$email = $data['email'];
	$access = $data['access[]'];
	//get id of the admin to be edited
	$result = database::SQL("SELECT id from admin where email = ? LIMIT 1",array('s',$email));
	if(!empty($result)){
		$id = $result[0]['id'];
		//delete previous accesses of admin
    	$result = database::SQL("DELETE FROM acl WHERE admin_id = ? ",array('s',$id));
    	//insert the new accesses
    	if(!empty($access) && is_array($access))
	    	foreach ($access as $value){
	    		$result = database::SQL("INSERT into admin_access values (?,?)",array('ss',$id,$value));
	    	}
	    $output['error'] = false;
		$output['message'] = 'Successfully edited.';
	}
    else{
    	$output['error']=true;
	    $output['message']='Admin is not present in database.';
    }
?>