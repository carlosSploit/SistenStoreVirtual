<!--
	Copyright (c) 2020 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel">
            <h4><?php echo $title; ?></h4>

            <form id="metodo_act" method="post" action="<?php echo base_url() ?>index.php/pedido/Actualizar" autocomplete="off">
                <br>
                <input type="hidden" name="id" value="<?php echo $dato['id_pedido']; ?>">
                <!---<input type="hidden" name="codigo_org" value=">--->

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="codigo"><span class="text-danger">*</span>C&oacute;digo</label>
                            <input class="form-control" id="codigo" type="text" name="codigo" placeholder="Escribe aquí el código del producto" value="<?php echo $dato['folio']; ?>" readonly>
                        </div>

                        <div class="col-8">
                            <label for="nombre"><span class="text-danger">*</span>Nombre</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="<?php echo $dato['nombre']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="precio_venta"><span class="text-danger">*</span>Precio de venta</label>
                            <input class="form-control" id="direccion" type="text" name="direccion" placeholder="Escribe aquí el precio de venta" value="<?php echo $dato['direccion']; ?>" required>
                        </div>

                        <div class="col">
                            <label for="precio_venta"><span class="text-danger">*</span>Precio de venta</label>
                            <input class="form-control" id="telefono" type="text" name="telefono" placeholder="Escribe aquí el precio de venta" value="<?php echo $dato['telefono'];; ?>" required>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label class="text-danger">( * ) Campo obligatorio</label>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url() ?>index.php/pedido" class="btn btn-primary">Volver</a>
                <button id="butacped" class="btn btn-success" type="button">Guardar</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(e) {
        var base_url = "<?php echo base_url(); ?>";
        $("#butacped").click(function() {
            if ($("#direccion").val() != "" & $("#telefono").val() != "") {
                $("#metodo_act").submit();
            } else {
                alert("Unas de las casillas esta incompleta, completarla porfavor");
            }

        });
    });
</script>