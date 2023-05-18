<div class="card border-warning py-2 px-2">
        <div class="row">
            <div class="col-6">
                <h5>All Jobs to do</h5>
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
         
         $(document).ready(function(){
       
        $.get("../routes/gulley/todo_listadmin.php",{}, function (res) {
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

    function start(oid){
        Swal.fire({
            icon: 'warning',
            title: 'Do you want to Start Job',
            showCancelButton: true,
            confirmButtonText: 'start Job',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                $.get("../routes/gulley/adminstart.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Job start Successfully.',
                    'success'
                    )

                    $.get("../routes/gulley/todo_listadmin.php",{}, function (res) {
                        //display data 
                        $("#emp_list").html(res);
                        })

                }
                else if (res="no"){
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not start Job.',
                    'error')
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not start Job.',
                    'error')
                }
            })
            }
        })
     }

     function end(oid){
        Swal.fire({
            icon: 'warning',
            title: 'Do you want to end Job',
            showCancelButton: true,
            confirmButtonText: 'end Job',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                $.get("../routes/gulley/adminend.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Job end Successfully.',
                    'success'
                    )

                    $.get("../routes/gulley/todo_listadmin.php",{}, function (res) {
                        //display data 
                        $("#emp_list").html(res);
                        })

                }
                else if (res="no"){
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not emd Job.',
                    'error')
                }else{
                    Swal.fire(
                    'Somethin Wrong',
                    'You can not end Job.',
                    'error')
                }
            })
            }
        })
     }
    </script>