let firstName = document.getElementById("fname")
let surName = document.getElementById("sname")
let email = document.getElementById("email")
let token = document.getElementById('token')
let password = document.getElementById("password")
let account = document.getElementById('account')
let pass = document.getElementById("pass")

function validate(){
  if(firstName.value == ""){
    return false;
  }
  else if(surName.value==""){
    return false
  }
  else if(email.value == ""){
    return false
  }
  else{
    let format = /^\W/
    if(format.test(firstName.value)){
      return false
    }
    else if(format.test(surName.value)){
      return false
    }
    /*else if(format.test(email.value)){
      return false
    }*/
    else return true
  }
}
function create(){
  let form = new FormData();
  form.append("fname",firstName.value)
  form.append("sname",surName.value)
  form.append("email",email.value)
  form.append("password", password.value)
  form.append("pass",pass.value)
  form.append("account", account.value)
  form.append("token",token.value)
  if (validate){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function (){
      if(this.readyState == 4 && this.status == 200){
        if(this.responseText == 1){
          window.location.href="/app/login/"
        }
        else alert(this.responseText)
      }
    }
    xhttp.open("POST","create.php",true)
    xhttp.send(form)
    clear()
  }
}
/*function addContact(){
  
  if(contact.length == 0){
    var i = 0
  }
  else{
    var i = contact.length - 1
  }
  contact[contact.length] = contacts.value
  toAdd.innerHTML += contact[contact.length-1]+"<br>"
  alert(contact.length)
}*/

function showValues(arr){
  
}