$('.threedots').click(function(e) { 
    var offset = $(this).offset();
    if($('.three-options:visible').length == 0) 
    {
        $('.three-options').fadeIn(200).offset({ top:offset.top , left:(offset.left-110) });
    }else{
        $('.three-options').fadeOut(200);
  }

    var file_loc = $(this).attr('id');
    $('#delete').click(function() {
        $('#pop-up').fadeIn(400);
       $('#pop-up label').html('Are you sure you want to move this file to trash?');

       $('#pop-up button').click(function() {

           if ($(this).text() == 'Yes') {                 
            $.ajax({
                type: "GET",
                url: "trash.php",
                datatype: "html",
                data: "fileloc="+file_loc,
                success: function(data) {
                   if(data){
                    location.reload();
                   }else{
                    alert('Could not delete file.');
                   }
                  }
              });
               
           }else {
            $('#pop-up').fadeOut(100);
           }
       });
    });
});  