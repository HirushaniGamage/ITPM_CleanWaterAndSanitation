$(document).ready(function () {

    $('#btnSave').click(function (e) {
        e.preventDefault();
        
        //get the name input value
        $name = $("#userName1").val();
        //get the Email input value
        $email = $("#userEmail").val();
        //fetch phone number value
        $phone = $("#userPhone").val();
        //fetch pwd value
        $pwd = $("#userPwd1").val();
        //fetch pwd value
        $repwd = $("#reuserPwd").val();

        //validation rule
        if ($name.length == "" || $email.length == "" || $pwd.length == "" || $repwd.length == "" || $phone.length < 10) {
            Swal.fire({
                icon: 'info',
                text: 'Please Check the inputs and try again!',
            });
            
        }
         else {
             if($pwd == $repwd)
             {

                //late use ajax request to send the data
                $.ajax({
                    url: "lib/routes/users/register.php",
                    type: "post",
                    data: $("#registrationForm").serialize(),
                    success: function (res) {
                        if( res == "01"){
                            Swal.fire({
                                icon: 'success',
                                text: 'Successfully Regeisterd!',
                            });
                            $("#userName1").val("");
                            $("#userEmail").val("");
                            $("#userPhone").val("");
                            $("#userPwd1").val("");
                            $("#reuserPwd").val("");
                        }
                        else if( res =="04"){
                            Swal.fire({
                                icon: 'info',
                                text: 'Email account already exists',
                            });
                        }
                        else if( res =="02"){
                            Swal.fire({
                                icon: 'info',
                                text: 'Please Check the inputs and try again!',
                            });
                        }
                        else{
                            Swal.fire({
                                icon: 'info',
                                text: 'Please Try again later!',
                            });
                        }
                    }
                })
            }
            else{
                $("#repwd_errorMsg").html("Password mismatch");
            }
         }

    })
})