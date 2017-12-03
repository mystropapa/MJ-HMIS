<?php

  

 
/**
     * Random string which is sent by mail to reset password
     */
function random_string()
{
    $character_set_array = array();
    $character_set_array[] = array('count' => 7, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
    $character_set_array[] = array('count' => 1, 'characters' => '0123456789');
    $temp_array = array();
    foreach ($character_set_array as $character_set) {
        for ($i = 0; $i < $character_set['count']; $i++) {
            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
        }
    }
    shuffle($temp_array);
    return implode('', $temp_array);
}



function forgotPassword($forgotpassword, $newpassword, $salt){
  $con=$GLOBALS['con'];
  $result = mysqli_query($con,"UPDATE `users` SET `encrypted_password` = '$newpassword',`salt` = '$salt' 
    WHERE `email` = '$forgotpassword'");

  if ($result) {

    return true;

  }
  else
  {
    return false;
  }

}


function forgotPAPassword($forgotpassword, $newpassword, $salt){
  $con=$GLOBALS['con'];
  $result = mysqli_query($con,"UPDATE `paset_user_acc` SET `encrypted_password` = '$newpassword',`salt` = '$salt' 
    WHERE `email` = '$forgotpassword'");

  if ($result) {
   
    return true;

  }
  else
  {
    return false;
  }

}



//////////////////main functions//////////


/***** auto gen id's ***********/

function rand_fac(){
  $qu=mysqli_query($GLOBALS['con'],'SELECT uid FROM users WHERE uid LIKE  "L%" ORDER BY uid DESC LIMIT 1');
  $check=mysqli_num_rows($qu);
  if ($check!=0) {
   $re=mysqli_fetch_assoc($qu);

if ($c=preg_match_all ("/([a-z])(\\d+)/is", $re['uid'], $matches))
  {
      $w=$matches[1][0];
      $int1=$matches[2][0];
     $int1++;
      $lid=$w.$int1;
 $response= $lid;
  
}
  }else{
    $response= "L100";
  }

return $response;
}






function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


/******
User management Functions

********/

function get_all_users(){
  $con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `users` ORDER by(created_at) ASC');
$check=mysqli_num_rows($query);
   if($check>0){
    
    while ($row=mysqli_fetch_assoc($query)) {
      $response[]=$row;
    
     
    }
     $response["status"]="1";
   }else{
$response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}

function get_one_user($uid){
$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `users` WHERE uid="'.$uid.'"');
   if($query){
    $i=0;
    while ($row=mysqli_fetch_assoc($query)) {
      $response[$i]=$row;
    
      $i++;
    }
    $response["status_msg"]="User found".mysqli_error($con);
    $response["status"]="1";
    
   }else{
    $response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}

function update_one_user($uid,$uname,$email,$priv){
$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `users` WHERE uid="'.$uid.'"');
   if($query){
  
    $ins=mysqli_query($con,'UPDATE `users` SET `uname`="'.$uname.'",`email`="'.$email.'",`priv`="'.$priv.'" WHERE uid="'.$uid.'" ');

    $response["status_msg"]=" Update Successfully".mysqli_error($con);
 
    
   }else{
$response["status_msg"]="Not Updated Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}

function delete_one_user($uid){
$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `users` WHERE uid="'.$uid.'"');
   if($query){
  
    $ins=mysqli_query($con,'DELETE FROM `users` WHERE uid="'.$uid.'" ');

    $response["status_msg"]=" Delete Successfully".mysqli_error($con);
 
    
   }else{
$response["status_msg"]="Not Deleted Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}









function upload_all_pages(){
  //$dir    = '/Applications/XAMPP/xamppfiles/htdocs/aau/paset/admin/';
$dir    = getcwd();
$files1 = scandir($dir);

//print_r($files1);

$length=sizeof($files1);
$pages=array();
for ($i=0; $i <$length ; $i++) { 
  $filename=$files1[$i];
  $pathif=pathinfo($filename);
  $fileext=$pathif['extension'];
  $allowedext=array('php');
  
  if (in_array($fileext,$allowedext)) {
    $pages[$i]=$pathif['filename'];
    $response=add_page($pages[$i],"desc",$pages[$i]);
  }
}
//return $pages;
}

function add_priv($pgid,$priv)// add privledges to pages
{
  $con=$GLOBALS['con'];
  $check=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `page_priv` WHERE `pgid`='".$pgid."' and `priv_id`='".$priv."'"));
  if ($check==0) {
    $ins=mysqli_query($con,"INSERT INTO `page_priv`(`pgid`, `priv_id`) VALUES ('".$pgid."','".$priv."')");
    $response["status_msg"]=" Added Successfully".mysqli_error($con);
      $response["status"]="1";
  }else{
    $response["status_msg"]="Not Added Successfully".mysqli_error($con);
      $response["status"]="0";
  }
  return $response;
}


function add_priv_level($name)// add Privileges  levels
{
  $con=$GLOBALS['con'];
  $hash=md5($name);
  $check=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `privledges` WHERE `hash`='".$hash."'"));
  if ($check==0) {
    $ins=mysqli_query($con,"INSERT INTO `privledges`(`name`, `hash`) VALUES ('".$name."','".$hash."')");
    $response["status_msg"]=" Added Successfully".mysqli_error($con);
      $response["status"]="1";
  }else{
    $response["status_msg"]="Not Added Successfully".mysqli_error($con);
      $response["status"]="0";
  }
  return $response;
}

function add_page($pname,$pdesc,$purl) // add a new page
{
  $con=$GLOBALS['con'];
  $check=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `pages` WHERE pname='".$pname."' OR purl= '".$purl."'"));
  if ($check==0) {
    $ins=mysqli_query($con,'INSERT INTO `pages`( `pname`, `desc`, `purl`) VALUES ("'.$pname.'","'.$pdesc.'","'.$purl.'")') or die(mysqli_error($con));
    $pgid=mysqli_insert_id($con);
    $add=add_priv($pgid,'2');
    if ($ins) {
      $response["status_msg"]="Added Successfully";
         $response["status"]="1";
    }else{
      $response["status_msg"]="Not Added Successfully".mysqli_error($con);
       $response["status"]="0";
      
    }
  }else{
    $response["status_msg"]="Page Already Exist".mysqli_error($con);
    $response["status"]="0";
      
  }
  return $response;
}


function reset_priv($pgid) //reset page Privileges 
{
  $con=$GLOBALS['con'];
  $check=mysqli_query($con,"DELETE FROM `page_priv` WHERE `pgid`='".$pgid."'");
  
    $response["status_msg"]=" Reset Successful".mysqli_error($con);
      $response["status"]="1";
    
  return $response;
}
function reset_priviii($pgid) //reset page Privileges 
{
   $con=$GLOBALS['con'];
  $check=mysqli_query($con,"DELETE FROM `page_priv` WHERE `priv_id`='".$pgid."'");
  
    $response["status_msg"]=" Reset Successful".mysqli_error($con);
      $response["status"]="1";
    
  return $response;
}


function get_page_pri($pgid){ // get alll page 
  $con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `page_priv` Where `pgid`="'.$pgid.'"');
   if($query){
    $i=0;
    while ($row=mysqli_fetch_assoc($query)) {
      $response[$i]=$row;
    
      $i++;
    }
    
   }else{
$response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}

function delete_page($pgid)// delete a page
{
  
  $con=$GLOBALS['con'];
  $del1=mysqli_query($con,'DELETE FROM `pages` WHERE `pID` ="'.$pgid.'"');
  $del2=mysqli_query($con,'DELETE FROM `page_priv` WHERE `pgid` ="'.$pgid.'"');

  $response["status_msg"]=" Page Delete Successful".mysqli_error($con);
  $response["status"]="1";
    
  return $response;
}

function del_priv($privid)// delete a page
{
  
  $con=$GLOBALS['con'];
  $del1=mysqli_query($con,'DELETE FROM `privledges` WHERE `priv_ID` ="'.$privid.'"');
  

  $response["status_msg"]=" Privileges  Delete Successful".mysqli_error($con);
  $response["status"]="1";
    
  return $response;
}




function get_all_priv(){ // view all privilege levels

$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `privledges` ');
$check=mysqli_num_rows($query);
   if($check > 0){
    $i=0;
    while ($row=mysqli_fetch_assoc($query)) {
      $response[]=$row;
    
     
    }
    $response["status"]="1";
   }else{
  $response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

return $response;

}


function get_all_pages(){ // get all admin pages

$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `pages`');
   if($query){
    $i=0;
    while ($row=mysqli_fetch_assoc($query)) {
      $response[$i]=$row;
    
      $i++;
    }
    
   }else{
$response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}

function get_one_page($pgid){ //get one page

$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * from `pages` where `pID`="'.$pgid.'"');
$count=mysqli_num_rows($query);
   if($query){
    while ($row=mysqli_fetch_assoc($query)) {
      $response["det"]=$row;
      
    }
    $response["count"]=$count;
   }else{
$response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}

function get_one_privi($privid){ //get one privilege details

$con=$GLOBALS['con'];
$query=mysqli_query($con,'SELECT * FROM  `privledges` where `priv_ID` ="'.$privid.'"');
$count=mysqli_num_rows($query);
   if($query){
    while ($row=mysqli_fetch_assoc($query)) {
      $response["det"]=$row;
      
    }
    $response["count"]=$count;
   }else{
$response["status_msg"]="Not Viewed Successfully".mysqli_error($con);
    $response["status"]="0";
   }

 return $response;

}



/*User log management*/


function logUser($uid,$pgid){
 $addlog=mysqli_query($GLOBALS['con'], 'INSERT INTO `logs`(`userID`, `pgID`, `time`) VALUES ("'.$uid.'","'.$pgid.'",NOW())');
}

function getOneUserLog($uid){
  $getUser=get_one_user($uid);
  $checkRow=$getUser['status'];

  if($checkRow == 1){
    
    $getLogs=mysqli_query($GLOBALS['con'],"SELECT * FROM `all_logs` where `uid`='".$uid."'");

    $count=mysqli_num_rows($getLogs);
   if ($count>1) {
      while ($row =mysqli_fetch_assoc($getLogs)) {
      $response['data'][]=$row;
    }
    $response["status_msg"]=" Logs fetched Successfully";
    $response["status"]="1";
    }else{
      $response["status_msg"]="User logs not exist".mysqli_error($GLOBALS['con']);
    $response["status"]="0";
    }
    
 }else{
    $response["status_msg"]="User does not exist".mysqli_error($GLOBALS['con']);
    $response["status"]="0";
  }
  return $response;
}


function getAllLogs(){
  $getLogs=mysqli_query($GLOBALS['con'],"SELECT * FROM `all_logs` ");
  $count=mysqli_num_rows($getLogs);
   if ($count>1) {
      while ($row =mysqli_fetch_assoc($getLogs)) {
      $response['data'][]=$row;
    }
    $response["status_msg"]=" Logs fetched Successfully";
    $response["status"]="1";
    }else{
      $response["status_msg"]="No Logs available".mysqli_error($GLOBALS['con']);
    $response["status"]="0";
    }
return $response;
}




/*End user log managment*/


/* Custom framework Query Management */
function runQuery($query)
{
  // Set autocommit to off
mysqli_autocommit($GLOBALS['con'],FALSE);
  if ($query!="") {
    
   if ($query=mysqli_query($GLOBALS['con'],$query)) {
     $response['query']=$query;
    
    $response['status']=1;
    $response['status_msg']="Query Successful: ".mysqli_error($GLOBALS['con']);
    // Commit transaction
    mysqli_commit($GLOBALS['con']);
   }else{
    $response['status']=0;
    $response['status_msg']="Query Unsuccessful: ".mysqli_error($GLOBALS['con']);
    // Rollback transaction
    mysqli_rollback($GLOBALS['con']);

   }
    

  }else{
    $response['status']=0;
    $response['status_msg']="Query Unsuccessful: ".mysqli_error($GLOBALS['con']);
    // Rollback transaction
    mysqli_rollback($GLOBALS['con']);
  }
  // Close connection
  //mysqli_close($GLOBALS['con']);
  return $response;
}

function countQuery($query)
{
  if (!empty($query)) {
  
    $count=mysqli_num_rows($query);
    $response['count']=$count;
  
    $response['query']=$query;
    
    $response['status']=1;
    $response['status_msg']="Query Successful: ".mysqli_error($GLOBALS['con']);

  }else{
    $response['status']=0;
    $response['status_msg']="Query Unsuccessful: ".mysqli_error($GLOBALS['con']);
  }
  return $response;
}


function fetchAssoc($query)
{
  if (!empty($query)) {
   // $query=mysqli_query($GLOBALS['con'],$query);
    $count=mysqli_num_rows($query);
    if ($count==0) {
      //$response['data']="NO data present";
      $response['status_msg']="NO data present";
      $response['status']=4;
    }else{
      while ($row=mysqli_fetch_assoc($query)) {
        $response['data'][]=$row;
        $response['status']=1;
      }
    }
    $response['query']=$query;
    $response['count']=$count;
    
    //$response['status_msg']=mysqli_error($GLOBALS['con']);

  }else{
    $response['status']=0;
    $response['status_msg']="Query Unsuccessful: ".mysqli_error($GLOBALS['con']);
  }
  return $response;
}
/*end of Custom Framework query management */







/***************
***************
****************

BEGIN MAIN SYSTEM FUNCTIONS


****************/


/*ROOM TYPE BASIC FUNCTIONS*/
function add_room_type($typeName,$typeDesc,$rate){

  $check=runQuery("SELECT * FROM `room_types` WHERE `type_name`='".$typeName."' and `rate` ='".$rate."'");
  $countRow=countQuery($check['query']);

  if ($countRow['count']==0) {
    $insert=runQuery("INSERT INTO `room_types`( `type_name`, `type_desc`, `rate`, `added_by`) VALUES ('".$typeName."','".$typeDesc."','".$rate."','".$_SESSION['uid']."')");
    if ($insert['status']==1) {
      $response['status']=1;
      $response['status_msg']="Room Type Added successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Room Type not Added successfully error code: ". $insert['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Room Type already Added ";
  }
  return $response;
}


function update_room_type($typeID,$typeName,$typeDesc,$rate){

  $check=runQuery("SELECT * FROM `room_types` WHERE `type_id`='".$typeID."'");
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $update=runQuery("UPDATE `room_types` SET ,`type_name`='".$typeName."',`type_desc`='".$typeDesc."',`rate`='".$rate."',`updated_by`='".$_SESSION['uid']."' WHERE `type_id`='".$typeID."'");
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Room Type update successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Room Type update not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Room Type does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function delete_room_type($typeID){

  $check=runQuery("SELECT * FROM `room_types` WHERE `type_id`='".$typeID."'");
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $delete=runQuery("DELETE FROM `room_types` WHERE `type_id`='".$typeID."'");
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Room Type delete successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Room Type delete not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Room Type does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function get_one_room_type($typeID){

  $check=runQuery("SELECT * FROM `room_types` WHERE `type_id`='".$typeID."'");
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']==1) {
      $response=$fetchQuery;
      $response['status_msg']='Room Type Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="Room Type does not exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

function get_all_room_type(){

  $check=runQuery("SELECT * FROM `room_types`");
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']>0) {
      $response=$fetchQuery;
      $response['status_msg']='Room Types Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="No Room Types exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

/*END ROOM TYPE BASICS*/




/*ROOM BASICS*/
function add_room($roomName,$roomTypeID,$status){

  $check=runQuery(' SELECT * FROM `rooms` WHERE `room_name`="'.$roomName.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==0) {
    $insert=runQuery("INSERT INTO `rooms`(`room_name`, `room_type_id`, `status`, `added_by`, `date_added`) VALUES ('".$roomName."','".$roomTypeID."','".$status."','".$_SESSION['uid']."',NOW())");
    if ($insert['status']==1) {
      $response['status']=1;
      $response['status_msg']="Room Added successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Room not Added successfully error code: ". $insert['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Room already Added ";
  }
  return $response;
}


function update_room($roomID,$roomName,$roomTypeID,$status){

  $check=runQuery('SELECT * FROM `rooms` WHERE `room_ID`="'.$roomID.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $update=runQuery('UPDATE `rooms` SET ,`room_name`="'.$roomName.'",`room_type_id`="'.$roomTypeID.'",`status`="'.$status.'" WHERE `room_ID`="'.$roomID.'"');
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Room update successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Room update not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Room does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function delete_room($roomID){

  $check=runQuery('SELECT * FROM `rooms` WHERE `room_ID`="'.$roomID.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $delete=runQuery('DELETE FROM `rooms` WHERE `room_ID`="'.$roomID.'"');
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Room delete successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Room delete not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Room does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function get_one_room($roomID){

  $check=runQuery('SELECT * FROM `rooms` WHERE `room_ID`="'.$roomID.'"');
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']==1) {
      $response=$fetchQuery;
      $response['status_msg']='Room Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="Room does not exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

function get_all_rooms(){

  $check=runQuery('SELECT * FROM `rooms` ');
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']>0) {
      $response=$fetchQuery;
      $response['status_msg']='Room Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="No Rooms exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

/*END ROOM BASICS*/






/*EXTRA SERVICES BASICS*/
function add_extraService($extraName,$extraDesc,$rate){

  $check=runQuery('SELECT * FROM `extra_services` WHERE `extra_name` ="'.$extraName.'" and `desc`="'.$extraDesc.'" and`rate`="'.$rate.'" ');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==0) {
    $insert=runQuery("INSERT INTO `extra_services`(`extra_name`, `desc`, `rate`, `added_by`) VALUES ('".$extraName."','".$extraDesc."','".$rate."','".$_SESSION['uid']."')");
    if ($insert['status']==1) {
      $response['status']=1;
      $response['status_msg']="Extra Service Added successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Extra Service not Added successfully error code: ". $insert['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Extra Service already Added ";
  }
  return $response;
}


function update_extraService($extraServiceID,$extraName,$extraDesc,$rate){

  $check=runQuery('SELECT * FROM `extra_services` WHERE `id`="'.$extraServiceID.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $update=runQuery('UPDATE `extra_services` SET `extra_name`="'.$extraName.'",`desc`="'.$extraDesc.'",`rate`="'.$rate.'",`added_by`="'.$_SESSION['uid'].'" WHERE `id`="'.$extraServiceID.'"');
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Extra Service update successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Extra Service update not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Extra Service does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function delete_extraService($extraServiceID){

  $check=runQuery('SELECT * FROM `extra_services` WHERE `id`="'.$extraServiceID.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $delete=runQuery("DELETE FROM `extra_services` WHERE `id`='".$extraServiceID."'");
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Extra Service delete successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Extra Service delete not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Extra Service does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function get_one_extraService($extraServiceID){

  $check=runQuery('SELECT * FROM `extra_services` WHERE `id`="'.$extraServiceID.'"');
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']==1) {
      $response=$fetchQuery;
      $response['status_msg']='Extra Service Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="Extra Service does not exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

function get_all_extraServices(){

  $check=runQuery('SELECT * FROM `extra_services`');
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']>0) {
      $response=$fetchQuery;
      $response['status_msg']='Room Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="No Extra Services exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

/*END ROOM BASICS*/






/*GUEST BASICS*/
function add_Guest($Name,$gender,$email,$phone,$address,$ifNOTGhananian,$scannedpassport,$guestType){

  $check=runQuery('SELECT * FROM `guest` WHERE `Name`="'.$Name.'" and `phone`="'.$phone.'"and`email`="'.$email.'" ');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==0) {
    $insert=runQuery('INSERT INTO `guest`(`Name`, `gender`, `email`, `phone`, `address`, `if-not-ghanaian`, `scanned_passport`, `guest_type`, `added_by`, `added_at`) VALUES ("'.$Name.'","'.$gender.'","'.$email.'","'.$phone.'","'.$address.'","'.$ifNOTGhananian.'","'.$scannedpassport.'","'.$guest_type.'","'.$_SESSION['uid'].'",NOW())');
    if ($insert['status']==1) {
      $response['status']=1;
      $response['status_msg']="Guest  Added successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Guest not Added successfully error code: ". $insert['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Guest already Added ";
  }
  return $response;
}


function update_Guest($gid,$Name,$gender,$email,$phone,$address,$ifNOTGhananian,$guestType){

  $check=runQuery('SELECT * FROM `guest` WHERE gid="'.$gid.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $update=runQuery('UPDATE `guest` SET `Name`="'.$Name.'",`gender`="'.$gender.'",`email`="'.$email.'",`phone`="'.$phone.'",`address`="'.$address.'",`if-not-ghanaian`="'.$ifNOTGhananian.'",`scanned_passport`="'.$scannedpassport.'",`guest_type`="'.$guest_type.'" WHERE `gid`="'.$gid.'"');
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Guest update successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Guest update not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Guest does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function delete_guest($gid){

  $check=runQuery('SELECT * FROM `guest` WHERE gid="'.$gid.'"');
  $countRow=countQuery($check['query']);

  if ($countRow['count']==1) {
    $delete=runQuery('DELETE FROM `guest` WHERE gid="'.$gid.'"');
    if ($update['status']==1) {
      $response['status']=1;
      $response['status_msg']="Guest delete successfully";
    }else{

      $response['status']=0;
      $response['status_msg']="Guest delete not successfully error code: ". $update['status_msg'];
    }
  }else{

      $response['status']=0;
      $response['status_msg']="Guest does not exist error code: ".$countRow['count'];
  }
  return $response;
}


function get_one_guest($extraServiceID){

  $check=runQuery('SELECT * FROM `guest` WHERE gid="'.$gid.'"');
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']==1) {
      $response=$fetchQuery;
      $response['status_msg']='Extra Service Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="Extra Service does not exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

function get_all_guests(){

  $check=runQuery('SELECT * FROM `guest` ');
  $fetchQuery=fetchAssoc($check['query']);

  if ($fetchQuery['count']>0) {
      $response=$fetchQuery;
      $response['status_msg']='Room Fetced';
  }else{

      $response['status']=0;
      $response['status_msg']="No Extra Services exist error code: ".$fetchQuery['count'];
  }
  return $response;
}

/*END ROOM BASICS*/



















////////////////////end of main functions////////////////




function draft_referee_email($name,$email,$id,$upload_id){
//$enc = str_replace("+", "%2B",$enc);
  $con=$GLOBALS['con'];
ini_set('smtp_port',25);
$uid=base64_encode($id);
$sec=base64_encode($loc);
$password=generateRandomString();
$query=mysqli_query($con,"SELECT * from `paset_referee_acc`  WHERE User_ID='".$id."' and ref_email='".$email."'");
$checkInsReferee=mysqli_num_rows($query);
if($checkInsReferee==0){
  $insertRefereeAcc=mysqli_query($con,"INSERT INTO `paset_referee_acc`( `User_ID`,`upload_id`,`Name` ,`ref_email`, `ref_password`, `status`, `last_login`) VALUES ('$id','$upload_id','$name','$email','$password','Not Active','Never')");
  $ref_ID=mysqli_insert_id($con);
}else{
  $getREF=mysqli_fetch_assoc($query);
  $ref_ID=$getREF['ref_ID'];
}
$link="".$GLOBALS['sysurl']."/ReferenceUpload.php?uid=".$uid."&sec=".$sec."&refac=".$ref_ID;

$msg="Hello ".$name.", <br>".$_SESSION['fullname']." has asked for your support with their RSIF-PASET application.<br><br>Letters of recommendation, academic evaluations, profiles, and other supporting documents play an important role in the admission process. As a Counselor, you can provide insights about students such as their strengths, aspirations, and potential for success.<br><br><br><br><b>Student information:</b><br><br>Name of student: ".$_SESSION['fullname']."<br><br>Email address: ".$_SESSION['email']."<br><br><br><br><b>Activating your account:<br></b>Your username is: ".$email."<br>Your Password is: ".$password."<br><br>Your link: <a href='".$link."' />Upload your Reference Now</a><br> If the above link does not work, please access the application website by pasting or clicking the link below into your browser<br><br><a href='".$link."'>".$link."</a> <br><br>Please visit our website to activate your account.By registering with the online system, you will be able to submit materials for this and all other students who invite you.<br><br>Please note that you are required to upload one(1) file on behalf of your student. If for any reason you would want to upload more. All the files would have to be merge into one pdf and uploaded. All file uploads must not exceed 5 MB.<br><br>The personalized links above will be active for 90 days. It is quick and easy to set up your online account and doing so will prevent the links from expiring. If the links expire, the student will need to send a new invitation.<br><br>We appreciate everything that you do on behalf of your students, and we are here to help you in that effort. If at any time you have a question or want to connect, Send us an email paset@aau.org<br><br>Thank you,<br> The RSIF-PASET application<br><br> NB: This is an automated  message. Please do not reply.";

$to=$email;
//put applicant name here
$subject=$_SESSION['fullname']." request your Recommendation  ";

// To send HTML mail, the Content-type header must be set


if(mail($to, $subject,$msg, $GLOBALS['headers'])){
    $response['status']=1;
    $response['msg_sent']='Message Sent please Check your Inbox for any email sent from AAU';
  }else{
    $response['status']=0;
    $response['msg_nosent']='An error occurred Please contact pymireku@aau.org or assistance';

  }
  $response['ref_ID']=$ref_ID;
return $response;
}




/**
     * Adding new user to mysql database
     * returns user details
     */


     function storeUser($uid,$uname,$email,$dob,$gd,$adds,$phone,$priv,$password) {
        
         $con=$GLOBALS['con'];
         if (isUserExisted($email)!=true) {
               # code...
             
            $hash = hashSSHA($password);
            $encrypted_password = $hash["encrypted"]; // encrypted password
            $salt = $hash["salt"]; // salt
            $result = mysqli_query($con,"INSERT INTO `users`(`uid`, `uname`, `email`, `priviledge_level`, `enc_pass`, `salt`, `last_login`, `created_at`) VALUES ('$uid','$uname','$email','$priv','$encrypted_password', '$salt','Never', NOW())");
        
            // check for successful store
            if ($result) {
                 $response["status"] = 1;
            $response["status_msg"] ="User successfully Added";

            //$response["user"]["created_at"] = $user["created_at"];
            ini_set('smtp_port',25);
            $body=wordwrap("Hi $uname,\n\nYour username and password to access the AAU Data Brain are as below.\n\n\nUsername:".$uname."\nPassword:".$password."\n\nLink: http://testing.aau.org/admin/ \n\n Regards,\r\nRSIF-PASET admin panel ");
            mail($email,"RSIF-PASET admin panel access", $body, $GLOBALS['headers']);
            // To send HTML mail, the Content-type header must be set
            
            } else {
               $response["status"] = 0;
          
            $response["status_msg"] = "Unable to Save User".mysqli_error($con);
            }
          }else{
              // user is already existed - error response
            $response["status"] = 0;
          
            $response["status_msg"] = "User already existed";
             }
             return $response;
    }


    
    /**
     * Verifies user by email and password
     */
     function getUserByEmailAndPassword($email, $password) {

       $con=$GLOBALS['con'];
        $result = isUserExisted($email);
        $check = validEmail($email);
        
          if ($result==true ) {
            $result = mysqli_query($con,"SELECT * FROM users WHERE email = '".$email."'") or die(mysqli_error($con));
            $result = mysqli_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['enc_pass'];
            $hash = checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
               $updateUser=mysqli_query($con,"UPDATE `users` SET `last_login`=NOW() WHERE `email`= '".$email."'");
                $_SESSION['uid']=$result["uid"];
                $_SESSION['uname']=$result['uname'];
                $_SESSION['priv']=$result['priviledge_level'];

                $response['status']=1;
                $response["uid"]=$_SESSION['uid'];
                $response["uname"]=$_SESSION['uname'];
                $response["priv"]=$_SESSION['priv'];
  
        
            }else{
              
              $response['status']=0;
             
              $response['status_msg']="Password incorrect Please Try again";
              
            }
          } else {
              // user not found
          
            $response['status']=0;
            
            $response['status_msg']="Incorrect Email Please try again";
        
          }
      
        
        return $response;
    }
  



////////////////////end of main functions////////////////



function con_date($date){
  $tempDate = $date;
$day=date('l', strtotime( $tempDate));
$daym=date('d', strtotime( $tempDate));
$year=date('Y', strtotime( $tempDate));
$month=date('M', strtotime( $tempDate));
$time=date('h:i A', strtotime( $tempDate));
$dates=$day.", ".$month." ".$daym.", ".$year;

return $dates;
}

function con_date_main($date){
  $tempDate = $date;
$day=date('l', strtotime( $tempDate));
$daym=date('d', strtotime( $tempDate));
$year=date('Y', strtotime( $tempDate));
$month=date('M', strtotime( $tempDate));
$time=date('h:i A', strtotime( $tempDate));
$dates=$month." ".$daym.", ".$year;

return $dates;
}

function con_date_time($date){
  $tempDate = $date;
$day=date('l', strtotime( $tempDate));
$daym=date('d', strtotime( $tempDate));
$year=date('Y', strtotime( $tempDate));
$month=date('M', strtotime( $tempDate));
$time=date('h:i A', strtotime( $tempDate));
$dates=$month." ".$daym.", ".$year." ".$time;

return $dates;
}



 /**
     * Checks whether the email is valid or fake
     */
 function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

 /**
     * Check user is existed or not
     */
     function isUserExisted($email) {
       $con=$GLOBALS['con'];
        $result = mysqli_query($con,"SELECT email from users WHERE email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }


   

    /**
     * Encrypting password
     * returns salt and encrypted password
     */
     function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * returns hash string
     */
     function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }
  
  

function filterData($data) {
   $con=$GLOBALS['con'];
  if (is_array($data)) {
    foreach ($data as $elem) {
      filterData($elem);
    }
  } else {
    $data = trim(htmlentities(strip_tags($data)));
    if (get_magic_quotes_gpc())
      $data = stripslashes($data);
 
    $data = mysqli_real_escape_string($con,$data);
  }
 
    return $data;
}

?>
