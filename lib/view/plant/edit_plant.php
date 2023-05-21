<div class="card border-danger">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h5>Edit Plant data</h5>
            </div>
            <siv class="col-6">
                <input class="form-control mx-1 my-1" type="search" name="searchData" id="search_user"
                    placeholder="Search user">
            </siv>
        </div>
        <hr>

        <table class="table table-hover" id="userlist">
            <thead>
                <tr class="table-success">
                    <th scope="row">Plant Id</th>
                    <td>Plant Location Name</td>
                    <td>Daily Capacity of the Plant</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="plant_list">

            </tbody>
        </table>

        <div class="card px=2 my-2" id=userdata>
            <div class="form-group py-1 ">
                <label for="staticEmail" class="col-form-label px=2 my-2">Plant Location Name</label>
                <input type="hidden" id="id" class="form-control ">
                <input type="text" id="userName" class="form-control ">
            </div>
            <div class="form-group mt-1">
                <label for="staticEmail" class="col-form-label">Daily Capacity</label>
                <input type="number" id="Capacity" class="form-control">
            </div>
            
            <div class="form-group my-2">
                <button class="btn btn-success" onclick="edit()">Edit Data</button>

                <button class="btn btn-secondary" onclick="backlist()">Plant List</button>
            </div>

        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $('#userdata').hide();
        //send an ajax request at loading employers
        $.get("../routes/plant/plant_list.php", function (res) {
            //display data 
            $("#plant_list").html(res);
        })

        //search emp 
        $("#search_user").on('input', function () {
            $inputData = $(this).val();

            //send an ajax request 
            $.get("../routes/plant/plantsearch.php", {
                searchData: $inputData
            }, function (res) {
                $("#plant_list").html(res);
            })
        })

    })

    function deleteuser(oid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do You want to delete this Plant permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get("../routes/plant/delete_plant.php", {
                    uid: oid
                }, function (res) {
                    if (res = "ok") {
                        Swal.fire(
                            'Successful!',
                            'Your Deleted Plant.',
                            'success'
                        )
                        //reload list
                        $.get("../routes/plant/plant_list.php", function (res) {
            //display data 
            $("#plant_list").html(res);
        })

                    } else {
                        Swal.fire(
                            'Somethin Wrong',
                            'Can not delete plant.',
                            'error')
                    }
                })
            }
        });
    }

    function editacc(uid) {
        $userid = uid;

        $('#userlist').hide();
        $('#userdata').show();

        $.get("../routes/plant/getplantdata.php", {
            uid: uid
        }, function (res) {
            var jdata = jQuery.parseJSON(res);
            $("#id").val(jdata.id);
            $("#userName").val(jdata.name);
            $("#Capacity").val(jdata.Capacity);

        })
    }

    function backlist() {
        $('#userlist').show();
        $('#userdata').hide();
    }

    function edit() {
        $uid = $("#id").val();
        $name = $("#userName").val();
        $capacity = $("#Capacity").val();

        Swal.fire({
            title: 'Are you sure?',
            text: "Did You want to edit this plant details!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Edit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get("../routes/plant/editdata.php", {
                    id: $uid,
                    un: $name,
                    em: $capacity
                }, function (res) {
                    if (res = "ok") {
                        Swal.fire(
                            'Successful!',
                            'Your Edit Done.',
                            'success'
                        )
                        $('#userlist').show();
                        $('#userdata').hide();
                        $.get("../routes/plant/plant_list.php", function (res) {
            //display data 
            $("#plant_list").html(res);
        })
                    } else {
                        Swal.fire(
                            'Somethin Wrong',
                            'Can not edit data.',
                            'error')
                        $('#userlist').show();
                        $('#userdata').hide();
                    }

                })
            }
        });
    }
</script>