
$("#from").attr("disabled",true);
$("#to").attr("disabled",true);
$("#type").on("change",function(){
    if($("#type").val()==0){
        $("#from").attr("disabled",true);
        $("#to").attr("disabled",true);
    }else{
        $("#from").attr("disabled",false);
        $("#to").attr("disabled",false);
    }
})
// newWindow.document.write(printArea.innerHTML);
// newWindow.document.write('</body></html>');
// newWindow.print();
// newWindow.close();
$("#print-statement").on("click" ,function(){
    let file = new Blob([$('#print_area').html()],{type:'application/vnd.ms-excel'});
    let url=URL.createObjectURL(file);
    let  a=$("<a/>",{
        href:url ,
        download:"print-statement.xls"}).appendTo("body").get(0).click();
        e.preventDefault();
    }
    );
    

$("#userForm").on("submit", function(event){
   event.preventDefault();
   $("#userTable thead").html("");
   $("#userTable tbody").html("");
      // console.log("submitted");
    let from=$("#from").val();
    let to =$("#to").val();

       let sendingData= {
        "from":from ,
        "to": to ,
        action:"get_user_statement" 

       };
   $.ajax({
       method:"POST" ,
       dataType: "JSON" ,
       data: sendingData ,
       url:"../api/expense.php" ,
       success:function(data){
           let status= data.status;
           let response =data.data;
           let tr="";
           let th="";
      
           if(status){
            response.forEach(rest => {
                th ="<tr>"
                for(let i in rest){
                    th +=`<th>${[i]}</th>`;
                  
                    
                }
                th +="</tr>";
                tr+="<tr>";
                for(let i in rest){
                    
                    tr +=`<td>${rest[i]}</td>`;
                  
 
                }
                tr +="</tr>";
             
 
            });
           
            // console.log(tr)
            $("#userTable thead").append(th);
            $("#userTable tbody").append(tr);   
 
         
        }
        else{
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
               tr +=`<td><a class="btn btn-success update_info" update_id=${item['id']}</a>  update &nbsp;&nbsp;
               <a class="btn btn-danger delete_info" delete_id=${item['id']}</a> delete 
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


