
$('#img').click(function() {
   $('.insertfile input[type=file]').click();
});
$(document).ready(function() { 
  
});

$('#removefile').click(function() {
   $('#file').val('');
   $('#submit-file').attr('disabled',true);
  
});

$('.insertfile input[type=file]').click(function() {
   $('#submit-file').attr('disabled',false);
   $('#removefile').attr('disabled',false);
});

$('#submit-file').click(function() {
   if($('#file').val() == ''){
       $('#submit-file').attr('disabled',true);
       $('#removefile').attr('disabled',true);
   }else{
       console.log($('#file').val());
   }
});