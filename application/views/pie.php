</div>
<!-- /.container-fluid -->

<!-- Sticky Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <div class="text-muted">Copyright &copy; Sitio Web <?php echo date('Y'); ?></div>
            <div>
                <a href="#">Privacy Policy </a>
                <a href="https://web.facebook.com/PRODUC.REGIONALES.LONUESTRO" target="_blank"> Facebook</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!----------------------Alerta en messeng----------------------->
<div id="vanillatoasts-container" class="toasts-top-right"></div>
<!-------------------------------------------------------------->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>vendor/twbs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url() ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>js/sb-admin.min.js"></script>

<!-- Custom scripts for all page-->
<script src="<?php echo base_url() ?>js/valida_seld_basic.js"></script>

<!-- Demo scripts for this page-->
<script src="<?php echo base_url() ?>js/demo/chart-area-demo.js"></script>

<script type="text/javascript">
    function notify(tip, title, messegng, poss, tipmess) {
        switch (tipmess) {
            case "success":
                img = "https://www.institutoncologicofalp.cl/wp-content/uploads/2020/05/okfalparchivos.png";
                break;
            case "error":
                img = "https://cdn0.iconfinder.com/data/icons/shift-free/32/Error-512.png";
                break;
            default:
                break;
        }
        switch (poss) {
            case 'R':
                $('#vanillatoasts-container').attr('class', 'toasts-top-right');
                VanillaToasts.create({
                    title: title,
                    text: messegng,
                    type: tipmess,
                    icon: img,
                    timeout: 2000
                });
                break;
            default:
                $('#vanillatoasts-container').attr('class', 'toasts-top-left');
                VanillaToasts.create({
                    title: title,
                    text: messegng,
                    type: tipmess,
                    icon: img,
                    timeout: 2000
                });
                break;
        };
    }
</script>
<?php
$variable = 'id';
if (isset($variable)) : ?>
    <?php
    try {
        if ($id == 1) :
            echo '<script type="text/javascript">
            $(document).ready(function() {
                notify(1, "Editar", "' . $mesg . '" , "R", "' . $estade . '");
            });
            </script>';
        elseif ($id == 2) :
            echo '<script type="text/javascript"> var str = ' . json_encode(validation_errors()) . ' </script>';
            echo '<script type="text/javascript">
            $(document).ready(function() {
                notify(1, "Editar", str , "R", "' . $estade . '");
            });
            </script>';
        endif;
    } catch (Exception $e) {
    }
    ?>
<?php endif ?>
</body>

</html>