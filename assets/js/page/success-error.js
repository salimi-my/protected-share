"use strict";

function success_swal(message){
  swal({
    title: "Success!",
    text: message,
    icon: "success",
    button: "Okay!"
  });
}

function error_swal(message){
  swal({
    title: "Error!",
    text: message,
    icon: "error",
    button: "Okay!"
  });
}
