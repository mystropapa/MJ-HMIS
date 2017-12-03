<?php

if (isset($_POST['name'])) {
	$pdesc=filterData($_POST['desc']);
	$purl=filterData($_POST['url']);
	$pname=filterData($_POST['name']);
print_r($_POST);
echo "string";
	
if (!empty($pdesc)||!empty($purl)||!empty($pname)) {
	$response=add_page($pname,$pdesc,$purl);
}else{

$response['status']=0;
$response['status_msg']="One or more fields are empty";

}
	

	
	
}


//print_r(upload_all_pages());


	
?>	
<div class="main-Body">
		
		<h1>Page Managment</h1>
		<br>
		
		
		
		<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="panel panel-primary" data-collapsed="0">
				
							<div class="panel-heading">
								<div class="panel-title">
									Add Page
								</div>
								
								<div class="panel-options">
									<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
								</div>
							</div>
							
							<div class="panel-body">
								
								<form role="form" class="form-horizontal form-groups-bordered validate" action="#" method="POST">
									<div class="form-group">
												<label class="col-md-2 control-label">Page Name</label>
												<div class="col-md-10"><input type="text" id="name" name="name" data-validate="required"class="form-control required"></div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Description</label>
												<div class="col-md-10"><input type="text" id="desc" name="desc"data-validate="required" class="form-control required"></div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Url</label>
												<div class="col-md-10"><input type="text" id="url" name="url" data-validate="required"class="form-control required"></div>
											</div>
											
											
											
											<input type="submit" onclick="sub()" class="btn btn-success btn-block" value="submit">
								</form>
								
							</div>
				
						</div>
					</div>
					<!-- /Example Box -->
				</div> <!-- /.row -->

	<div class="row">
					<!--=== Table Classes ===-->
					<div class="col-md-12">

						
						<div class="panel panel-primary" data-collapsed="0">
				
							<div class="panel-heading">
								<div class="panel-title">
									All Pages
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
											
											<th class="align-center">Page Name </th>
											<th class="align-center">Description</th>
											<th class="align-center">Url</th>
											
											<th class="align-center">Actions</th>
										</tr>
									</thead>
									<tbody >
										<?php
										$reps=get_all_pages();
										$size=count($reps);
										

										
										for ($i=0; $i < $size ; $i++) {
											
										
											print_r( "<tr><td class='align-center'>".$reps[$i]['pname']."</td><td class='align-center'>".$reps[$i]['desc']."</td><td class='align-center'> ".$reps[$i]['purl']."</td> <td class='align-center'><a href='?page=edit_page&&pgid=".$reps[$i]['pID']."'>Edit</a> / <a href='?page=".$reps[$i]['purl']."'>View</a></td></tr>");
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
				

				