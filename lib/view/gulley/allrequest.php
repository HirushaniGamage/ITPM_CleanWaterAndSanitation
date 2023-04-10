<div class="card-body">
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
                    <td>Date</td>
                    <td>Remark</td>
                    <td>Name</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="emp_list">
                
            </tbody>
        </table>
    </div>
    
    <script>
            $uid="";
            $uid = $("#userid").val();
            $("#uid").val($uid);
         $(document).ready(function(){
        $('#edit').hide();
        
        //send an ajax request at loading employers
        $id =$("#userid").val();
        $.get("../routes/gulley/req_listadmin.php",{}, function (res) {
        //display data 
        $("#emp_list").html(res);
        })

        //search emp 
        $("#search_emp").on('input',function(){
            $inputData = $(this).val();

            //send an ajax request 
            $.get("../routes/gulley/reqsearchadmin.php",{
                searchData:$inputData},function(res){
                $("#emp_list").html(res);
            })
        })
    })

    function declare(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do You want to declare this request!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, declare it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/gulley/declare.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Request Declare Successfully.',
                    'success'
                    )

                    $id =$("#userid").val();
                    $.get("../routes/gulley/req_listadmin.php", function (res) {
                    //display data 
                    $("#emp_list").html(res);
                    })

                }
                else if (res="no"){
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not declare this request.',
                    'error')
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not declare request.',
                    'error')
                }
            })
        }
        });
     }


     function date(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do You want request new date for this job!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, request it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/gulley/date.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Request Successfully.',
                    'success'
                    )

                    $id =$("#userid").val();
                    $.get("../routes/gulley/req_listadmin.php", function (res) {
                    //display data 
                    $("#emp_list").html(res);
                    })

                }
                else if (res="no"){
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not request.',
                    'error')
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not request now.',
                    'error')
                }
            })
        }
        });
     }

     function Accept(oid){
        Swal.fire({
            icon: 'warning',
            title: 'Submit Job Price and Conform',
            input: 'number',
            id:"rangec",
            inputValue: 0.00,
            showCancelButton: true,
            confirmButtonText: 'Accept Job',
            showLoaderOnConfirm: true,
            preConfirm: function(value) {
                $.get("../routes/gulley/adminaccept.php",{
                uid:oid,
                price:value
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Request Declare Successfully.',
                    'success'
                    )

                    $id =$("#userid").val();
                    $.get("../routes/gulley/req_listadmin.php", function (res) {
                    //display data 
                    $("#emp_list").html(res);
                    })

                }
                else if (res="no"){
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not declare this request.',
                    'error')
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not declare request.',
                    'error')
                }
            })
            }
        })
     }
    </script>