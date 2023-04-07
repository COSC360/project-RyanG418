function validateForm() {   
    let x = document.forms["myForm"]["password1"].value;
    let y =document.forms["myForm"]["password2"].value;
    let z = document.forms["myForm"]["username"].value;
    let fileInput = document.getElementById('fileToUpload');
    let filePath = fileInput.value;
    let allowedExtensions = /(\.jpg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }
    if(fileInput.value = ''){
        alert('Please upload a file');
        fileInput.value = '';
        return false;
    }
    if (!x==y) {
      alert("passwords must match");
      return false;
    } else if(x==""){
        alert("password must be filled ");
        return false;
    } else if(y==""){
        alert("both passwords must be filled in");
        return false;
    } else if(z==""){
        alert("username must be filled in");
        return false;
    }
  }
  function validateLogin() {   
    let x = document.forms["login"]["password1"].value;
    let z = document.forms["login"]["username"].value;
    if(x==""){
        alert("password must be filled");
        return false;
    } else if(z==""){
        alert("username must be filled in");
        return false;
    }
  }
  function validatePost() {   
    let x = document.forms["post"]["password1"].value;
    let z = document.forms["post"]["username"].value;
    if(x==""){
        alert("password must be filled");
        return false;
    } else if(z==""){
        alert("username must be filled in");
        return false;
    }
  }
