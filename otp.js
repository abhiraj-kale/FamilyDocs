$( "#inp_otp" ).keyup(function() {
  if($('#inp_otp').val()==''){
    $('#inp_otp').css("letter-spacing", "0px");
  }else{
      $('#inp_otp').css("letter-spacing", "10px");
 }
});


$('#button').click(function() {
  var input = $('#inp_otp').val();
  $.ajax({
url: 'validate.php',
data: 'input='+input,
success: function(data) {
  if(data=='error'){
    $('#lbl2').html('Incorrect OTP');
  }else{
    window.location.href = 'http://localhost/projects/registration/home.php';
  }
}
  });
});

$("#sendagain").click(function() {
  $('#lbl-1').html('Sending OTP again...');
  $('#lbl-2').html('');
});
