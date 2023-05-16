<div class="card border-danger py-2 px-2">
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
                    <td>Name</td>
                    <td>Phone</td>
                    <td>feedback</td>
                </tr>
            </thead>
            <tbody id="emp_list">
                
            </tbody>
        </table>
    </div>
    
    <script>
         
         $(document).ready(function(){
       
        $.get("../routes/gulley/feedback_listadmin.php",{}, function (res) {
        //display data 
        $("#emp_list").html(res);
        })

    })

    </script>