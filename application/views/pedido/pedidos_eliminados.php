<script>
    $(document).ready(function(e) {
        var base_url = "<?php echo base_url(); ?>";
        $('#dataTable').DataTable({
            "pageLength": 10,
            "serverSide": true,
            "order": [
                [1, "desc"]
            ],
            "ajax": {
                url: base_url + 'index.php/pedido/mostrarPedido',
                type: 'POST',
                data: {
                    activo: "0"
                }
            },
        });
    });

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
                    <a href="<?php echo base_url() ?>index.php/pedido" class="btn btn-info">Pedidos</a>
                </p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th width="3%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>