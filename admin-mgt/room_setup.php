<?php
if (isset($_POST['save'])) {

    $roomName=filterData($_POST['name']);
    $roomType=filterData($_POST['rtype']);
    $roomStatus=filterData($_POST['rstatus']);


    $response=add_room($roomName,$roomType,$roomStatus);
    # code...
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
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- END Page Header -->
                      
                        
<div class="row">
    <div class="col-sm-12">
        <!--  Block -->
                        <div class="panel panel-primary">
                            <!--  Title -->
                            <div class="panel-heading">
                              
                                <div class='panel-title'>Room Setup</div>
                            </div>
                            <!--  Title -->

                            <!-- Example Content -->
                            <div class="panel-body">

                                <form class="form-horizontal form-groups-bordered validate"  action="#" method="post" >

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Room ID</label>
                                        <div class="col-md-10"><input type="text" id="rid" name="rid" class="form-control required" disabled></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Room Name</label>
                                        <div class="col-md-10"><input type="text" id="name" name="name" class="form-control" data-validate="required"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Room Type</label>
                                        <div class="col-md-10">
                                            <select id="rtype" name="rtype" class="form-control " data-validate="required"> 
                                                <option value="">Select room</option>
                                                <?php

                                        $getRooms=get_all_room_type();
                                        $data=$getRooms['data'];
                                        foreach ($data as $row) {
                                           $tr="";

                                            $tr='<option value="'.$row['type_id'].'">'.$row['type_name'].'</option>';
                                            
                                            

                                            echo $tr;
                                        }


                                        ?>

                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Room Status</label>
                                        <div class="col-md-10">
                                            <select id="rstatus" name="rstatus" class="form-control " data-validate="required"> 
                                                <option value="">Select Status</option>
                                                <option>Vacant</option>
                                                <option>Occupied</option>
                                                <option>Has A Problem</option>
                                                <option>Cleaning</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="Save Room" name='save'class="btn btn-primary pull-right" >
                                        <input type="reset" value="Reset form" class="btn btn-danger pull-left" >
                                    </div>
    
                                </form>
                                
                            </div>
                            <!-- END Example Content -->
                        </div>
                        <!-- END  Block -->
    </div>


</div>

                        
                        <!--  Block -->
                        <div class="block">
                            <!--  Title -->
                            <div class="block-title">
                                
                                <h2>View All Rooms</h2>
                            </div>
                            <!--  Title -->

                            <!-- Example Content -->
                            <table class="table table-bordered table-responsive">
                            
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Room Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                        $getRooms=get_all_rooms();
                                        $data=$getRooms['data'];
                                        //print_r($data);
                                        foreach ($data as $row) {

                                            switch ($row['status']) {
                                                case 'Vacant':
                                                    $status='<span class="label label-info">Vacant</span>';
                                                    break;
                                                case 'Occupied':
                                                    $status='<span class="label label-success">Occupied</span>';
                                                    break;
                                                case 'Cleaning':
                                                    $status='<span class="label label-warning">Cleaning</span>';
                                                    break;
                                                
                                                default:
                                                    $status='<span class="label label-warning">Danger</span>';
                                                    break;
                                            }
                                            $tr='';
                                            $tr="<tr>";
                                            $tr.="<td class='text-center'>".$row['room_ID']."</td>";
                                            $tr.="<td class='text-center'>".$row['room_name']."</td>";
                                            $tr.="<td class='text-center'>".$status."</td>";
                                            $tr.="<td class='text-center'><a href='index.php?page=edit_room&&rm_id='".$row['room_ID'].">View</a></td>";
                                            $tr.="</tr>";

                                            echo $tr;
                                        }


                                        ?>



                                


                            </tbody>
                            
                        </table>
                            <!-- END Example Content -->
                        </div>
                        <!-- END  Block -->
                        
                    </div>
                    <!-- END Page Content -->