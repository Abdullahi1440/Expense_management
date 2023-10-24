<?php

header("Content-type:application/json");
include '../config/conn.php';
$action=$_POST['action'];
function Registration_exp($conn){
    $data=array();
    extract($_POST);

    //BUILD QUERY & PROCEDURES
        $myquery="CALL Registerexpense_sp('', '$Amount' ,'$Type' , '$Description' , 'USR400')";
        $result=$conn->query($myquery);
        if($result){
            
            $row=$result->fetch_assoc();
         
            if($row["message"] =="Deny"){
                $data=array("status"=>false ,"data"=>" Your ballance is Insufficience");
            }
            elseif($row['message'] =='Registered'){
            $data=array("status"=>true ,"data"=>"success fully registred");

            }
            // $data=array("status"=>true ,"data"=>"success fully registred");

        }else{
            $data=array("status"=>false ,"data"=>$conn->error);

        }
        echo json_encode($data);

        }
function read_all_transaction($conn){
    $data= array();
    $message= array();
    $mysql= "SELECT * FROM expense";
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
    $mysql= "SELECT * FROM expense where id ='$id'";
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
function Updateexpense($conn){
    $data= array();
    $message= array();
    $update_id=$_POST['update_id'];
    $Amount=$_POST['Amount'];
    $Type=$_POST['Type'];
    $Description=$_POST['Description'];
    $mysql= "UPDATE expense SET Amount='$Amount' , Type='$Type' ,
                Description='$Description' WHERE id ='$update_id'";
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
    $mysql= "DELETE  FROM expense WHERE id='$id'";
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