<?php
require 'ac/core/config.db.php';
if (!isset($_SESSION['uid'])) {
            header('Location:logout.php');
            //print_r($_SESSION);
}



if(isset($_GET['page']))
    {

        
            $search=$_SESSION['priv'];

            $page=array();
            $getpage=mysqli_query($con,'SELECT pages.purl, page_priv.priv_id FROM pages LEFT JOIN page_priv ON pages.pID = page_priv.pgid LEFT JOIN privledges ON privledges.priv_ID = page_priv.priv_id WHERE privledges.hash =  "'.$search.'"');

            while ($row=mysqli_fetch_assoc($getpage)) {
                $pages[]=$row['purl'];
            }
            
        
    

        //$testing = array('add_priv' ,'view_all_apps' ,'view_one_app' ,'add_users' ,'edit_privi' ,'edit_user' ,'add_page' ,'index','app_setup' );
        
        if(in_array($_GET['page'],$pages))
        {
        $_page=$_GET['page'];
        $getPageName=mysqli_fetch_assoc(mysqli_query($GLOBALS['con'],"SELECT * from pages where purl='".$_page."'"));
        $_pageName=$getPageName['pname'];
        $_pageID=$getPageName['pID'];
        
        
        }else{ 
            $_page="404";
            $_pageName="404";
            $_pageID="4";
        }
    
    
    }else{ 
        $_page="index";
        $_pageName="Dashboard";
        $_pageID="7";
    }

    logUser($_SESSION['uid'],$_pageID);
    
    if ($_page=="index"){

require 'assets/incs/header.php';



?>
        <?php
        //get dashboard figures

        
        ?>


   
        <script type="text/javascript">
        jQuery(document).ready(function($)
        {
            // Sample Toastr Notification
            setTimeout(function()
            {
                var opts = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                    "toastClass": "black",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
        
                toastr.success("You have been awarded with 1 year free subscription. Enjoy it!", "Account Subcription Updated", opts);
            }, 3000);
        
        });
        </script>
    <div class="main-Body">
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <h1><?=date('F d, Y');?></h1>
                    <h3>Welcome to the  <strong>MJ Grand </strong> Hotel Management System
                    </h3>
                </div>
            </div>
        </div>
        
        
        <div class="page-main-content">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    
                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end="83" data-postfix="" data-duration="1500" data-delay="0">0</div>
                        
                        <h3>Guests<br>Checked-In</h3>
                        
                    </div>
                    
                </div>
                
                <div class="col-sm-3 col-xs-6">
                    
                    <div class="tile-stats tile-green rke">
                        
                        <div class='num'  data-start="0" data-end="135" data-postfix="" data-duration="1500" data-delay="600">0</div>
                        
                        <h3>Available Rooms <br>(Out of 10)</h3>
                        <div class="icon"><i class="fa fa-bed fa-4"></i></div>
                    </div>
                    
                </div>
                
                <div class="clear visible-xs"></div>
                
                <div class="col-sm-3 col-xs-6">
                    
                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" data-start="0" data-end="23" data-postfix="" data-duration="1500" data-delay="1200">0</div>
                        
                        <h3>Total Revenue <br>to be Collected</h3>
                        
                    </div>
                    
                </div>
                
                <div class="col-sm-3 col-xs-6">
                    
                    <div class="tile-stats tile-blue">
                        <div class="icon"><i class="entypo-rss"></i></div>
                        <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">0</div>
                        
                        <h3>Today's <br>Revenue</h3>
                        
                    </div>
                    
                </div>
            </div>
            
            <br />
            
            <div class="row">
                <div class="col-sm-6">
                    
                    <div class="panel panel-primary" id="charts_env">
                        
                        <div class="panel-heading">
                            <div class="panel-title">ROOM STATUS</div>
                            
                            <div class="panel-options">
                                
                            </div>
                        </div>
                        
                        
                        
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

                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Room 1</td>
                                    <td class="text-center"><span class="label label-warning">Vacant</span></td>
                                    <td class="text-center"><a href="#">Open</a></td>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Room 1</td>
                                    <td class="text-center"><span class="label label-info">Vacant</span></td>
                                    <td class="text-center"><a href="#">Open</a></td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="text-center">Room 2</td>
                                    <td class="text-center"><span class="label label-success">Occupied</span></td>
                                    <td class="text-center"><a href="#">Open</a></td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td class="text-center">Room 1</td>
                                    <td class="text-center"><span class="label label-danger">Unavailable</span></td>
                                    <td class="text-center"><a href="#">Open</a></td>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Room 1</td>
                                    <td class="text-center"><span class="label label-warning">Cleaning</span></td>
                                    <td class="text-center"><a href="#">Open</a></td>
                                </tr>


                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                </div>
                
                <div class="col-sm-3">'
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>
                                    Checking Out
                                    <br />
                                    
                                </h4>
                            </div>
                            
                            
                        </div>

                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Checking Out Today</th>
                                    <td>3</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Unsecified Check Out</th>
                                    <td>0</td>
                                </tr>

                            </tbody>

                        </table>


                    </div>

                </div>
                <div class="col-sm-3">
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>
                                    Reservation List
                                    <br />
                                    
                                </h4>
                            </div>
                            
                            
                        </div>
                        
                        <div class="panel-body ">
                            <div>
                                <p>Yaa Asantewaa</p>
                                <p>Tel: 0000000000</p>
                                <p>Room No: 0000000000</p>
                                <p>Check In: 12/02/2017</p>
                                <p>Check Out: 12/02/2017</p>
                                <button type="button" class="btn btn-primary">Book Now</button>

                            </div>  
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            
            <br />
            



        </div>
        
        
        
        <!-- Footer -->
    </div>

<?php

require 'assets/incs/foot.php';


}else{

require 'assets/incs/header.php';
require($_page.'.php');
//print_r('<script type="text/javascript">$( document ).ready(function() {if ($("table").hasClass("table")) {var $table4 = ( "table" );$table4.DataTable( {dom: "Bfrtip",buttons: ["copyHtml5","excelHtml5","csvHtml5","pdfHtml5"]} );}} );</script>');

require 'assets/incs/foot.php';
}

?>  