<?php

header("Content-type:application/json");
include '../config/conn.php';
$action=$_POST['action'];


function read_all_links(){
 $data =array();
 $data_array=array();
 $search_results=glob('../view/*.php');
 foreach($search_results as $SR){
    $pure_link=explode('/',$SR);//waxuu ka strings links ka dhigayaa  array link
    $data_array [] =$pure_link[2];//data_array waxaa  loo dhiibay xogta links ee uu hayey variable ka $pure_links
    //ayadoo la isticmaalayoo appends []
    // print_r($pure_link);
}

    if(count($search_results)>0){
        $data=array("status"=>true , "data"=>$data_array);

    }else{
        $data=array("status"=>false , "data"=>"not found");
    }
    echo json_encode($data);

//  print_r($search_results);

}
function Registration_link($conn){
    $data=array();
    extract($_POST);

    //BUILD QUERY & PROCEDURES
        $myquery="INSERT INTO `links`(`name`, `link`, `category_id`) VALUES('$name', '$link','$category_id')";
        $result=$conn->query($myquery);
        if($result){
            
        //    while($row=$result->fetch_assoc()) {
        //     $data[]=$row;
        //    }
            $data=array("status"=>true ,"data"=>"success fully registred");

            
            // $data=array("status"=>true ,"data"=>"success fully registred");

        }else{
            $data=array("status"=>false ,"data"=>$conn->error);

        }
        echo json_encode($data);

        }
function read_all_link($conn){
    $data= array();
    $message= array();
    $mysql= "SELECT * FROM links";
    $display= $conn->query($mysql);
    if($display){
        while($row= $display -> fetch_assoc()){
            $data[] =$row;
        }

        $data= array("status" =>true , "data" => $data);

    }else{
        $message=array("status"=>false , "data"=>$conn->error);
    }
    echo json_encode($data);

}


function readtractionupdate($conn){
    $data= array();
    $message= array();
    extract($_POST);
    $mysql= "SELECT * FROM links where id ='$id'";
    $display= $conn->query($mysql);
    if($display){
        while($row= $display -> fetch_assoc()){
            $data[] =$row;
        }
        $data= array("status" =>true , "data" => $data);

    }else{
        $message=array("status"=>false , "data"=>$conn->error);
    }
    echo json_encode($data);

}
function Updatelink($conn){
    $data= array();
    $message= array();
    extract($_POST);
    // extract($_POST);
    $mysql= "UPDATE links SET name='$name' , link='$link' ,
                category_id='$category_id' WHERE id='$update_id'";
    $display= $conn->query($mysql);
    if($display){
        $data= array("status" =>true , "data" => "Updated successfully");

    }else{
        $message=array("status"=>false , "data"=>$conn->error);
    }
    echo json_encode($data);

}

function deletefunction($conn){
    $data= array();
    $message= array();
    $id= $_POST['id'];
    $mysql= "DELETE  FROM links WHERE id='$id'";
    $display= $conn->query($mysql);
    if($display){
        $data= array("status" =>true , "data" =>"Succesfully deleted your record");

    }else{
        $message=array("status"=>false , "data"=>$conn->error);
    }
    echo json_encode($data);

}

if(isset($action)){
    $action($conn);
}else{
    // echo json_encode($data=array("status"=>false , "data"=>"action is filed"));
    echo"action is required";
}

?>