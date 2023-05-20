$(document).ready(function(){
  
    //lode user image, name and jobtitel
    $.get("../routes/emp/show_current_user.php", function (res) {
        //display data 
        $("#show_current_user").html(res);
      });

    
      
    $('#admin_product_count').load('../routes/users/usercount.php');
    

    //load content to page
    $('#add_employer').click(function(){
        $('#adminloadContent').load('emp/addemployer.php');
    });
    
    $('#edit_employer').click(function(){
      $('#adminloadContent').load('emp/editemployer.php');
     });

    $('#add_Customer').click(function(){
        $('#adminloadContent').load('user/adduser.php');
    });

    $('#edit_Customer').click(function(){
      $('#adminloadContent').load('user/edit_user.php');
    });

    $('#activate_Customer').click(function(){
      $('#adminloadContent').load('user/activate_user.php');
    });

    $('#edit_plantdata').click(function(){
      $('#adminloadContent').load('plant/plant_data.php');
    });

    $('#sendemail').click(function(){
      $('#adminloadContent').load('email/sendemail.php');
    });


});

