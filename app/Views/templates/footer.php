<!-- ===== jQuery ===== -->
<script src="<?= site_url() ?>/plugins/components/jquery/dist/jquery.min.js"></script>
<!-- ===== Bootstrap JavaScript ===== -->
<script src="<?= site_url() ?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ===== Slimscroll JavaScript ===== -->
<script src="<?= site_url() ?>/assets/js/jquery.slimscroll.js"></script>
<!-- ===== Wave Effects JavaScript ===== -->
<script src="<?= site_url() ?>/assets/js/waves.js"></script>
<!-- ===== Menu Plugin JavaScript ===== -->
<script src="<?= site_url() ?>/assets/js/sidebarmenu.js"></script>
<!-- ===== Custom JavaScript ===== -->
<script src="<?= site_url() ?>/assets/js/custom.js"></script>
<!-- ===== Plugin JS ===== -->
<script src="<?= site_url() ?>/plugins/components/datatables/jquery.dataTables.min.js"></script>
<script src="<?= site_url() ?>/assets/js/datatables.js"></script>
<script src="<?= site_url() ?>/assets/js/mycustomscript.js"></script>
<script src="<?= site_url() ?>/plugins/components/dropify/dist/js/dropify.min.js"></script>
<script src="<?= site_url() ?>/plugins/components/icheck/icheck.min.js"></script>
<script src="<?= site_url() ?>/plugins/components/icheck/icheck.init.js"></script>
<script type="text/javascript"> var BASE_URL = "<?php echo site_url();?>";</script>
<script>
    $(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>

    <!-- ===== Style Switcher JS ===== -->
<script src="<?= site_url() ?>/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?= site_url() ?>/plugins/components/switchery/dist/switchery.min.js"></script>
<script src="<?= site_url() ?>/plugins/components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="<?= site_url() ?>/plugins/components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?= site_url() ?>/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= site_url() ?>/plugins/components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();
            $('.selectpicker').selectpicker();
            //Bootstrap-TouchSpin
            $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                verticalupclass: 'ti-plus',
                verticaldownclass: 'ti-minus'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }
            $("input[name='tch1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='tch2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='tch3']").TouchSpin();
            $("input[name='tch3_22']").TouchSpin({
                initval: 40
            });
            $("input[name='tch5']").TouchSpin({
                prefix: "pre",
                postfix: "post"
            });

        });
        </script>
        <!--Style Switcher -->
<script src="<?= site_url() ?>/plugins/components/moment/moment.js"></script>
<script src="<?= site_url() ?>/plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    jQuery('.mydatepicker, #datepicker').datepicker();
</script>
<script src="<?= site_url() ?>/plugins/components/raphael/raphael-min.js"></script> 
<script src="<?= site_url() ?>/plugins/components/morrisjs/morris.js"></script>
<script src="<?= site_url() ?>assets/js/widget.js"></script>

<script src="<?= site_url() ?>/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?= site_url() ?>/assets/js/grade.js"></script>