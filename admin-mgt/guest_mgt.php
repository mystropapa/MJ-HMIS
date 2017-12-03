<?php
if (isset($_POST['save'])) {

    $Name=filterData($_POST['name']);
    $gender=filterData($_POST['gender']);
    $email=filterData($_POST['email']);
    $phone=filterData($_POST['phone']);
    $address=filterData($_POST['address']);
    $ifNOTGhananian=filterData($_POST['isGhana']);
    $guestType=filterData($_POST['guestType']);


    if (!empty($Name)||!empty($gender)||!empty($phone)||!empty($address)||!empty($ifNOTGhananian)||!empty($guestType)) {
        print_r($_FILES);
      if (isset($_FILES['scannedpassport'])) {
        $passport=$_FILES['scannedpassport'];
        $pathinfo=pathinfo($passport['name']);
        print_r($pathinfo);

        if (in_array($pathinfo['extension'],$main_vars['allowedFileExt'])) {
            if ($passport['size']<= 500000) {
                $openFile=fopen($passport['tmp_name'],'rb');

                if ($openFile) {
                    $readFile=fread($openFile, $passport['size']);
                    fclose($openFile);

                    $readFile=addslashes($readFile);

                    print_r($_FILES);
                    $response=add_Guest($Name,$gender,$email,$phone,$address,$ifNOTGhananian,$readFile,$guestType);

                }else{
                    $response['status']=0;
                    $response['status_msg']="Error occurred while uploading file. Error code:Unable to open file for reading";
                }

            }else{
                $response['status']=0;
                $response['status_msg']="Error occurred while uploading file. Error code: File size must not exceed 4MB";
            }
        }else{
            $response['status']=0;
            $response['status_msg']="Error occurred while uploading file. Error code: File must have one of the following extensions (".implode(",", $main_vars['allowedFileExt']).")";
        }
        
        
    }else{
        $scannedpassport=NULL;
        $response=add_Guest($Name,$gender,$email,$phone,$address,$ifNOTGhananian,$scannedpassport,$guestType); 
    }
    
}else{
    $response['status']=0;
    $response['status_msg']="Sorry one or more fields are incomplete";
}



    # code...
}
?>

<script type="text/javascript">
$(document).ready(function () {
    $(".passport").hide();
    $("input[name='isGhana']").change(function  () {
 
        var value=$(this).val();

        if (value=='No') {
            $('.passport').fadeIn();
        }else{

            $('.passport').fadeOut();
        }
    });
});

<?php
    echo "var jsArray = new Array();";
    foreach ($_POST as $key=>$value){
        echo "jsArray['$key'] = '$value';";  //turn it into a javascript array
    }
?>


        // Grab all elements that have tagname input
        var inputArr = document.getElementsByTagName("input");

        // Loop through those elements and fill in data
        for (var i = 0; i < inputArr.length; i++){
            inputArr[i].value = jsArray[inputArr[i].name];

        }
</script>



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
                              
                                <div class='panel-title'>Add Guest</div>
                            </div>
                            <!--  Title -->

                            <!-- Example Content -->
                            <div class="panel-body">

                                <form class="form-horizontal form-groups-bordered validate"  action="#" method="post" enctype="multipart/form-data" >

                                   

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Name</label>
                                        <div class="col-md-10"><input type="text" id="name" name="name" class="form-control" data-validate="required"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Gender</label>
                                        <div class="col-md-10">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender"  value="Male" checked="">Male
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender" value="Female">Female
                                                </label>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-10"><input type="email" name="email" class="form-control" data-validate="required"></div>
                                    </div>
                                    <!-- add natiotnality as upgrade -->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Mobile Number</label>
                                        <div class="col-md-10"><input type="text" name="phone" class="form-control" data-validate="required"></div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Address</label>
                                        <div class="col-md-10"><input type="text" name="address" class="form-control" data-validate="required"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Is Guest a Ghanaian?</label>
                                        <div class="col-md-10">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="isGhana"  value="Yes">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="isGhana" value="No">No
                                                </label>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="passport form-group">
                                        <label class="col-md-2 control-label">Upload Passport</label>
                                        <div class="col-md-10"><input type="file"  name="scannedpassport" class="form-control" data-validate="required"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Guest Type</label>
                                        <div class="col-md-5"> <select id="guestType" name="guestType" class="form-control " data-validate="required"> 
                                                <option value="">Select type</option>
                                                <option>Individual</option>
                                                <option>Company</option>
                                                
                                            </select></div>
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

                    <div class="row">
                        <!--  Block -->
                        <div class="col-md-12">

                            <div class="panel panel-primary" data-collapsed="0">

                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Room Type Management
                                    </div>

                                    
                                </div>
                            <!--  Title -->

                            <!-- Example Content -->
                            <table class="table table-bordered table-responsive">
                            
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                        $getRooms=get_all_guests();
                                        $data=$getRooms['data'];
                                        // print_r($data);
                                        foreach ($data as $row) {

                                           
                                            $tr='';
                                            $tr="<tr>";
                                            $tr.="<td class='text-center'>".$row['gid']."</td>";
                                            $tr.="<td class='text-center'>".$row['Name']."</td>";
                                            $tr.="<td class='text-center'>".$row['gender']."</td>";
                                            $tr.="<td class='text-center'>".$row['email']."</td>";
                                            $tr.="<td class='text-center'><a href='index.php?page=edit_guest&&gu_id='".$row['gid'].">View</a></td>";
                                            $tr.="</tr>";
                                            //echo "<img src='data:image/jpeg;base64,".base64_encode($row['scanned_passport'])."'/>";
                                            echo $tr;
                                        }


                                        ?>



                                


                                </tbody>
                                
                            </table>
                                <!-- END Example Content -->
                            </div>
                        </div>
                        <!-- END  Block -->
                        
                    </div>
                    <!-- END Page Content -->

                    </div>
                        