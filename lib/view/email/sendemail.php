<div class="container">
<div class="card border-info py-3 px-3">
    <div class="row">
        <div class="col-4">
            <h4>Send Email</h4>
        </div>
        <div class="col-3">Select Plant name</div>
        <div class="col-5" div class="form-group col-md-6 mt-2">
            <select class="form-select" name="plants" id="plants">

            </select>
        </div>
    </div>

<div class="container py-4 px-3" id="containt">
<textarea class="form-control" id="exampleTextarea" rows="5"></textarea>
<div class="align-self-end py-3">
<button type="button" class="btn btn-success" id="sendemail" style="margin-left:auto; margin-right:0;">Send Email</button>
</div>
    </div>
    </div>
</div>
<script>
     $.get("../routes/plant/getallplantsdropemail.php", {
        }, function (res1) {
            $("#plants").html(res1);

        })

        $(document).on('click', '#sendemail', function (e) {
        e.preventDefault();
        if($("#exampleTextarea").val()=="" || $("#plants").val()=="0")
       {
        Swal.fire(
            'required field?',
            'please fill Content or Select Plant first',
            'question'
            );
       }
       else{
        $.post("../routes/plant/sendemail.php", {
            email: $("#plants").val(),
            content: $("#exampleTextarea").val()
        }, function (res1) {
           if(res1 = "Message has been sent"){
            Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your Email has been send',
  showConfirmButton: false,
  timer: 1500
})
           }else{
            Swal.fire(
  'Something Wrong?',
  'Can not Send Ypur Email?',
  'question'
)
           }

        })
       }
    });

</script>