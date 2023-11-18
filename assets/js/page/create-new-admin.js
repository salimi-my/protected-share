"use strict";

$("#generate-password").on("click", function(){
  var length = 12,
  charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
  retVal = "";
  for (var i = 0, n = charset.length; i < length; ++i) {
    retVal += charset.charAt(Math.floor(Math.random() * n));
  }
  // return retVal;
  $("#password").val(retVal);
});

$("#show-password").on("click", function(){
  $("#password").attr("type", "text");
  $("#show-password").hide();
  $("#hide-password").show();
});

$("#hide-password").on("click", function(){
  $("#password").attr("type", "password");
  $("#hide-password").hide();
  $("#show-password").show();
});

var cleave_username = new Cleave('.username', {
  lowercase: true,
  blocks: [0, 9999],
  rawValueTrimPrefix: true
});

var cleave_phone = new Cleave('.phone', {
  phone: true,
  phoneRegionCode: 'my',
  rawValueTrimPrefix: true
});

$('#create-new-admin-submit').on('click', function(e){
  $('#phone').val(cleave_phone.getRawValue());
  $('#username').val(cleave_username.getRawValue());
});
