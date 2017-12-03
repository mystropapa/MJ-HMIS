<?php
if (isset($_POST['save'])) {
    $roomTypeName=filterData($_POST['tname']);
    $roomTypeDesc=filterData($_POST['desc']);
    $roomTypeRate=filterData($_POST['rate']);

    if (!empty($roomTypeRate)||!empty($roomTypeDesc)||!empty($roomTypeName)) {
        $response=add_room_type($roomTypeName,$roomTypeDesc,$roomTypeRate);
    }else{
        $response['status']=0;
        $response['status_msg']="One or more fields are empty. Please check and verify.";
    }
}

?>
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Page Header -->
                        <div class="content-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="header-section">
                                        <h1><?=$_pageName?></h1>
                                        <hr>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- END Page Header -->
                      
 <div class="main-Body"> 

    <!--=== Page Content ===-->
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Room Type Management
                    </div>

                    
                </div>

                <div class="panel-body">
                    <form class="form-horizontal form-groups-bordered"  action="#" method="post" >

                        <div class="form-group">
                            <label class="col-md-2 control-label">Room Type Name</label>
                            <div class="col-md-10"><input type="text" id="tname" name="tname" class="form-control required"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Type Description</label>
                            <div class="col-md-10"><input type="text" id="desc" name="desc" class="form-control required"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Type Rate</label>
                            <div class="col-md-10"><input type="text" id="rate" name="rate" class="form-control required"></div>
                        </div>


                        
                        <div class="form-actions">
                            <input type="submit" value="Save Room" name='save'class="btn btn-primary pull-right" >
                            <input type="reset" value="Reset form" class="btn btn-danger pull-left" >
                        </div>
                    </form>
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
                                    View All Room Types
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
                                            <th class="text-center">Type ID </th>
                                            <th class="text-center">Type Name </th>
                                            <th class="text-center">Rate </th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php

                                        $getRooms=get_all_room_type();
                                        $data=$getRooms['data'];
                                        foreach ($data as $row) {
                                            $tr='';
                                            $tr="<tr>";
                                            $tr.="<td class='text-center'>".$row['type_id']."</td>";
                                            $tr.="<td class='text-center'>".$row['type_name']."</td>";
                                            $tr.="<td class='text-center'>".$row['rate']."</td>";
                                            $tr.="<td class='text-center'><a href='index.php?page=edit_room_type&&ty_id='".$row['type_id'].">View</a></td>";
                                            $tr.="</tr>";

                                            echo $tr;
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
