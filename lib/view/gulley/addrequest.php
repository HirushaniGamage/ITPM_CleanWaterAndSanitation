<div class="">
    <h3>Make Request for Gulley Service</h3>
    <hr>
    <div class="row">
        <div class="col-7">
        <form id="addreqtForm"  enctype="multipart/form-data">
            <div class="form-group mt-2">
            <label for="">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group col-6 mt-2">
            <label for="">Phone Number</label>
                <input type="number" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group mt-2">
            <input class="form-control mx-1 my-1" type="hidden" value="<?php
                                                        //chek the user session
                                                    if(empty($_SESSION['user_id'])){}
                                                    else{print_r($_SESSION['user_id']);}?>" id="userid" name="cby">
                <label for="">Location Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Location Address">
            </div>
            <div class="form-group col-6 mt-2">
            <label for="">Request Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group mt-2">
            <label for="">Remark</label>
                <input type="text" name="remark" id="remark" class="form-control" placeholder="Remark">
            </div>
            <div class="form-group my-3 mt-2">
                <button id="btnAddreq" class="btn btn-success">Add Request</button>
            </div>
        </form>
        </div>
        <div class="col-5">
            <img src="../upload/ui/blog post-bro.png" alt="" style="width:100%;">
        </div>
    </div>
</div>
<script>
     $(document).on('click','#btnAddreq',function(e){
        e.preventDefault();
        var form = $("#addreqtForm")[0];

        var formData = new FormData(form);

        $.ajax({
            url:"../routes/gulley/addreq.php",
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                if(data == "01"){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Request added Successfully!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'error')
                }
                 
                $("#name").val("");
                $("#phone").val("");
                $("#date").val("");
                $("#address").val("");
                $("#remark").val("");

            },
            error: function (data) {
                swal.fire(data);
            }
            
        });
    });
</script>