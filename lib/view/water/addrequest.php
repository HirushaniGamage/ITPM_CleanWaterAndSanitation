<div class="card border-success py-2 px-2">
    <h3>Make Request for Water Bowser Service</h3>
    <hr>
    <div class="row">
        <div class="col-7">
        <form id="addreqtForm"  enctype="multipart/form-data">
            <div class="form-group mt-2">
            <label for="">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                <input type="hidden" name="cby" id="uid" class="form-control" placeholder="Name">
            </div>
            <div class="form-group col-6 mt-2">
            <label for="">Phone Number</label>
                <input type="number" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="">Location Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Location Address">
            </div>
            <div class="form-group mt-2">
                <label for="">Near Plant Location</label>
                <select class="form-select" name="plants" id="plants">
                   
                </select>
            </div>
            <div class="form-group col-6 mt-2">
            <label for="">Request Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <label for="">Remark</label>
            <div class="form-group mt-2">
            <label for="">Request Capacity</label>
                <input type="number" name="capacity" id="capacity" class="form-control">
            </div>
            <div class="form-group mt-2">
            <label for="">Remark</label>
                <input type="text" name="remark" id="remark" class="form-control" placeholder="Remark">
            </div>
            <div class="form-group my-3 mt-2">
                <button id="btnAddreq" Onclick="return false" class="btn btn-success">Add Request</button>
            </div>
        </form>
        </div>
        <div class="col-5">
            <img src="../upload/ui/blog post-bro.png" alt="" style="width:100%;">
        </div>
    </div>
</div>
<script>
    $uid="";
    $uid = $("#userid").val();

    $.get("../routes/plant/getallplantsdrop.php", function (res) {
            //display data 
            $("#plants").html(res);
        })
    $("#uid").val($uid);

     $(document).on('click','#btnAddreq',function(e){
        
        //validation function
        var name  = $("#name").val();
        var number = $("#number").val();
        var address = $("#address").val();
        var plant = $("#plants").val();

        if(name == "" || number == "" || plant == "" || address == ""){
            Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'please fill all required fields',
                    showConfirmButton: false,
                    timer: 1500
                    })
        }else{
            
        e.preventDefault();
        var form = $("#addreqtForm")[0];

        var formData = new FormData(form);

        $.ajax({
            url:"../routes/water/addreq.php",
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

                    $("#name").val("");
                    $("#phone").val("");
                    $("#date").val("");
                    $("#capacity").val("");
                    $("#address").val("");
                    $("#plants").val("0");
                    $("#remark").val("");

                }else if(data == "02"){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'No water capacity in selected Plant',
                            showConfirmButton: false,
                            timer: 1500
                            })
                }else if(data == "03"){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'There are no available capacity to the date',
                            showConfirmButton: false,
                            timer: 1500
                            })
                }
                else if(data == "07"){
                   Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something Wrong',
                    showConfirmButton: false,
                    timer: 1500
                    })
                }
            },
            error: function (data) {
                swal.fire(data);
            }
            
        });
    }
    });
</script>