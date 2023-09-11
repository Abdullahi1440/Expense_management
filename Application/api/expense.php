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
    $data=array("status"=>true ,"data"=>"success fully registred");

 }else{
    $data=array("status"=>false ,"data"=>$conn->error);

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