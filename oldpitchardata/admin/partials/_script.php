<!-- start js include path -->
<script src="assets/plugins/jquery/jquery.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="assets/plugins/popper/popper.min.js" ></script>
<script src="assets/plugins/jquery-blockui/jquery.blockui.min.js" ></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" ></script>
<!-- Common js-->
<script src="assets/js/app.js" ></script>
<script src="assets/js/layout.js" ></script>
<script src="assets/js/theme-color.js" ></script>
<!-- Material -->
<script src="assets/plugins/material/material.min.js"></script>
<script src="assets/js/pages/material_select/getmdl-select.js" ></script>
<script src="assets/plugins/material-datetimepicker/moment-with-locales.min.js"></script>
<script src="assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
<script  src="assets/plugins/material-datetimepicker/datetimepicker.js"></script>
<!-- animation -->
<script src="assets/js/pages/ui/animations.js" ></script>
<!-- dropzone -->

<!--datatable-->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js" ></script>
<script src="assets/js/pages/table/table_data.js" ></script>
<!--tags input-->
<script src="assets/plugins/jquery-tags-input/jquery-tags-input.js" ></script>
<script src="assets/plugins/jquery-tags-input/jquery-tags-input-init.js" ></script>
<!-- Swal -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- date Picker -->
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
<!-- main js -->
<script type="text/javascript" src="assets/js/mainJs.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('input').attr('autocomplete','off');

    setInterval(function () {
    $('#showMessage').load('partials/_msgs.php');
    var unreadMsg=$("#unreadMsg").val();
    $(".howmanyunread").html('New '+unreadMsg);

    if (unreadMsg > 0) {
    $(".noofunread").text(unreadMsg);
    }
    else{
    $(".noofunread").html('');
    }
    }, 1000);
    });
    function move(link){
    window.location = link;
    }
    /*number val;idation*/
    function validateName_onKeyPress_space(evt) {
    evt = $.event.fix(evt);
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode == 32) {
    return true;
    } else if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode >= 123) && charCode != 8) {
    evt.preventDefault();
    return false;
    }
    }
</script>
<!-- end js include path -->
<style type="text/css">
/*       .page-content
{
min-height: 800px !important;
}*/
</style>