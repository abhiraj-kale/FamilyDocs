
if($('.recents-table').html()==''){
    $('#background').css({ 'display':'block'});
   }else{
    $('#background').css({ 'display':'none'});  
  }
  
  $('#log-out').mouseover(function() {
      $(this).css({'background-color':'rgb(230, 153, 0)'});
    }).mouseleave(function() {
      $(this).css({'background-color':'white'});
    }).click(function(){
      $(location).attr( 'href',"http://localhost/projects/registration/login.php");
    });
    $('.logo').click(function() {
      window.location.href = "http://localhost/projects/registration/home.php";
    });
  
   
    
    $('#search').on('input',function() {
      var search = $(this).val();
      if(search ==''){
        $('.search-div-outer').fadeOut(200);
      }else{
        $(this).css({'box-shadow':'2px 2px 2px black'});
      }
  
    }); 
  
    // Function
    $('#go').on('click' , function () {
      var search = $('#search').val();
      $('.search-div-outer').fadeIn(200);
      $.ajax({
        type: "GET",
        url: "search.php",
        data: "search="+search,
        success: function (response) {
         $('.search-div-inner').html(response);
         if ($('.search-div-inner td').length<1) {
          $('.search-div-inner').html('<h1 style="margin-top:20%;margin-left:37%">No results Found</h1>');
         }
        }
      });
     
    });
  
    $(document).on('click' ,'.options input[type=button]',function(){ 
        var filename = $(this).val();
        $('.center-up').text(filename);
  
          if (filename == 'Recents') {
            window.location.href = 'http://localhost/projects/registration/home.php';
          }else{
            $.ajax({
              type: "get",
              url: filename+".php",
              dataType: "html",
              success: function (response) {
                  $('.recents-table').html(response);               
              }
          });
          }
       
    });
    var file_loc;
    $('.threedots').click(function(e) {
            
      var offset = $(this).offset();
          $('.three-options').fadeIn(200).offset({ top:offset.top , left:(offset.left-110) });
  
          var file_star = $(this).attr('id');
          $('#star').click(function() {
            $.ajax({
              type: "GET",
              url: "starred.php",
              datatype: "html",
              data: "filestar="+file_star ,
             success: function(data) {
                 if (data) {
                   alert("File Moved to Starred");
                   $('.three_options').fadeOut(200);
                   location.reload();
                 }else{
                   alert('Could not move file to Starred.Try again later');
                   $('.three_options').fadeOut(200);
                 }            
                }
             });
          });
  
       file_loc = $(this).attr('id');
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
                      $('.three_options').fadeOut(200);
                     }else{
                      alert('Could not delete file.');
                      $('.three_options').fadeOut(200);
                     }
                    }
                });
                 
             }else {
              $('#pop-up').fadeOut(100);
             }
         });
      });
      $('#album').click(function() {
        $.ajax({
          type: "POST",
          url: "add-album.php",
          data: "fileadd="+file_loc,
          success: function (response) {
           $('.right-down').css({'display':'block'}); 
           $('.right-down').html('<label>Select the Album:</label>');
           $('.right-down label').append("<br>").append(response);
           $('.three-options').fadeOut(200);
          }
        });  
      });
      
  });  
  
  $(document).on('click', '.add_album_row' ,function() {
    albumloc = $(this).attr('id');
  
    $.ajax({
      type: "POST",
      url: "createalbum.php",
      data: "album_file="+albumloc+'& fileloc2='+file_loc,
  
      success: function (response) {
       if (response!=3){
        if(response=='File moved'){
          alert(response +' to '+$('.add_album_row').first().text());
        }else if(response==false){
          alert('Could not move file');
        } 
        }
      }
    });
  });
  $(document).on('click','.three_dots1',function() {
    var offset = $(this).offset();
         $('.three_options').fadeIn(200).offset({ top:offset.top , left:(offset.left-140) });
     
   
     var file_del = $(this).attr('id');
     $('#delete_per').click(function() {              
             $.ajax({
                 type: "GET",
                 url: "trash.php",
                 datatype: "html",
                 data: "filedel="+file_del,
                 success: function(data) {
                    if(data){
                      alert('File permanently deleted.');
                      $('.three_options').fadeOut(200);
                     location.reload();
                 
                    }else{
                     alert('Could not permanently delete file.');
                     $('.three_options').fadeOut(200);
                    }
                   }
               });
                
     });
});
  
  $(document).on('click','.three_dots2',function(e) {
            
    var offset = $(this).offset();
        $('.three_options2').fadeIn(200).offset({ top:offset.top , left:(offset.left-150) });
    
  
    var file_unstar = $(this).attr('id');
    $('#unstar').click(function() {              
            $.ajax({
                type: "GET",
                url: "starred.php",
                datatype: "html",
                data: "fileunstar="+file_unstar,
                success: function(data) {
                   if(data){
                     alert('File removed from favourites/Starred.');
                     $('.three_options').fadeOut(200);
                    location.reload();
                
                   }else{
                    alert('Could not remove file.');
                    $('.three_options').fadeOut(200);
                   }
                  }
              });
               
    });
    
  }); 
    
  $(document).mouseup(function(e) 
  {
      var container = $('.three-options');
      var container2 = $('.right-down');
      var container3 = $('.search-div-outer');
      var container4 = $('#search');
      // if the target of the click isn't the container nor a descendant of the container
      if (!container.is(e.target) && container.has(e.target).length === 0 && !$('#pop-up').is(e.target) && $('#pop-up').has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0 && !container3.is(e.target) && container3.has(e.target).length === 0 && !container4.is(e.target) && container4.has(e.target).length === 0) 
      {
          container.fadeOut(200);
          container2.fadeOut(200);
          if($('#search').html()!=''){
            container3.fadeOut(200);
          }
          $('#pop-up').fadeOut(200);
      }
  });