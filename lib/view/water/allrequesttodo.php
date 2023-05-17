<div class="card border-warning py-2 px-2">
    <div class="row my-2 px-5 mx-5">
    <label for="">Select Plant Location</label>
                <select class="form-select" name="plants" id="plants">
                   
                </select>
    </div>
    <hr>
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

            $.get("../routes/plant/getallplantsdrop.php", function (res) {
            //display data 
            $("#plants").html(res);
        })

        $("#plants").on('change',function(){
            $inputData = $(this).val();
            $.get("../routes/water/todo_listadmin.php",{
                    plant:$inputData},function(res){
                    $("#emp_list").html(res);
                })
        })
       
        
        $("#search_emp").on('input',function(){
           
           if($("#plants").val() == "0"){
                    Swal.fire(
                        'Somethin Wrong',
                        'Please Select the location first.',
                        'error');
                        $("#search_emp").val("");
           }else{
            $inputData = $(this).val();
            $inputData1 = $("#plants").val();
                //send an ajax request 
                $.get("../routes/water/reqsearchadmin.php",{
                    plant:$inputData1, searchData:$inputData},function(res){
                    $("#emp_list").html(res);
                })
           }
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
                $.get("../routes/water/adminstart.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Job start Successfully.',
                    'success'
                    )
                    $inputData = $("#plants").val();
                    $.get("../routes/water/todo_listadmin.php",{
                    plant:$inputData},function(res){
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
                $.get("../routes/water/adminend.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
                    Swal.fire(
                    'Successful!',
                    'Your Job end Successfully.',
                    'success'
                    )

                    $inputData = $("#plants").val();
                    $.get("../routes/water/todo_listadmin.php",{
                    plant:$inputData},function(res){
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