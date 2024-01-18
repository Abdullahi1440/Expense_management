Loadfunction();
 let Btnaction="insert";
$("#AddNew").on("click" ,function(){
    $("#categorymodal").modal("show");
});

$("#categoryform").on("submit", function(event){
    event.preventDefault();
    // let form_data=new FormData($("#categoryform")[0]);
 
    let update_id = $("#update_id").val();
    let name=$("#name").val();
    let icon=$("#icon").val();
    let role=$("#role").val();
    let sendingData;
        if(Btnaction=="insert"){
          
        //    sendingData= form_data.append("action", "Registration_category");
        sendingData={
                "name":name ,
                "icon":icon ,
                "role":role ,
                "action":"Registration_category"       
        }

   }
    else{
        sendingData={
            "name":name ,
            "icon":icon ,
            "role":role ,
           "update_id":update_id ,
            "action":"Updatecategory"       
   
    }



    }


    $.ajax({
        method:"POST" ,
        dataType: "JSON" ,
        data: sendingData ,
        url:"../api/category.php" ,
        success:function(data){
            let status= data.status;
            let response =data.data;
            if(status){
                // console.log(response);
                // alert(response)
                Displaymessage("success", response);

                $("#categoryform")[0].reset();
                Loadfunction();
                    Btnaction="insert"
                $("#categorysemodal").modal("hide");
               
            }else{
                Displaymessage("error", response);
            }
        },
        error:function(data){

                
        }

    })
  
})
function Loadfunction(){
    $("#categoryTable tbody").html('');
    let sendingData={
        "action": "read_all_category",
        
    }
   $.ajax({
    method:"POST" ,
    url: "../api/category.php" ,
    dataType: "JSON" ,
    data: sendingData ,
    success: function(data){
        let status=data.status;
        let  response = data.data;
        let html="";
        let tr = ''
        if(status){
            response.forEach(item => {
                tr +="<tr>";
                for(let i in item){
                    tr +=`<td>${item[i]}</td>`;
                    // if(i== "Type"){
                    //     if(item[i]=="income"){
                    //         tr +=`<td ><span class="badge badge-success">
                    //         ${item[i]}</span></td>`;
                    //     }else{
                    //         tr +=`<td><span class="badge badge-secondary">${item[i]}</span>
                    //         </td>`;
                    //     }
                    //     // if(item[i] == "income"){
                    //     //     tr += `<td><span class="badge badge-success p-2">${item[i]}</span></td>`
                    //     // }else{
                    //     //     tr += `<td><span class="badge badge-danger p-2">${item[i]}</span></td>`
                    //     // }
                    //  }else{
                    //      // console.log("this is " , i );
                    //          // console.log("this is " ,item);
                         
                    // }

                }
                tr +=`<td><a class="btn btn-success update_info" update_id=${item['id']} </a> <i class="fa fa-edit"></i> &nbsp;&nbsp;
                <a class="btn btn-danger delete_info" delete_id=${item['id']}
                
                </a> 
                <i class="fa fa-trash"></i>
                </td>`
                tr +="</tr>";

            });
           
            // console.log(tr)
            $("#categoryTable tbody" ).append(tr);   

         
        }
  

        
        
    },
    error:function(data){
      
    }
   })

}
function updatecategoryinfo(id){
    let sendingData={
        "action": "readtractionupdate",
        "id": id
        
    }
   $.ajax({
    method:"POST" ,
    url: "../api/category.php" ,
    dataType: "JSON" ,
    data: sendingData ,
    success: function(data){
        let status=data.status;
        let  response = data.data;
        let html="";
        let tr = ''
        if(status){
            $("#update_id").val(response[0].id);
            $("#name").val(response[0].name);
            $("#icon").val(response[0].icon);
            $("#role").val(response[0].role);
            $("#categorymodal").modal("show");
            Btnaction="update";
          
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
        url:"../api/category.php" ,
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

$("#categoryTable tbody").on("click" ,"a.update_info" , function(){
    let id=$(this).attr("update_id");
    updatecategoryinfo(id);
   
    
})
$("#categoryTable tbody").on("click" ,"a.delete_info" , function(){
    let id=$(this).attr("delete_id");
    // console.log(id)
if(confirm("are you sure to delete this record")){
    delete_info(id);
};
   
    
})
