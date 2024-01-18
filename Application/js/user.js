Loadfunction();
// Loadfunction();
let Btnaction="insert";
let update;
 let fileImage=document.querySelector("#image");
 let showInput=document.querySelector("#show");
 const reader=new FileReader();
 fileImage.addEventListener("change", (e)=>{
    const selectedFile = e.target.files[0];
    reader.readAsDataURL(selectedFile);

 });
 reader.onload =e =>{
    showInput.src=e.target.result;
    
 }
$("#AddNew").on("click" ,function(){
    $("#usermodal").modal("show");
})

 
$("#userform").on("submit", function(event){
    event.preventDefault();
    // console.log("submitted");
    // let Amount= $("#Amount").val();
    // let Type = $("#Type").val();
    // let Description = $("#Description").val();
    // let update_id = $("#update_id").val();
    //     let sendingData ;
    
    let form_data =new FormData ($("#userform")[0]);
    form_data.append("image",$("input[type=file]")[0].files[0]);

    
        if(Btnaction=="insert"){
            form_data.append("action" ,  "registerUser");
            
            
   }else{
    form_data.append("action ", "Updateusers");

   }
    $.ajax({
        method:"POST" ,
        dataType: "JSON" ,
        data: form_data ,
        url:"../api/user.php" ,
       processData:false ,
       contentType:false ,
        
        success:function(data){
            let status= data.status;
            let response =data.data;
            if(status){
                // console.log(response);
                // alert(response)
                Displaymessage("success", response);

                $("#userform")[0].reset();
                // Loadfunction();
                    Btnaction="insert"
                // $("#expensemodal").modal("hide");
               
            }else{
                Displaymessage("error", response);
            }
        },
        error:function(data){

                
        }

    })
  
})

function Loadfunction(){
    $("#userList_table tbody").html('');    let sendingData={
        "action": "userListfuction",
        
    }
   $.ajax({
    method:"POST" ,
    url: "../api/user.php" ,
    dataType: "JSON" ,
    data: sendingData ,
    success: function(data){
        let status=data.status;
        let  response = data.data;
        let html="";
        let tr = ''
        if(status){
            response.forEach(item => {
                th="<tr>";
                for(let i in item){
                    th +=`<th>${i}</th>`;
                }
                th +="</tr>";
                tr +="<tr>";
                for(let i in item){
                    if(i== "image"){
                      
                            tr +=`<td ><img style="width:50%;height:50%; border-radius:50%; object-fit:cover;"; src="../uploads/${item[i]}"</td/>`;
                    
                     }else{
                         // console.log("this is " , i );
                             // console.log("this is " ,item);
                          tr +=`<td>${item[i]}</td>`;
                    }

                }
                tr +=`<td><a class="btn btn-success update_info" update_id=${item['id']} </a> <i class="fa fa-edit"></i> &nbsp;&nbsp;
                <a class="btn btn-danger delete_info" delete_id=${item['id']}
                
                </a> 
                <i class="fa fa-trash"></i>
                </td>`
                tr +="</tr>";

            });
           
            // console.log(tr)
            $("#userList_table tbody" ).append(tr);  
            $("#userList_table thead").append(th);

         
        }
  

        
        
    },
    error:function(data){
      
    }
   })

}

    function updateuserinfo(id){
    let sendingData={
        "action": "readtractionupdate",
        "id": id
        
    }
   $.ajax({
    method:"POST" ,
    url: "../api/user.php" ,
    dataType: "JSON" ,
    data: sendingData ,
    success: function(data){
        let status=data.status;
        let  response = data.data;
     
        let html="";
        let tr = ''
        if(status){
            $("#usermodal").modal("show");
            $("#update_id").val(response[0].id);
            $("#username").val(response[0].username);
            $("#password").val(response[0].password);
            $("#image").val(response[0].image);
            Btnaction="update";
            Loadfunction();
        
          
        }
  

        
        
    },
    error:function(data){
      
    }
   })

}

function delete_info(id){
    let deletedata={
        "action": "deletefunction" ,
        "id": id ,
    }
    $.ajax({
        method:"POST" ,
        url:"../api/user.php" ,
        dataType: "JSON" ,
        data: deletedata ,
        success: function(data){
            let status=data.status;
            let response=data.data;
            alert(response);
            Loadfunction();


        },
        error:function(data){
            console.log(data);
        }
       
    })
}

function Displaymessage(type , message) {
    let success =document.querySelector(".alert-success");
    let error =document.querySelector(".alert-danger");
    if(type =="success"){
        error.classList="alert alert-danger d-none";
        success.classList="alert alert-success";
        success.innerHTML=message;

    }
    else if(type=="error"){
        error.classList=="alert alert-danger";
        error.innerHTML=message;



    }
}

$("#userList_table tbody").on("click" ,"a.update_info" , function(){
    let id=$(this).attr("update_id");
    updateuserinfo(id);
   
    
})
$("#userList_table tbody").on("click" ,"a.delete_info" , function(){
    let id=$(this).attr("delete_id");
    // console.log(id)
if(confirm("are you sure to delete this record")){
    delete_info(id);
};
   
    
})

