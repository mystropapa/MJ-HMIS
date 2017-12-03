<?php


$pgid=$_GET['privid'];
//Check Page
if (isset($_GET['privid'])) {
	
	$pagedet=get_one_privi($pgid);
	if($pagedet['count']!=1) {
		print_r("<script>location.href='?page=add_priv';</script>");
	}

}else{
	print_r("<script>location.href='?page=add_page';</script>");
}

//Update Privilege of Page
if (isset($_POST['pages'])) {
	
	$page=$_POST['pages'];
	$pgid=$_GET['privid'];
	$size=count($page);
	for ($i=0; $i < $size ; $i++) {
											
	 $response=add_priv($page[$i],$pgid);
		//echo  $page[$i]."  ".$pgid;
	}
}


//reset Privledge list in form
if (isset($_POST['reset'])) {
	
	$response=reset_priviii($pgid);
}

//delete Page

// if (isset($_POST['delete'])) {

// 	$response=delete_page($pgid);

// }

if(isset($response)){
	if($response['status']==1){
		
		
		echo '<script>
		$(document).ready(function()
		{
		$("#suc").html("'.$response['status_msg'].'"); 
		$("#suc").show(); 
		$("#err").hide();
		});
		
		</script>';

	}else{
		echo '<script>
		$(document).ready(function()
		{
		$("#err").html("'.$response['status_msg'].'"); 
		$("#err").show(); 
		$("#show").hide();
		});
		
		</script>';;
	}
}

	
?>	
<div class="main-Body">

	

				<!--=== Page Content ===-->
				
<div class="panel panel-primary" data-collapsed="0">
				
							<div class="panel-heading">
								<div class="panel-title">
									Edit Privilege
								</div>
								
								<div class="panel-options">
									<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
								</div>
							</div>
							
							<div class="panel-body">
								<form class="form-horizontal row-border"  id="validate-1" action="#" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-md-2 control-label">Privilege Name</label>
										<div class="col-md-10"><?=$pagedet['det']['name']?></div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label">Page Privileges</label>
										<div class="col-md-10">
											
											<?php
											
											$reps=get_all_pages();// get all priviledges
											$privid=$_GET['privid'];	

											$size=count($reps);
											for ($i=0; $i < $size ; $i++) {
											$pggid= $reps[$i]['pID'];

											$getselected=mysqli_num_rows(mysqli_query($con,'SELECT * from `page_priv` WHERE `pgid`="'.$pggid.'" AND `priv_id`="'.$privid.'"'));// check for page priviledges
											
											if ($getselected==1) {
												$get='<label class="checkbox"><input type="checkbox" class="uniform" name="pages[]" value="'.$pggid.'" checked>'.$reps[$i]['pname'].'</label>';
											}else{
												$get='<label class="checkbox"><input type="checkbox" class="uniform" name="pages[]" value="'.$pggid.'" >'.$reps[$i]['pname'].' </label>';
											}
										
											print_r($get);
											
										}


											?>
											<br>
											<button type="submit" name="reset" class="btn btn-primary"> Reset</button>
										</div>
									</div>
									
									
									
									<input type="submit" onclick="sub()" class="btn btn-success " value="Update Page">

									<input type="submit"  class="btn btn-danger "  name="delete" value="Delete Page">
								</form>
							</div>
				
						</div>
			

		<!-- Footer -->
	</div>
				

				