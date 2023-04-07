<div class="container">
<div class="row">
    <div class="col-4"><h4>Edit Plant Data</h4></div>
    <div class="col-3">Select Plant name</div>
    <div class="col-5"div class="form-group col-md-6 mt-2">
                <select class="form-select" name="plants" id="plants">
                   
                </select>
            </div></div>
</div>
<div class="container py-4 px-3" id="containt">
<div class="card border-info py-3 px-3">

<div class="col" id="adminloadContent">
    <div class="row">
        <div class="col-6" style=" display: block;    height: 90vh; overflow-y: scroll;">
            <div class="card border-success mb-3" style="max-width: 100%;">
                <div class="card-header">
                    <h5>Submit Monthly Enargy Data</h5>
                </div>
                <div class="card-body">
                    <form id="adddataForm" enctype="multipart/form-data">
                        <input class="form-control mx-1 my-1" type="hidden" value="" id="plant_id" name="plant_id">
                         <input class="form-control mx-1 my-1" type="hidden" value="" id="id" name="id">
                        <div class="form-group mt-3">
                            <label>Selected Month </label>
                            <div class="col-6">
                                <input type="month" class="form-control" id="date" name="date">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Energy Consumption (kWh)</label>
                            <input type="number" name="energyconsumption" onchange="cal()"
                                id="energyconsumption" class="form-control"
                                placeholder="kilo watt hours (kWh)">
                        </div>
                        <div class="form-group mt-3">
                            <label>Energy Consumption Cost (LKR)</label>
                            <div class="col-6">
                                <input type="number" required value="0" onchange="cal()"
                                    class="form-control" id="energyconsumptioncost"
                                    name="energyconsumptioncost">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Maximum Demand (kVa)</label>
                            <input type="number" name="maximumdemand" onchange="cal()"
                                id="maximumdemand" class="form-control"
                                placeholder="Kilo-volt-amperes (kVa)">
                        </div>
                        <div class="form-group mt-3">
                            <label>Maximum Demand Cost (LKR)</label>
                            <div class="col-6">
                                <input type="number" onchange="cal()" required value="0"
                                    class="form-control" id="maximumdemandcost"
                                    name="maximumdemandcost">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Total Cost (LKR)</label>
                            <div class="col-6">
                                <input type="number" required value="0" class="form-control"
                                    id="totalcost" name="totalcost">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Monthly Production (m3)</label>
                            <div class="col">
                                <input type="number" onchange="cal()" class="form-control"
                                    id="monthlyproduction" name="monthlyproduction"
                                    placeholder="Cubic meter (m3)">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mt-3">
                            <label>Specific Energy Consumption (SEC)</label>
                            <div class="col">
                                <input type="number" class="form-control"
                                    id="specificenergyconsumption" name="specificenergyconsumption"
                                    placeholder="kilo watt hours perCubic meter (kWhm3)">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <button id="btnAdddata" onclick=' return false;' class="btn btn-success">Submit Data</button>
                            <button id="btnEditata" onclick=' return false;' class="btn btn-success">Edit Data</button>
                            <button id="new" onclick=' return false;' class="btn btn-success">New</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-6" style=" display: block;    height: 100%; overflow-y: scroll;">
            <div class="card border-warning mb-3" style="max-width: 100%;">
                <div class="card-header">
                    <h5>previous records</h5>
                </div>
                <div class="card-body" id="container">

                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
<script>

$("#btnEditata").hide();
        $("#new").hide();



     $(document).on('click', '#btnEditata', function (e) {
        e.preventDefault();
       if($("#date").val()=="" || $("#date").val()=="" || $("#energyconsumption").val()=="" || $("#energyconsumptioncost").val()=="" || $("#maximumdemand").val()=="" || $("#monthlyproduction").val()=="" ||$("#specificenergyconsumption").val()=="" )
       {
        Swal.fire(
            'required field?',
            'please fill all input fields',
            'question'
            );
       }
       else{
        $.ajax({
            url: "../routes/plant/editmrecods.php",
            type: "post",
            data: $("#adddataForm").serialize(),
            success: function (res) {
                if(res== '03'){
                    Swal.fire(
                    'Error!',
                    'You used edit methord to add New Data',
                    'error'
                    )
                }else if(res == '02'){
                    Swal.fire(
                    'Something went wrong!',
                    'please try again later',
                    'error'
                    )
                } else if(res == '01'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your Edit has been saved',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        
                        $("#date").val("");
                        $("#id").val("");
                        $("#energyconsumption").val("");
                        $("#energyconsumptioncost").val("");
                        $("#maximumdemand").val("");
                        $("#maximumdemandcost").val("");
                        $("#totalcost").val("");
                        $("#monthlyproduction").val("");
                        $("#specificenergyconsumption").val("");

                        $("#btnAdddata").show();
                        
                        $("#btnEditata").hide();

                        $.get("../routes/plant/getalldata.php", {
                            uid: $("#plant_id").val()
                            },
                            function (res) {
                                $("#container").html(res);
                            });
                }
            },
            error: function (data) {
                alert(data);
            }

        });
    }
    });

    $(document).on('click', '#btnAdddata', function (e) {
        e.preventDefault();
        if($("#plant_id").val()==""){
            Swal.fire(
            'required field?',
            'please Select Plant First',
            'question'
            );
        }else{
       if($("#date").val()=="" || $("#date").val()=="" || $("#energyconsumption").val()=="" || $("#energyconsumptioncost").val()=="" || $("#maximumdemand").val()=="" || $("#monthlyproduction").val()=="" ||$("#specificenergyconsumption").val()=="" )
       {
        Swal.fire(
            'required field?',
            'please fill all input fields',
            'question'
            );
       }
       else{
        $.ajax({
            url: "../routes/plant/addmrecods.php",
            type: "post",
            data: $("#adddataForm").serialize(),
            success: function (res) {
                if(res== '03'){
                    Swal.fire(
                    'Already submitted!',
                    'This Month Data was Already Added',
                    'error'
                    )
                }else if(res == '02'){
                    Swal.fire(
                    'Something went wrong!',
                    'please try again later',
                    'error'
                    )
                } else if(res == '01'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        $("#id").val("");
                        $("#energyconsumption").val("");
                        $("#energyconsumptioncost").val("");
                        $("#maximumdemand").val("");
                        $("#maximumdemandcost").val("");
                        $("#totalcost").val("");
                        $("#monthlyproduction").val("");
                        $("#specificenergyconsumption").val("");
                }

                $.get("../routes/plant/getalldata.php", {
                uid: $("#plant_id").val()
            },
            function (res) {
                $("#container").html(res);
            });

            },
            error: function (data) {
                alert(data);
            }

        });
    }
}
    });

    $.get("../routes/plant/getallplantsdrop.php", {
        }, function (res1) {
            $("#plants").html(res1);

        })

        $("#plants").on('change', function () {
        $cat = $(this).val();

        $("#plant_id").val($cat);

        $.get("../routes/plant/getalldata.php", {
                uid: $("#plant_id").val()
            },
            function (res) {
                $("#container").html(res);
            });

        $.get("../routes/products/getprodroplist.php", {
            cat: $cat
        }, function (res1) {
            $("#productlist").html(res1);

        })
    })

    $(document).on('click', '#new', function (e) {
        e.preventDefault();
        $("#btnAdddata").show();
        $("#btnEditata").hide();
        $("#new").hide();
        $("#date").val("");
                        $("#id").val("");
                        $("#energyconsumption").val("");
                        $("#energyconsumptioncost").val("");
                        $("#maximumdemand").val("");
                        $("#maximumdemandcost").val("");
                        $("#totalcost").val("");
                        $("#monthlyproduction").val("");
                        $("#specificenergyconsumption").val("");
    });

    function getdetails($id){
        $.get("../routes/plant/getplantrecdata.php", {
                id: $id
            }, function (res) {
                var jdata = jQuery.parseJSON(res);
                $year= jdata.year;
                $month= jdata.month.padStart(2, '0');
                $date=$year+'-'+$month;              
                $("#date").val($date);
                $("#id").val(jdata.id);
                $("#energyconsumption").val(jdata.energyconsumption);
                $("#energyconsumptioncost").val(jdata.energyconsumptioncost);
                $("#maximumdemand").val(jdata.maximumdemand);
                $("#maximumdemandcost").val(jdata.maximumdemandcost);
                $("#totalcost").val(jdata.totalcost);
                $("#monthlyproduction").val(jdata.monthlyproduction);
                $("#specificenergyconsumption").val(jdata.specificenergyconsumption);
            })
            $("#btnAdddata").hide();
            $("#btnEditata").show();
            $("#new").show();
    }

    function cal() {
        $mec = 0;
        $mecc = 0;
        $md = 0;
        $mdc = 0;
        $tc = 0;
        $mp = 0;
        $sec = 0;
        if ($("#energyconsumption").val() == "" || $("#energyconsumption").val() == 0) {
            $mec = 0;
        } else {
            $mec = $("#energyconsumption").val();
        }
        if ($("#energyconsumptioncost").val() == "" || $("#energyconsumptioncost").val() == 0) {
            $mecc = 0;
        } else {
            $mecc = $("#energyconsumptioncost").val();
        }
        if ($("#maximumdemand").val() == "" || $("#maximumdemand").val() == 0) {
            $md = 0;
        } else {
            $md = $("#maximumdemand").val();
        }
        if ($("#maximumdemandcost").val() == "" || $("#maximumdemandcost").val() == 0) {
            $mdc = 0;
        } else {
            $mdc = $("#maximumdemandcost").val();
        }
        if ($("#monthlyproduction").val() == "" || $("#monthlyproduction").val() == 0) {
            $mp = 0;
        } else {
            $mp = $("#monthlyproduction").val();
        }

        $tc = parseInt($mecc) + parseInt($mdc);
        $sec =(parseInt($mec) / parseInt($mp)).toFixed(3);
        // $("#totalcost").val($tc);
        if ($mec == 0 || $mp == 0) {
            $("#specificenergyconsumption").val("0");
        } else {
            $("#specificenergyconsumption").val($sec);
        }
    }

</script>