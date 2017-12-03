
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
                                        
                                        

                                    </tbody>
                                </table>
                                
                            </div>

                        </div>

                        
                    </div>

        </div>

                <!-- Footer -->
</div>
