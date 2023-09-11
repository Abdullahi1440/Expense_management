$("#AddNew").on("click" ,function(){
    $("#expensemodal").modal("show");
});

$("#Expenseform").on("submit", function(event){
    event.preventDefault();
    // console.log("submitted");

    let Amount= $("#Amount").val();
    let Type = $("#Type").val();
    let Description = $("#Description").val();
    let sendingData={
       " Amount": Amount ,
        "Type": Type ,
        "Description": Description ,
        "action": "Registration_exp",
    }

    $.ajax({
        method:"POST" ,
        dataType: "JSON" ,
        data: sendingData ,
        url:"../api/expense.php" ,
        success:function(data){
            let status= data.status;
            let response =data.data
            if(status){
                // console.log(response);
                // alert(response)
                Displaymessage("success", response);
                $("#Expenseform")[0].reset();
                // $("#expensemodal").modal("hide");
               
            }else{
                Displaymessage("error", response);
            }
        },
        error:function(data){

                
        }

    })
  
})
function Displaymessage(type , message) {
    let success =document.querySelector(".alert-success");
    let error =document.querySelector(".alert-danger");
    if(type =="success"){
        error.classList=".alert alert-danger d-none";
        success.classList=".alert alert-success";
        success.innerHTML=message;
    }else{
        error.classList==".alert alert-danger";
        error.innerHTML=message;



    }
}

