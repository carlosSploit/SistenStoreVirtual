<script>
    $(document).ready(function(e) {
        var base_url = "<?php echo base_url(); ?>";
        $('#dataTable').DataTable({
            "pageLength": 10,
            "order": [
                [1, "desc"]
            ],
            "ajax": {
                url: base_url + 'index.php/pedido/mostrarPedido',
                type: 'POST',
                data: {
                    activo: "1"
                }
            },

        });

    });

    function ActualEstado(id, val, idv) {
        console.log("id: " + id + " valor es :" + val);
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/pedido/ActualizarEstado/' + id + '/' + val + '/' + idv,
            success: function(response) {
                if (response == 0) {
                    $(tagCodigo).val('');
                } else {
                    notify(1, "Pedido", "El pedido se actualizo con exito", 'R', "success");
                }
            }
        });
    }

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel">
            <h4><?php echo $titulo; ?></h4>
            <div class="centrado">
                <p>

                    <a href="<?php echo base_url() ?>index.php/pedido/eliminadas" class="btn btn-warning">Eliminadas</a>
                </p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Cliente</th>
                            <th>Direccion.P.</th>
                            <th>Telefono.P.</th>
                            <th>Date.P.</th>
                            <th>Estado</th>
                            <th width="3%"></th>
                            <th width="3%"></th>
                            <th width="3%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!---disabled--->
</div>

<br>

<!-- Modal -->
<div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div id="headModel" class="modal-header">
                <h5 class="modal-title">Cancelar pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="BodyModel" class="modal-body">
                <p>¿Desea cancelar este pedido?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-light" data-dismiss="modal">No</a>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>