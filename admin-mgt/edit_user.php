<?php


$uid=$_GET['uid'];

if (isset($_GET['uid'])) {
	$uid=filterData($_GET['uid']);
	$getuse=get_one_user($uid);
	$getuser=$getuse[0];
}else{
	echo "<script>location.href='?page=add_user'</script>";
}

if(isset($_POST['update'])){
	$uname=mysql_real_escape_string($_POST['name']);
	$email=mysql_real_escape_string($_POST['email']);
	$priv=mysql_real_escape_string($_POST['priv']);

	$response=update_one_user($uid,$uname,$email,$priv);


}elseif (isset($_POST['delete'])) {

	$response=delete_one_user($uid);
}elseif (isset($_POST['reset'])) {
	//to be done
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
<h1>Edit User</h1>
<br>
<br>
	

				<!--=== Page Content ===-->
	<div class="row">
		<div class="panel panel-primary" data-collapsed="0">
					
								<div class="panel-heading">
									<div class="panel-title">
										Edit User
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
											<label class="col-md-2 control-label">Username</label>
											<div class="col-md-10"><input type="text" id="name" name="name" class="form-control required" <?="value=".$getuser['uname']?>></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Email</label>
											<div class="col-md-10"><input type="text" id="email" name="email" class="form-control required" <?="value=".$getuser['email']?>></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Privilege</label>
											<div class="col-md-10"><select id="priv" name="priv" class="form-control required">
												<?php
												$hq=$getuser['priv'];
												$reps=get_all_priv();// get all priviledges
													

												$size=count($reps)-1;
												for ($i=0; $i < $size ; $i++) {
												$privid=$reps[$i]['priv_ID'];
												$hash=$reps[$i]['hash'];
												if($hash==$hq){
													$get='<option value="'.$hash.'" selected>'.$reps[$i]['name'].'</option>';
												}else{
													$get='<option value="'.$hash.'" >'.$reps[$i]['name'].'</option>';
												}
												
												
												
											
												print_r($get);
											}

												?>
											</select></div>
										</div>
										<div class="form-group">

													<div class=" col-md-1"></div>
																		<div class="form-actions col-md-10">
																
																
																<input type="submit"  class="btn btn-success pull-right" name="update"value="Update User">
																<input type="submit"  class="btn btn-warning pull-right" name="delete" value="Delete User"><input type="submit"  class="btn btn-primary pull-right" name="reset"value="Reset Password">
															</div>
										</div>
								
										
									</form>
								</div>
					
		</div>
	</div>			

<div class="row">
					<!--=== Table Classes ===-->
					<div class="col-md-12">

						
						<div class="panel panel-primary" data-collapsed="0">
				
							<div class="panel-heading">
								<div class="panel-title">
									View All user Logs
								</div>
								
								<div class="panel-options">
									<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
								</div>
							</div>
							
							<div class="panel-body">
								
								<table id="" class="allv table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
									<thead>
										<tr>
											<th class="align-center">User ID</th>
											<th class="align-center">Name </th>
											<th class="align-center">Page accessed</th>
											<th class="align-center">Actions</th>
										</tr>
									</thead>
									<tbody >
										<?php
										$reps=getOneUserLog($uid);
										//print_r($reps);
										if ($reps['status']!=0) {
											$size=count($reps["data"])-1;
											for ($i=0; $i < $size ; $i++) {
												print_r( "<tr><td class='align-center'>".$reps['data'][$i]['uid']."</td><td class='align-center'>".$reps['data'][$i]['uname']."</td><td class='align-center'>".$reps['data'][$i]['pname']."</td><td class='align-center'><a class='btn btn-primary' type='button' href='?page=view_one_log&uid=".$reps['data'][$i]['uid']."'>View</a>  </td></tr>");
											}
										}
										
										 
										?>
										
									
									</tbody>
								</table>
							</div>
				
						</div>

						
					</div>

			</div>
		<!-- Footer -->
	</div>
				

				