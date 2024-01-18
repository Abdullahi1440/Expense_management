<?php

header("Content-type:application/json");
include '../config/conn.php';
$action=$_POST['action'];
function Registration_category($conn){
    $data=array();
    extract($_POST);

    //BUILD QUERY & PROCEDURES
        $myquery="INSERT INTO `category`(`name`, `icon`, `role`) VALUES('$name','$icon','$role')";
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
function read_all_category($conn){
    $data= array();
    $message= array();
    $mysql= "SELECT * FROM category";
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
    $mysql= "SELECT * FROM category where id ='$id'";
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
function Updatecategory($conn){
    $data= array();
    $message= array();
    $update_id=$_POST['update_id'];
    $name=$_POST['name'];
    $icon=$_POST['icon'];
    $role=$_POST['role'];
    // extract($_POST);
    $mysql= "UPDATE category SET name='$name' , icon='$icon' ,
                role='$role' WHERE id='$update_id'";
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
    $mysql= "DELETE  FROM category WHERE id='$id'";
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