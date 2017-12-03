<?php
if (isset($_POST['save'])) {

    $extraName=filterData($_POST['name']);
    $extraDesc=filterData($_POST['desc']);
    $rate=filterData($_POST['rate']);


    $response=add_extraService($extraName,$extraDesc,$rate);
    # code...
}
?>
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Page Header -->
                        <div class="content-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="header-section">
                                        <h1><?=$_pageName?></h1>
                                        <hr>
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
                              
                                <div class='panel-title'>Extra Hotel Service</div>
                            </div>
                            <!--  Title -->

                            <!-- Example Content -->
                            <div class="panel-body">

                                <form class="form-horizontal form-groups-bordered validate"  action="#" method="post" >

                                   

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Extra Service Name</label>
                                        <div class="col-md-10"><input type="text" id="name" name="name" class="form-control" data-validate="required"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Description</label>
                                        <div class="col-md-10"><input type="text" id="desc" name="desc" class="form-control" data-validate="required"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Rate</label>
                                        <div class="col-md-10"><input type="text" id="rate" name="rate" class="form-control" data-validate="required"></div>
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
                                
                                <h2>View All extra</h2>
                            </div>
                            <!--  Title -->

                            <!-- Example Content -->
                            <table class="table table-bordered table-responsive">
                            
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Extra Service Name</th>
                                    <th class="text-center">Rate</th>
                                    <th class="text-center">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                        $getRooms=get_all_extraServices();
                                        $data=$getRooms['data'];
                                        print_r($data);
                                        foreach ($data as $row) {

                                           
                                            $tr='';
                                            $tr="<tr>";
                                            $tr.="<td class='text-center'>".$row['id']."</td>";
                                            $tr.="<td class='text-center'>".$row['extra_name']."</td>";
                                            $tr.="<td class='text-center'>".$row['rate']."</td>";
                                            $tr.="<td class='text-center'><a href='index.php?page=edit_extra_service&&ex_id='".$row['id'].">View</a></td>";
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