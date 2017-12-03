<?php

if (isset($_POST['name'])) {
    
$uid=rand_fac();

$gd=NULL;
$uname=filterData($_POST['name']);
$priv=filterData($_POST['priv']);
$adds="box 5";
$dob="32323";
$password=filterData($_POST['password']);
$phone="0244039393939848";
$email=filterData($_POST['email']);

$user = storeUser($uid,$uname,$email,$dob,$gd,$adds,$phone,$priv,$password);
print_r($user);


}

?>  

<div class="main-Body">
<h1>User Management</h1>
<hr>
    

                <!--=== Page Content ===-->
                <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-primary" data-collapsed="0">
                
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Add User
                                </div>
                                
                                <div class="panel-options">
                                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                </div>
                            </div>
                            
                            <div class="panel-body">
                                <form class="form-horizontal form-groups-bordered"  action="#" method="post" >

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Username</label>
                                        <div class="col-md-10"><input type="text" id="name" name="name" class="form-control required"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-10"><input type="text" id="email" name="email" class="form-control required"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Privilege</label>
                                        <div class="col-md-10"><select id="priv" name="priv" class="form-control required">
                                            <?php
                                            $pgid=$_GET['pgid'];
                                            $reps=get_all_priv();// get all priviledges
                                                

                                            $size=count($reps)-1;
                                            for ($i=0; $i < $size ; $i++) {
                                            $privid=$reps[$i]['priv_ID'];
                                            $hash=$reps[$i]['hash'];
                                            
                                            $get='<option value="'.$hash.'" >'.$reps[$i]['name'].'</option>';
                                            
                                        
                                            print_r($get);
                                        }

                                            ?>
                                        </select></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Password</label>
                                        <div class="col-md-10"><input type="password" id="password" name="password" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Confirm Password</label>
                                        <div class="col-md-10"><input type="password" id="conpass" name="conpass" class="form-control required"></div>
                                    </div>
                                    
                                    <input type="submit" onclick="sub()" class="btn btn-success btn-block" value="submit">
                                
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
                                    View All Users
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
                                            <th>User ID</th>
                                            <th class="align-center">User Name </th>
                                            <th class="align-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        $reps=get_all_users();
                                        if ($reps['status']!=0) {
                                            $size=count($reps)-1;
                                            for ($i=0; $i < $size ; $i++) {
                                                
                                            
                                                print_r( "<tr><td class='align-center'>".$reps[$i]['uid']."</td><td class='align-center'>".$reps[$i]['uname']."</td> <td class='align-center'><a class='userid' href='?page=edit_user&&uid=".$reps[$i]['uid']."'>View</a>  </td></tr>");
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
                

                