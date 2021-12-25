let email = document.getElementById('email')
let password = document.getElementById('password')
let token = document.getElementById('token')
let manager = document.getElementById('manager')
let tenant = document.getElementById('tenant')

var form = new FormData()
var xhttp = new XMLHttpRequest()
manager.onclick = function (){
  if(email.value!="" && password.value!=""){
    form.append("email",email.value)
    form.append("password", password.value)
    form.append("token",token.value)
    form.append("account","manager")
    
    xhttp.onreadystatechange = function (){
      if(this.readyState == 4 && this.status == 200){
        if(this.responseText == 1){
          window.location.href="/app/manager/";
        }
        else{
          document.getElementById('error').innerHTML = this.responseText
          email.value = "";
          token.value="";
          password.value="";
        }
      }
    }
    xhttp.open("POST","login.php","true")
    xhttp.send(form)
    clr()
  }
  else alert("error:Empty fields")
  
}
tenant.onclick = function (){
  if(email.value!="" && password.value!=""){
    form.append("email",email.value)
    form.append("password", password.value)
    form.append("token",token.value)
    form.append("account","tenants")
    
    xhttp.onreadystatechange = function (){
      if(this.readyState == 4 && this.status == 200){
        if(this.responseText == 1){
          window.location.href="/";
        }
        else{
          document.getElementById('error').innerHTML = this.responseText
          email.value = ""
          password.value = ""
          token.value = ""
        }
      }
    }
    xhttp.open("POST","login.php","true")
    xhttp.send(form)
    clr()
  }
  else alert("error:Empty fields")
  
}
