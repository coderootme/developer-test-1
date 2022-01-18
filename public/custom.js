function send(e,form) {
   e.preventDefault();
   fetch(form.action, {
      method: form.method,
      body:   new FormData(form)
   })
   .then(response => response.json())
   .then(function(data){
      if (data[0]=='error'){
         let message = 'The following errors occured:<br />';
         for (value of data[1]){
            message += value+'<br />';
         }
         document.getElementById("errorList").innerHTML = message;
      }
      else if (data[0]=='success'){
         document.getElementById("errorList").innerHTML = '';
         document.getElementById("peopleList").innerHTML = data[1];
         let inputs = document.getElementsByTagName("input");
         for (let i=0; i < inputs.length; i++) {
            if (inputs[i].type == "text") {
               inputs[i].value = "";
            }
         }
      }
   });
}
