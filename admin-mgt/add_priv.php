<?php

if (isset($_POST['name'])) {
	
	
	$name=mysql_real_escape_string(stripslashes($_POST['name']));

	

	$response=add_priv_level($name);
	
	

}

if(isset($_GET['ac'])){
	if ($_GET['ac']=='del') {
		$privid=$_GET['privid'];
		$response=del_priv($privid);
	}
}

	
?>	
<div class="main-Body">
		
		
		
		
		
			<div class="page-header">
					<div class="page-title">
						<h1>Privileges Management</h1>
						
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				
<div class="panel panel-primary" data-collapsed="0">
				
							<div class="panel-heading">
								<div class="panel-title">
									View All Privileges
								</div>
								
								<div class="panel-options">
									<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
								</div>
							</div>
							
							<div class="panel-body">
								<form role="form" class="form-horizontal form-groups-bordered" action="#" method="POST">
									<div class="form-group">
										<label class="col-md-2 control-label">Privilege Name</label>
										<div class="col-md-10"><input type="text" id="name" name="name" class="form-control required"></div>
									</div>
									
									
									
									
									<input type="submit" onclick="sub()" class="btn btn-success btn-block" value="submit">
								</form>
								
							</div>
				
						</div>
				<div class="row">
					<!--=== Table Classes ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Add Privilege</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								
							</div>
						</div>
					</div>

				</div>
	<div class="row">
					<!--=== Table Classes ===-->
					<div class="col-md-12">

						
						<div class="panel panel-primary" data-collapsed="0">
				
							<div class="panel-heading">
								<div class="panel-title">
									View All Privileges
								</div>
								
								<div class="panel-options">
									<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
								</div>
							</div>
							
							<div class="panel-body">
								
								<table id="allv" class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
									<thead>
										<tr>
											<th class="align-center">Privilegde ID</th>
											<th class="align-center">Page Name </th>
											<th class="align-center">Actions</th>
										</tr>
									</thead>
									<tbody >
										<?php
										$reps=get_all_priv();
										
										
										
										if ($reps['status']>0) {
											$size=count($reps) -1;
											for ($i=0; $i < $size ; $i++) {
											
										
											print_r( "<tr><td class='align-center'>".$reps[$i]['priv_ID']."</td><td class='align-center'>".$reps[$i]['name']."</td> <td class='align-center'><a href='?page=add_priv&&ac=del&&privid=".$reps[$i]['priv_ID']."'>Delete</a> / <a href='?page=edit_privi&&privid=".$reps[$i]['priv_ID']."'>View</a> </td></tr>");
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
				

				