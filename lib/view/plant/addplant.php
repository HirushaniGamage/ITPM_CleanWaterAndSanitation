<div class="card border-success">
    <div class="card-body">
        <h5>Add New Plant</h5>
        <hr>
        <div class="row">
            <div class="col-7">
            <form id="registrationForm">
            <div class="form-group py-3">
                <label for="name">Plant Location Name</label>
                <input type="text" class="form-control" id="name" name="name">
                
            </div>
            <div class="form-group mt-3">
            <label for="name">Daily Capacity</label>
                <input type="number" name="Capacity" id="Capacity" class="form-control"
                    placeholder="Enter Plant Capacity">
                
            </div>
            <div class="form-group mt-3">
                <button class="btn btn-success" id="btnSave">Create Plant Location</button>
                <input type="reset" value="clear" class="btn btn-ontline-warning">
            </div>
        </form>
            </div>
            <div class="col-5">
                <img src="../upload/ui/Factory-rafiki.png" alt="" style="width:70%;">
            </div>
        </div>
       
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#btnSave').click(function (e) {
            e.preventDefault();

            $.ajax({
                        url: "../routes/plant/addplant.php",
                        type: "post",
                        data: $("#registrationForm").serialize(),
                        success: function (res) {
                            if (res == "1") {
                                //clear input fields
                                $("#name").val("");
                                $("#Capacity").val(0);

                                Swal.fire({
                                    icon: 'success',
                                    text: 'Successfully added',
                                });
                            } else if (res == "2") {
                                Swal.fire({
                                    icon: 'info',
                                    text: 'Alredy Exists',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    text: 'Please Try again later!',
                                });
                            }
                        }
                    })
        })
    })
</script>