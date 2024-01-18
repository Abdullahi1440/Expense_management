<?php

header("Content-type:application/json");
include '../config/conn.php';
// $action = $_POST ['action'];
$action=$_POST['action'];
function generation($conn){
    extract($_POST);
    $data= array();
    $message= array();
    $New_id='';
    
    $mysql= "SELECT * FROM `user` ORDER BY user.id DESC LIMIT 1";
    $result= $conn->query($mysql);
    $number_rows;
    if($result){
        // $number_rows;
        // $number_rows=$result->number_rows;
        $number_rows=$result->num_rows;
        if($number_rows>0){
            $row=$result->fetch_assoc();
            $New_id=++$row['id'];
        }
        else{
            $New_id="USER4001";
        }
    

        return $New_id;

    }
  
}

#Registeration User
#file names
#upload folder
function registerUser($conn){
    #samee file names-ka variables kooda
    $file_name = $_FILES['image']['name']; #waa variable imageka kala bixi doono magacaga image aad soo gelido
    $file_type = $_FILES['image']['type']; # waa varibale kala kuu sheegi doono noca sawirka uu yahya sida (png, jpg, jpeg)
    $file_size = $_FILES['image']['size']; #waa variable ku sheegi doono size-ka image-ka sida (10 Mb, 5 Kb)
    
    #sawirada noocee ayaad rabtaa ama u ogalaaneysaa in lasoo gelin karo
    $allowed_images = ["image/png", "image/jpg", "image/jpeg"];

    #samee varibale kuna shubo wixii kasoo laabay function-ka generation
    $new_id = generation($conn);
    #samee variable sameynayo userka aad diiwaan gelinayso si uu kuu haayo tuaale (USER4001.png)
    $saved_name = $new_id.".png";

    extract($_POST);
    $data = array();
    $error_message = array(); # waxaa lagu shubi doona dhamaan error-ka kasoo laabat files-ka

    # check garee hadii file-ka lasoo doortay uu yahay midka ad u ogaalatay iyo size-ka file-ka
   if(in_array($file_type, $allowed_images)){
        $max_size = 5 * 1024 * 1024; #"5 MB"
        if($file_size > $max_size){
            $error_message [] = "File size " . $file_size/1024/1024 . " MB exceeds allowed size ". $max_size/1024/1024 . " MB";
        }

    }else{
        $error_message [] = "This File Types Is not allowed ". $file_type;
    }

    if(count($error_message) <= 0){
        $query = "CALL registerationUserSp('$new_id', '$username', MD5('$password'), '$saved_name')";

        $result = $conn->query($query);

        if($result){
            $row = $result->fetch_assoc();
            
            if($row['Message'] == 'Deny'){
                $data = array("status" => false, "data" => "Sorry!. This user is already taken.❌");
            }else if($row['Message'] == 'Register'){
                move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$saved_name);
                $data = array("status" => true, "data" => "Successfully Registered ✔");
            }
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }

    }else{
        $data = array("status" => false, "data" => $error_message);
    }

    echo json_encode($data);
}

function userListfuction ($conn){
    $data= array();
    $message= array();
    $mysql= "SELECT * FROM user";
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
function get_user_statement($conn){
    extract($_POST);
    $data= array();
    $message= array();
    $mysql= "CALL Get_user_statement_sp('USR400','$from','$to')";
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
    $mysql= "SELECT * FROM user where id ='$id'";
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
function Updateusers($conn){
    $data= array();
    $message= array();
    // $update_id=$_POST['update_id'];
    // $Amount=$_POST['Amount'];
    // $Type=$_POST['Type'];
    extract($_POST);
    $mysql= "UPDATE user SET username='$username' , password='$password' ,
                image='$image' WHERE id ='$update_id'";
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
    $mysql= "DELETE  FROM user WHERE id='$id'";
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