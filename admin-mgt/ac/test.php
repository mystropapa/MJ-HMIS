<?php
require 'core/config.db.php';
$uid="L101";
$gd="M";
$uname="admin";
$priv="admin";
$adds="box 5";
$dob="32323";
$password="admin";
$phone="0244039393939848";
$email="admin@aau.org";
$test=array("fool","dog","porn");
$test1=array("pod","dtog","porcvcn");
$new=array();
//$response=get_all_fields_scores("6");
$response=substr("2017-02-01 00:00:00", 0,10);
$response=get_current_app_setup();
//$response=getOneUserLog("L101");
// 
//$response=getOneReferee("4");
//$response=rand_fac();
//$response=getOneUserDetail('AAU/PASET/2017/1004');
//$response=get_one_app_setup("6");
//  $response["fisrt"]="`".implode('`,`', $new['fields'])."`";
//  $response["sec"]="'".implode("','", $test)."'";
//  $response["sec"]="sum(".implode(")+sum(", $test).")";
// //print_r(array_map("filterData", $test));
// // $review=array("Relevance of Program","Usefullness of topic","Clarity of topic");
// // $score=array("40","20","40");
// // $response=app_setup("Togo Elections","prgm","12/11/1992",$review, $score, "11/02/2017");
// //$response=storeUser($uid,$uname,$email,$dob,$gd,$adds,$phone,$priv,$password);

print("<pre>".print_r($response,true)."</pre>");





   /* // Find out how many items are in the table
    
    $main = mysqli_query($con,"SELECT * FROM  `to_be_Reviewed` AS ab WHERE NOT EXISTS ( SELECT * FROM gencon_reviews AS rf WHERE rf.ab_id = ab.ab_idAND rf.uid =  '".$uid."')");
    $total = mysqli_num_rows($main);

    // How many items to list per page
    $limit = 1;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'pg', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));


// Prepare the paged query
    $stmt = mysqli_num_rows($main);

    // // Bind the query params
    // $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    // $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    // $stmt->execute();

    // Do we have any results?
    if ($stmt > 0) {
        // Define how we want to fetch the results
        $response=array();
        while ($row=mysqli_fetch_assoc($main)) {
		      $response[]=$row;
		    }
print("<pre>".print_r($response[$page-1],true)."</pre>");
        // // Display the results
        // foreach ($iterator as $row) {
        //     echo '<p>', $row['name'], '</p>';
        // }

    } else {
        echo '<p>No results could be displayed.</p>';
    }



print_r($page);
    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=view_one_app&pg=1&uid='.$response[0]['User_ID'].'" title="First page">&laquo;</a> <a href="?page=view_one_app&pg=' . ($page - 1) . '&uid='.$response[$page-2]['User_ID'].'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=view_one_app&pg=' . ($page + 1) . '&uid='.$response[$page]['User_ID'].'" title="Next page">&rsaquo;</a> <a href="?pg=' . $pages . '&uid='.$response[$pages-1]['User_ID'].'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    */

function printAllFilesandFolders($dir){
    $FilesnFolders= scandir($dir);
    echo '<ul>';
    foreach($FilesnFolders as $fileorFolder){
        if($fileorFolder != '.' && $fileorFolder != '..'){
            echo '<li>'.$fileorFolder;
            if(is_dir($dir.'/'.$fileorFolder)) printAllFilesandFolders($dir.'/'.$fileorFolder);
            echo '</li>';
        }
    }
    echo '</ul>';
}

$getCurrentWorkingDirectory=getcwd();
printAllFilesandFolders($getCurrentWorkingDirectory);





// function increment($number) {
//     $number = $ number + 1;
//     echo $number;
// }

// echo increment(2);

$fruits = array ( 'orange', 'apple', 'banana' );
echo"<select>";
foreach ($fruits as $fruit) {
    if ($fruit=="apple") {
        echo "<option value='".$fruit."' selected>".$fruit."</option>";
    }else{
        echo "<option value='".$fruit."'>".$fruit."</option>";
    }
    
}
echo "</select>";





class Human {
  public $name;
  public $occupation;
  private $distance ;
  private $direction ;

  public function __construct($name, $occupation, $distance=0, $direction=0) {
    $this->name = $name;
    $this->occupation = $occupation;
    $this->distance = $distance;
    $this->direction = $direction;
    }

  public function stop() {
    echo "$this->name stopped all activity.<br/>";
    }

  public function walk ($step) {
    $this->distance += $step;
    echo "$this->name walks $step steps.<br/>";
    }

  public function turns($degres) {
    $this->direction += $degres;
    echo "$this->name turned $degres degree(s).<br/>";
    }

  public function status() {
    echo "$this->occupation $this->name walked $this->distance steps since the beginning, and now faces the degree $this->direction.<br/>";
    }
  }


$Human= new Human("Richard","Developer");

print_r($Human->walk("10"));
print_r($Human->stop());
print_r($Human->turns("180"));
print_r($Human->status());


function increment($number) {
    $number = $number + 1;
echo $number;
}   
echo increment(2);


?>

<script type="text/javascript">

class Polygon {
    constructor(height, width) { //class constructor
        this.name = 'Polygon';
        this.height = height;
        this.width = width;
    }

    sayName() { //class method
        console.log('Hi, I am a', this.name + '.');
    }
}

class Square extends Polygon {
    constructor(length) {
        super(length, length); //call the parent method with super
        this.name = 'Square';
    }

    get area() { //calculated attribute getter
        return this.height * this.width;
    }
}

var s = new Square(5);

s.sayName();
console.log(s.area);</script>