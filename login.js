$(document).ready(function(){
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

$('#goback').click(function() {
  window.location.href = "http://localhost/projects/registration/signup.php";
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
