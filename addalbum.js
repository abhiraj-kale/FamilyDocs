$(document).on('click','#go-back-img' , function() {
    window.location.href = "http://localhost/projects/registration/home.php";
});

$(document).on('click' ,'.delete-inside',function(){ 
    var data = ($(this).attr('id'));
    var string = data.substring(0,data.lastIndexOf("/"));

    $.ajax({
        type: "post",
        url: "add-album.php",
        data: "data="+data ,
        success: function (response) {
                alert('Deleted');
               $.ajax({
                   type: "POST",
                   url: "add-album.php",
                   data: "folder_loc="+string,
                   success: function (response) {
                       console.log("String: "+string);
                       console.log(response);
                       $('.center-down').html(response);
                   }
               });         
    }
});
});