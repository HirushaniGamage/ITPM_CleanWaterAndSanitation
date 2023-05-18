<div class="card border-info py-2 px-2">
        <div class="row">
            <div class="col-6">
                <h5>All Request List</h5>
                <input type="hidden" name="cby" id="uid" class="form-control" placeholder="Name">
            </div>
            <div class="col-6">
                <input class="form-control mx-1 my-1" type="search" name="searchData" id="search_emp" placeholder="Search Request">
            </div>
        </div>
        <hr>
        <div id="list">
        <table class="table table-hover">
            <thead>
                <tr class="table-success">
                    <th scope="row">Request Id</th>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Capasity</td>
                    <td>Price</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="emp_list">
                
            </tbody>
        </table>
    </div>
    <div id="edit">
    <div class="form-group py-1 ">
    <form id="addreqtForm" >
            <div class="form-group mt-2">
            <label for="">Name</label>
                <input type="hidden" name="id" id="id" class="form-control" placeholder="Name">
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
            <div class="form-group col-6 mt-2">
            <label for="">Request Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group mt-2">
            <label for="">Request Capacity</label>
                <input type="number" name="capacity" id="capacity" class="form-control">
            </div>
            <div class="form-group mt-2">
            <label for="">Remark</label>
                <input type="text" name="remark" id="remark" class="form-control" placeholder="Remark">
            </div>
            <div class="form-group my-2">
                            <button class="btn btn-success" onclick="edit(); return false;">Edit Data</button>

                            <button class="btn btn-secondary" onclick="backlist(); return false;">Request List</button>
                        </div>
        </form>
</div>
    </div>
    <script>
            $uid="";
            $uid = $("#userid").val();
            $("#uid").val($uid);
         $(document).ready(function(){
        $('#edit').hide();
        
        //send an ajax request at loading employers
        $id =$("#userid").val();
        $.get("../routes/water/req_list.php",{
            id:$id
        }, function (res) {
        //display data 
        $("#emp_list").html(res);
        })

        //search emp 
        $("#search_emp").on('input',function(){
            $inputData = $(this).val();

            //send an ajax request 
            $.get("../routes/water/reqsearch.php",{
                searchData:$inputData,
                id: $id},function(res){
                $("#emp_list").html(res);
            })
        })
    })

    function delete_req(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do You want to delete this request permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/water/delete_water.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Request Delete Successfully.',
                    'success'
                    )

                    $id =$("#userid").val();
                    $.get("../routes/water/req_list.php",{
                        id:$id
                    }, function (res) {
                    //display data 
                    $("#emp_list").html(res);
                    })

                }
                else if (res="no"){
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not delete this request.',
                    'error')
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not delete request.',
                    'error')
                }
            })
        }
        });
     }

     function backlist(){
        $('#list').show();
        $('#edit').hide();
     }

     function editreq(uid){
         $userid = uid;

        $('#list').hide();
        $('#edit').show();

        $.get("../routes/water/getreqdata.php", {
        uid:uid
        }, function (res) {
        var jdata = jQuery.parseJSON(res);
            $("#id").val(jdata.id);
            $("#name").val(jdata.name);
            $("#uid").val(jdata.user_id);
            $("#phone").val(jdata.phone);
            $("#address").val(jdata.address);
            $("#capacity").val(jdata.capacity);
            $("#date").val(jdata.date);
            $("#remark").val(jdata.remark);
           
        })
     }


        
     function edit(){
            $id = $("#id").val();
            $name = $("#name").val();
            $phone = $("#phone").val();
            $address = $("#address").val();
            $date = $("#date").val();
            $remark = $("#remark").val();
            $userid = $("#uid").val();
            $cp = $("#capacity").val();

        Swal.fire({
        title: 'Are you sure?',
        text: "Did You want to edit this Request details!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Edit it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/water/editdata.php",{
                id: $id,
                un: $name,
                ph: $phone,
                add: $address,
                da: $date,
                rk: $remark,
                ui: $userid,
                cp: $cp
            },function (res) {
                if(res="ok"){
            Swal.fire(
            'Successful!',
            'Your Edit Done.',
            'success'
            )
            $('#list').show();
            $('#edit').hide();

             //send an ajax request at loading employers
             $id =$("#userid").val();
                    $.get("../routes/water/req_list.php",{
                        id:$id
                    }, function (res) {
                    //display data 
                    $("#emp_list").html(res);
                    })
                }
                else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not edit data.',
                    'error')
                    $('#list').show();
                    $('#edit').hide();
                }
               
            })
        }
        });
    }

    function feedback(id) {
            Swal.fire({
                icon:'question',
                title: 'feedback for This Job',
                input: 'text',utValue: 2,
                showCancelButton: true,
                confirmButtonText: 'Rate Now',
                showLoaderOnConfirm: true,
                preConfirm: function (value) {
                    $.get("../routes/water/feedback.php", {
                            id: id,
                            rate: value
                        }, function (res) {
                            if (res = "ok") {

                                Swal.fire(
                                    'Rated!',
                                    'You feedback Sucessfully.',
                                    'success'
                                )

                            } else {
                                Swal.fire(
                                    'Somethin Wrong',
                                    'You cant feedback now.',
                                    'error')
                            }

                        }

                    )
                }
            }).then((result) => {
                if (result.isConfirmed) {}
            })
        }

        function bill($oid){
  window.open("invoice/waterprint.php?id="+$oid+"",
                    " Aqua Guard", "width=600, height=600");
}


    </script>