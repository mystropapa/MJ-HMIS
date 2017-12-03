<?php
$dbname="mjgrand";
$hst="localhost";
$usr="root";
$pwd="";



$main_vars = array(
	'sysName' => 'PASET SCHOLARSHIP MANAGMENT SYSTEM' , 
	'sysurl' => "" ,
	'allowedFileExt'=>  array('PDF','DOC','DOCX','TXT','PNG','JPG','JPEG','pdf','doc','docx','txt','png','jpg','jpeg')
	);


	
// To send HTML mail, the Content-type header must be set
 $GLOBALS['headers']  = 'MIME-Version: 1.0' . "\r\n";
 $GLOBALS['headers']  .= 'From: AAU SYSTEMS <no-reply@aau.org>' . "\r\n";
 $GLOBALS['headers'] .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
?>