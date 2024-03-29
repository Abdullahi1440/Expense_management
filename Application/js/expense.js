 Loadfunction();
 let Btnaction="insert";
$("#AddNew").on("click" ,function(){
    $("#expensemodal").modal("show");
});

$("#Expenseform").on("submit", function(event){
    event.preventDefault();
    // console.log("submitted");
    let Amount= $("#Amount").val();
    let Type = $("#Type").val();
    let Description = $("#Description").val();
    let update_id = $("#update_id").val();
        let sendingData ;
        if(Btnaction=="insert"){
         sendingData={
           " Amount": Amount ,
            "Type": Type ,
            "Description": Description ,
            "action": "Registration_exp",
            
        }

   }
    else{
     sendingData={
       " Amount": Amount ,
        "Type": Type ,
        "Description": Description ,
        "action": "Updateexpense",
            "update_id":  update_id
        
    }

    }


    $.ajax({
        method:"POST" ,
        dataType: "JSON" ,
        data: sendingData ,
        url:"../api/expense.php" ,
        success:function(data){
            let status= data.status;
            let response =data.data;
            if(status){
                // console.log(response);
                // alert(response)
                Displaymessage("success", response);

                $("#Expenseform")[0].reset();
                Loadfunction();
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
    $("#expenseTable tbody").html('');
    let sendingData={
        "action": "read_all_transaction",
        
    }
   $.ajax({
    method:"POST" ,
    url: "../api/expense.php" ,
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
                    if(i== "Type"){
                        if(item[i]=="income"){
                            tr +=`<td ><span class="badge badge-success">
                            ${item[i]}</span></td>`;
                        }else{
                            tr +=`<td><span class="badge badge-secondary">${item[i]}</span>
                            </td>`;
                        }
                        // if(item[i] == "income"){
                        //     tr += `<td><span class="badge badge-success p-2">${item[i]}</span></td>`
                        // }else{
                        //     tr += `<td><span class="badge badge-danger p-2">${item[i]}</span></td>`
                        // }
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
            $("#expenseTable tbody" ).append(tr);   

         
        }
  

        
        
    },
    error:function(data){
      
    }
   })

}
function updateexpenseinfo(id){
    let sendingData={
        "action": "readtractionupdate",
        "id": id
        
    }
   $.ajax({
    method:"POST" ,
    url: "../api/expense.php" ,
    dataType: "JSON" ,
    data: sendingData ,
    success: function(data){
        let status=data.status;
        let  response = data.data;
        let html="";
        let tr = ''
        if(status){
            $("#update_id").val(response[0].id);
            $("#Amount").val(response[0].Amount);
            $("#Type").val(response[0].Type);
            $("#Description").val(response[0].Description);
            $("#expensemodal").modal("show");
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
        url:"../api/expense.php" ,
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

$("#expenseTable tbody").on("click" ,"a.update_info" , function(){
    let id=$(this).attr("update_id");
    updateexpenseinfo(id);
   
    
})
$("#expenseTable tbody").on("click" ,"a.delete_info" , function(){
    let id=$(this).attr("delete_id");
    // console.log(id)
if(confirm("are you sure to delete this record")){
    delete_info(id);
};
   
    
})
