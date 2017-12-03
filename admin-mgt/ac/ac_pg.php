<?php
require 'core/config.db.php';


if (isset($_GET['qpr'])) {
	$get_action_id=$_GET['qpr'];
	//check if file type and size are within required range
	$allowedext=array('PDF','DOC','DOCX','TXT','PNG','JPG','JPEG','pdf','doc','docx','txt','png','jpg','jpeg');
	$folder="../../mfiles/";
	
	
	if (isset($_SESSION['uid'])) { 
		$appID=$_SESSION['uid'];
	}
	$response=array();

	if($get_action_id=="regs"){

		$fname=filterData($_POST['fname']);
		$mname=filterData($_POST['mname']);
		$lname=filterData($_POST['lname']);
		$email=filterData($_POST['email']);
		$password=filterData($_POST['pass']);
		$response=storeOMU_acc($fname,$mname,$lname,$email,$password);
		
	}elseif($get_action_id=="") {
		$email=filterData($_POST['email']);
		$password=filterData($_POST['pass']);
		// $email=filterData('papa@gmail.com');
		// $password=filterData('aaaaa');
		$response=getAppByEmailAndPassword($email, $password);
		

	}elseif($get_action_id=="refUpload") {
		$refID=filterData($_POST['refID']);
		$file=$_FILES['reference'];
		// $email=filterData('papa@gmail.com');
		// $password=filterData('aaaaa');
		$getRef=getOneReferee($refID);
		if ($getRef['status']==1) {
			//check password
					
					$appNID=$getRef['data']['User_ID'];
					$appNID=str_replace("/", "_", $appNID);
					$lcname=$file['name'];// get the file name
					if ($lcname=="") {
						$response['status']=0;
	           			$response['status_msg']="Please make sure you add files before you save the form";
	           						goto end;
					}
					$lcsize=$file['size'];
					$lctmp=$file['tmp_name'];
					$lcpathif=pathinfo($lcname);
					$lcext=$lcpathif['extension'];
					$lcname=rand(1,1000).$appNID."-ref-".$refID.".".$lcext;

					if (in_array($lcext,$allowedext)) {
						if($lcsize <= 7000000){
							if($lctmp!=""){
								$lc=$folder.$lcname;
								if (file_exists($lc)) {
									$lcname=rand(1,10000).$lcname;
								} 
									$lc=$folder.$lcname;
								if(move_uploaded_file($lctmp, $lc)==true){
									
									
									$response=updateReference($refID,$lcname);
									goto end;
								}else{
									$response['status']=0;
	           						$response['status_msg']="An error occurred while uploading. Error code: File no  Couldn't upload reference. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.Error Code : Unable to move file to destination";
	           						goto end;
								}
								
							}else{
								$response['status']=0;
           						$response['status_msg']="An error occurred while uploading. Error code: File no  Couldn't upload . <br> Temp Not found. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
           						goto end;
							}
						}else{
							$response['status']=0;
           					$response['status_msg']="An error occurred while uploading. Error code: File is bigger than the allowed size (5MB). Please compress it and re upload.";
           						goto end;
						}
					}else{
						$response['status']=0;
           				$response['status_msg']="An error occurred while uploading. Error code: File type is not allowed/ Please make sure your file is allowed ('pdf','doc','docx','txt','png','jpg','jpeg'). Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a> if the problem persists. ";
           						goto end;
					}

			

		}else{
			$response=$getRef;
		}
		

	}elseif($get_action_id=="save") {
		

		if ($_GET['secs']=="PD") {
			
			$fname=filterData($_SESSION['fname']);
			$lname=filterData($_SESSION['lname']);
			$mname=filterData($_SESSION['mname']);
			$MadName=filterData($_POST['MadName']);
			$dob=filterData($_POST['dob']);
			$countryRes=filterData($_POST['countryRes']);
			$gender=filterData($_POST['gender']);
			$email1=$_SESSION['email'];
			$email2=filterData($_POST['email2']);
			$mobile=filterData($_POST['mobile']);
			$otherMobile=filterData($_POST['otherMobile']);
			$ResidentialAddress=filterData($_POST['ResidentialAddress']);
			$postAddress=filterData($_POST['postAddress']);
			$nationality=filterData($_POST['nationality']);
			$language=filterData($_POST['language']);

			
			$response=addPersonalData($appID,$fname,$mname,$lname,$MadName,$dob,$countryRes,$gender,$email1,$email2,$mobile,$otherMobile,$ResidentialAddress,$postAddress,$nationality,$language);
			goto end;
		}elseif($_GET['secs']=="EQ") {
			$file1=$_FILES['BachelordegreeCert'];//BachelordegreeCert
			$file2=$_FILES['MastersdegreeCert'];//MastersdegreeCert
			$file3=$_FILES['BachelordegreeTrans'];//BachelordegreeTrans
			$file4=$_FILES['MastersdegreeTrans'];//MastersdegreeTrans
			$Ref1Name=filterData($_POST['Ref1Name']);
			$Ref1Email=filterData($_POST['Ref1Email']);
			$Ref2Name=filterData($_POST['Ref2Name']);
			$Ref2Email=filterData($_POST['Ref2Email']);
			if (isset($_POST['Ref1ID'])) {
				if ($_POST['Ref1ID']!=null) {$Ref1=filterData($_POST['Ref1ID']);}else{$Ref1=null;}
				if (isset($_POST['Ref2ID'])) {$Ref2=filterData($_POST['Ref2ID']);}else{$Ref2=null;}
				
				
			}else{

				$Ref1=null;
				$Ref2=null;
			}

			//check if referee emails are the same
			if ($Ref2Email==$Ref1Email) {
				$response['status']=0;
           		$response['status_msg']="Sorry, referee emails can not be the same. Please check and retype.";
           		goto end;
			}elseif ($Ref2Email==$_SESSION['email']) {
				$response['status']=0;
           		$response['status_msg']="Sorry, Second referee's emails can not be the same as applicant email. Please check and retype.";
           		goto end;
			}elseif ($Ref2Email==$_SESSION['email']) {
				$response['status']=0;
           		$response['status_msg']="Sorry, First referee's emails can not be the same as applicant email. Please check and retype.";
           		goto end;
			}

			//check if all files have been uploaded
			if (!empty(array_filter($file1)) || !empty(array_filter($file2)) || !empty(array_filter($file3)) || !empty(array_filter($file4)) ) {  
				
				$insFile = array();

				//loop through all files present
				for ($i=1; $i < 5 ; $i++) { 
					$appNID=str_replace("/", "_", $appID);
					$file=${"file".$i};
					$lcname=$file['name'];// get the file name
					if ($lcname=="") {
						$response['status']=0;
	           			$response['status_msg']="Please make sure you add files before you save the form";
	           						goto end;
					}
					$lcsize=$file['size'];
					$lctmp=$file['tmp_name'];
					$lcpathif=pathinfo($lcname);
					$lcext=$lcpathif['extension'];
					$lcname=rand(1,1000).$appNID.".".$lcext;

					if (in_array($lcext,$allowedext)) {
						if($lcsize <= 7000000){
							if($lctmp!=""){
								$lc=$folder.$lcname;
								if (file_exists($folder.$lc)) {
									$lc=$folder.rand(1,1000).$lcname;
								} 

								if(move_uploaded_file($lctmp, $lc)==true){
									
									$insFile[$i]=$lcname;
								}else{
									$response['status']=0;
	           						$response['status_msg']="An error occurred while uploading. Error code: File no  ".$i ."Couldn't upload (Final). Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
	           						goto end;
								}
								
							}else{
								$response['status']=0;
           						$response['status_msg']="An error occurred while uploading. Error code: File no  ".$i ."Couldn't upload. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
           						goto end;
							}
						}else{
							$response['status']=0;
           					$response['status_msg']="An error occurred while uploading. Error code: File no  ".$i ."is bigger than the allowed size (5MB). Please compress it and re upload.";
           						goto end;
						}
					}else{
						$response['status']=0;
           				$response['status_msg']="An error occurred while uploading. Error code: File no  ".$i ."'s  file type is not allowed/ Please make sure your file is allowed ('pdf','doc','docx','txt','png','jpg','jpeg'). Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a> if the problem persists. ";
           						goto end;
					}
				}

				$query=mysqli_query($con,"SELECT * from `paset_education_qualifications` WHERE User_ID= '".$appID."' ");
				$fetch=mysqli_fetch_assoc($query);  
				$checkForExisitingFiles=mysqli_num_rows($query);
				
				$removeFile=unlink($folder.$fetch['Bachelors_degree_Cert']);
				$removeFile=unlink($folder.$fetch['Masters_degree_Cert']);
				$removeFile=unlink($folder.$fetch['Bachelor_degree_Trans']);
				$removeFile=unlink($folder.$fetch['Masters_degree_Trans']);
				
			     
				if ($checkForExisitingFiles==0) {
					//print_r($insFile);
					$query=mysqli_query($con,"INSERT INTO `paset_education_qualifications`(`User_ID`, `Bachelors_degree_Cert`, `Masters_degree_Cert`, `Bachelor_degree_Trans`, `Masters_degree_Trans`) VALUES ('".$appID."','".$insFile[1]."','".$insFile[2]."','".$insFile[3]."','".$insFile[4]."')") or die(mysqli_error($con));
					$response['debug']="insert";

					
				}else{
					$query=mysqli_query($con,"UPDATE `paset_education_qualifications` SET`Bachelors_degree_Cert`='".$insFile[1]."',`Masters_degree_Cert`='".$insFile[2]."',`Bachelor_degree_Trans`='".$insFile[3]."',`Masters_degree_Trans`='".$insFile[4]."' WHERE `User_ID`='".$appID."' ") or die(mysqli_error($con));
					$response['debug']="update";
				}


				if ($query) {
						//check if all files have been uploaded
						if (!empty($Ref1Name) ||!empty($Ref1Email)||!empty($Ref2Name)||!empty($Ref2Email)) {
							// put all values in an array
							$Referees=array(
									array("name"=>$Ref1Name,"email"=>$Ref1Email,"id"=>$Ref1),
									array("name"=>$Ref2Name,"email"=>$Ref2Email,"id"=>$Ref2) );



							for ($i=0; $i < 2; $i++) { 
								
								$response=addReferee($appID,$Referees[$i]['name'],$Referees[$i]['email'],$Referees[$i]['id']);
								
							}
							goto end;
						}else{
							$response['status']=0;
		           			$response['status_msg']="One or more of the required fields for the Referees has not been completed . Please Try again ";
						}
					}else{
						$response['status']=0;
		           		$response['status_msg']="Unable to insert files into DB Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a> ".mysqli_error($con);
					}
				
			}else{
					$response['status']=0;
           			$response['status_msg']="One or more of the required files in this section was not added. Please Try again ";
			}

		

			# code...
		}elseif($_GET['secs']=="IUA") {
			$UniversityName=filterData($_POST['UniversityName']);
			$DateOfJoining=filterData($_POST['DateOfJoining']);
			$DepartmentName=filterData($_POST['DepartmentName']);
			$FacultyMember=filterData($_POST['FacultyMember']);
			$RoleInUniversity=filterData($_POST['RoleInUniversity']);
			$NameOfHOD=filterData($_POST['NameOfHOD']);
			$EmailOfHOD=filterData($_POST['EmailOfHOD']);
			$FieldOfStudy=filterData($_POST['FieldOfStudy']);

			$response=addCurrentAssocUniversity($appID,$UniversityName,$DateOfJoining,$DepartmentName,$FacultyMember,$FieldOfStudy,$RoleInUniversity,$NameOfHOD,$EmailOfHOD);
			
			goto end;
		}elseif($_GET['secs']=="PH") {
			$UniversityName=filterData($_POST['UniversityName']);
			$DateOfJoining=filterData($_POST['DateOfJoining']);
			$DepartmentName=filterData($_POST['DepartmentName']);
			$FacultyMember="NULL";
			$RoleInUniversity=filterData($_POST['RoleInUniversity']);
			$NameOfHOD=filterData($_POST['current_employer']);
			$EmailOfHOD=filterData($_POST['employer_email']);
			$FieldOfStudy=filterData($_POST['FieldOfStudy']);

			/*break from old */
			$current_employer=filterData($_POST['current_employer']);
			$employer_email=filterData($_POST['employer_email']);
			$leadership_roles=filterData($_POST['leadership_roles']);
			$community_service_record=filterData($_POST['community_service_record']);
			$ListOfPublications=filterData($_POST['ListOfPublications']);
			$nameOfOrg=filterData($_POST['nameOfOrg']);
			$perOfEmp=filterData($_POST['perOfEmp']);
			$posheld=filterData($_POST['posheld']);
			$CV=$_FILES['CV'];

			// check if employers email is the same ass applicant's
			if ($employer_email==$_SESSION['email']) {
				$response['status']=0;
           		$response['status_msg']="Sorry, Employer's email can not be the same as applicant email. Please check and retype.";
           		goto end;
			}

			$appNID=str_replace("/", "_", $appID);
					$file=$CV;
					$lcname=$file['name'];// get the file name
					if ($lcname=="") {
						$response['status']=0;
	           			$response['status_msg']="Please make sure you add files before you save the form";
	           						goto end;
					}
					$lcsize=$file['size'];
					$lctmp=$file['tmp_name'];
					$lcpathif=pathinfo($lcname);
					$lcext=$lcpathif['extension'];
					$lcname=rand(1,1000).$appNID.".".$lcext;

					if (in_array($lcext,$allowedext)) {
						if($lcsize <= 7000000){
							if($lctmp!=""){
								$lc=$folder.$lcname;
								if (file_exists($folder.$lc)) {
									$lc=$folder.rand(1,10000).$lcname;
								} 

								if(move_uploaded_file($lctmp, $lc)==true){
									
									$cvfile=$lcname;
									 $ins=addCurrentAssocUniversity($appID,$UniversityName,$DateOfJoining,$DepartmentName,$FacultyMember,$FieldOfStudy,$RoleInUniversity,$NameOfHOD,$EmailOfHOD);
									if ($ins['status']==1) {
										$response=addProfessionalHistory($appID,$current_employer,$employer_email,$leadership_roles,$community_service_record,$ListOfPublications,$cvfile,$nameOfOrg,$perOfEmp,$posheld);
									}else{
										$response['status']=0;
		           						$response['status_msg']=$ins['status_msg'];
		           						goto end;
									}
									
									goto end;
								}else{
									$response['status']=0;
	           						$response['status_msg']="An error occurred while uploading. Error code: File no  Couldn't upload CV. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
	           						goto end;
								}
								
							}else{
								$response['status']=0;
           						$response['status_msg']="An error occurred while uploading. Error code: File no  Couldn't upload . <br> Temp Not found. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
           						goto end;
							}
						}else{
							$response['status']=0;
           					$response['status_msg']="An error occurred while uploading. Error code: File is bigger than the allowed size (5MB). Please compress it and re upload.";
           						goto end;
						}
					}else{
						$response['status']=0;
           				$response['status_msg']="An error occurred while uploading. Error code: File type is not allowed/ Please make sure your file is allowed ('pdf','doc','docx','txt','png','jpg','jpeg'). Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a> if the problem persists. ";
           						goto end;
					}

			



			# code...
		}elseif($_GET['secs']=="PRF") {
			$thematicArea=filterData($_POST['thematicArea']);
			$UniName=filterData($_POST['UniName']);
			$researchTopic=filterData($_POST['researchTopic']);
			$proposalUpload=$_FILES['proposalUpload'];

			$appNID=str_replace("/", "_", $appID);
					$file=$proposalUpload;
					$lcname=$file['name'];// get the file name
					if ($lcname=="") {
						$response['status']=0;
	           			$response['status_msg']="Please make sure you add files before you save the form";
	           			goto end;
					}
					$lcsize=$file['size'];
					$lctmp=$file['tmp_name'];
					$lcpathif=pathinfo($lcname);
					$lcext=$lcpathif['extension'];
					$lcname=rand(1,1000).$appNID.".".$lcext;

					if (in_array($lcext,$allowedext)) {
						if($lcsize <= 7000000){
							if($lctmp!=""){
								$lc=$folder.$lcname;
								if (file_exists($folder.$lc)) {
									$lc=$folder.rand(1,10000).$lcname;
								} 

								if(move_uploaded_file($lctmp, $lc)==true){
									
									$proposalUpload=$lcname;
									$response=addResearchFocus($appID,$UniName,$thematicArea,$researchTopic,$proposalUpload);
									goto end;
								}else{
									$response['status']=0;
	           						$response['status_msg']="An error occurred while uploading. Error code: Couldn't upload File. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
	           						goto end;
								}
								
							}else{
								$response['status']=0;
           						$response['status_msg']="An error occurred while uploading. Error code: File Couldn't upload . <br> Temp Not found. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>.";
           						goto end;
							}
						}else{
							$response['status']=0;
           					$response['status_msg']="An error occurred while uploading. Error code: File size is bigger than the allowed size (5MB). Please compress it and re upload.";
           						goto end;
						}
					}else{
						$response['status']=0;
           				$response['status_msg']="An error occurred while uploading. Error code: This file type is not allowed/ Please make sure your file is allowed ('pdf','doc','docx','txt','png','jpg','jpeg'). Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a> if the problem persists. ";
           						goto end;
					}	
		}elseif($_GET['secs']=="DEC") {
			$declaration=filterData($_GET['y2k']);
			$response=SignDeclaration($appID,$declaration);
			goto end;
			
		}

	/*	//render response
		if(isset($query)){
					 $response['status']=1;
              
           			 $response['status_msg']="Saved successfully. ".mysqli_error($con);
                
				}else{
					 $response['status']=0;
              
           			 $response['status_msg']="Sorry, Form unable to save. Please contact <a href='mailto:pymireku@aau.org'>Technical Support</a>. ".mysqli_error($con);
                
				}*/
	}
}else{
		$response="Page Unknown";
	}
end:
echo json_encode($response); 
?>