$(document).ready(function(){
  $('#error_msg').css({'display':'block'});
  $('.header-div').show(650,function(){
    $('.list').slideDown(1000);
    $('ul').show(1000);
  });
});

$("input[type='text'],input[type='password'],input[type='email']").focusin(function() {
    $(this).css({'box-shadow':'5px 5px 5px black'});
}).focusout(function() {
  $(this).css({'box-shadow':'none'});
});

$('#signup_form').submit(function(){
  $('#lbl').css({'display':'block'});
  $('#error_msg').css({'display':'none'});
});
$('#checkbox').mousedown(function (){
  var pass = $('#password').attr('type');
  if (pass=='password') {
    $('#password').attr('type','text');
  }else {
    $('#password').attr('type','password');
  }
}).mouseup(function (){
  var pass = $('#password').attr('type');
  if (pass=='password') {
    $('#password').attr('type','text');
  }else {
    $('#password').attr('type','password');
  }
});
$("#username").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
