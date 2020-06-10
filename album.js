
$(document).ready(function() {
    $('.album').ready(function() {
        
    });
});


$('.album').first().click(function () {
    
    var offset = $(this).offset();
    $('.album-options').fadeIn(200).offset({ top:offset.top-20 , left:offset.left+100 });
    $('#new-name-submit').click(function() {
        var album_name =$('#new-album-name').val();
        $('.album-options').fadeOut(200);
        $.ajax({
            type: "POST",
            url: 'createalbum.php',
            data: "albumname="+album_name,
            success: function(response) {
                $('.album').first().after(response);
            }
          });
    });

});

$(document).on('click' ,'.album-image:not(:first)', function() {
    var folder_loc = $(this).parent().attr('id');
    
    $.ajax({
        type: "POST",
        url: "add-album.php",
        data: "folder_loc="+folder_loc,
        success: function (response) {
            $('.recents-table').html(response);    
        }
    });
});

$(document).on('click' ,'.not-create',function(){

    var offset = $(this).offset();
    var not_create = $(this).parent().parent().find(".album-name").text();
    var parent_album = $(this).parent().parent();
    $('.delete-album').fadeIn(200).offset({ top:offset.top-20 , left:offset.left+20 });

    $('.delete-album').find('input[type=button]').click(function() {

        if($(this).val() == 'Yes'){
            $.ajax({
                type: "POST",
                url: "createalbum.php",
                data: "not_create="+not_create,
                success: function (response) {
                    if(response){
                        parent_album.fadeOut(200);
                        $('.delete-album').fadeOut(200);
                    }
                }
            });
            
        }else{
            $('.delete-album').fadeOut(200);
        }
    });
    
});

 $(document).mouseup(function(e){
var container = $('.album-options');
var container2 = $('.delete-album');
  
      // if the target of the click isn't the container nor a descendant of the container
      if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0) 
      {
          container.fadeOut(200);
          container2.fadeOut(200);
      }
});    