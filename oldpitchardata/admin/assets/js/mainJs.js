
/*Add Promo Code*/

    $(document).ready(function (e) {
        $('#addPromoCode').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: 'php/auth.php',
                data:formData,
                cache:false,
                dataType:'json',
                contentType: false,
                processData: false,
                success:function(data){
                    if (data.response.code=='1') {
                        $("#promocode").html("Submitting..");
                        $("#promocode").attr('readonly','true');
                        setTimeout(function(){ window.location.href="view-promocode.php"; }, 3000);
                    }
                    if (data.response.code=='0') {
                        $("#promocode").html("Submitting..");
                        setTimeout(function(){ swal("Oh Snap",data.response.msg,"error");
                        $("#promocode").html("Create"); }, 1000);
                        

                       
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));

});



/*Delete Promo Code*/

$(".deletepromocode").click(function() {
            var token=$(this).val();
            var id=$(this).data("id");
            swal({
              title: "Are you sure?",
              text: "want to delete this Promo code!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: 'php/auth.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {deletePromoCode:token},
                })
                .done(function(data) {  
                    if (data.response.code=='1') {
                        swal(data.response.msg, {
                         icon: "success",
                        });
                        $(".cls"+id).hide('slow');
                    }
                    if (data.response.code=='0') {
                        swal(data.response.msg, {
                         icon: "error",
                        });
                    }
             
                })
              } else {
                swal("Your imaginary file is safe!");
              }
            });
        });



/*Edit Promo Code*/

    $(document).ready(function (e) {
        $('#editPromoCode').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: 'php/auth.php',
                data:formData,
                cache:false,
                dataType:'json',
                contentType: false,
                processData: false,
                success:function(data){
                    if (data.response.code=='1') {
                        $("#promocode").html("Submitting..");
                        $("#promocode").attr('disabled','true');
                        setTimeout(function(){ window.location.href="view-promocode.php"; }, 3000);
                    }
                    if (data.response.code=='0') {
                        $("#promocode").html("Submitting..");
                        setTimeout(function(){ swal("Oh Snap",data.response.msg,"error");
                        $("#promocode").html("Create"); }, 1000);
                        

                       
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));

});


/*Send Email For Gift Card*/

$("body").on('submit', '#sendgiftPromoCode', function(event) {
    event.preventDefault();
    var formdata=new FormData(this);
    $.ajax({
        url: 'php/auth.php',
        type: 'POST',
        dataType: 'json',
        data: formdata,
        contentType:false,
        processData:false,
        cache:false
    })
    .done(function(data) {
         if (data.response.code=='1') {
                $("#promocode").html("Submitting..");
                $("#promocode").attr('disabled','true');
                swal("Done!",data.response.msg,"success");
                setTimeout(function(){ window.location.href="view-giftpromocode.php"; }, 3000);
             }
             if (data.response.code=='0') {
                $("#promocode").html("Submitting..");
                setTimeout(function(){ swal("Oh Snap",data.response.msg,"error");
                $("#promocode").html("Create"); }, 1000);
             }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function(data) {
        console.log(data);
    });
}); 


/*Delete Gift Promo Code*/

$(".deletegiftpromocode").click(function() {
            var token=$(this).val();
            var id=$(this).data("id");
            swal({
              title: "Are you sure?",
              text: "want to delete this Promo code!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: 'php/auth.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {deleteGiftPromoCode:token},
                })
                .done(function(data) {  
                    if (data.response.code=='1') {
                        swal(data.response.msg, {
                         icon: "success",
                        });
                        $(".cls"+id).hide('slow');
                    }
                    if (data.response.code=='0') {
                        swal(data.response.msg, {
                         icon: "error",
                        });
                    }
             
                })
              } else {
                swal("Your imaginary file is safe!");
              }
            });
        });