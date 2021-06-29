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
                            <label for="codigo"><span class="text-danger"></span>C&oacute;digo</label>
                            <input class="form-control" id="codigo" type="text" name="codigo" placeholder="Escribe aquí el código del producto" value="<?php echo $dato['folio']; ?>" disabled>
                        </div>

                        <div class="col-8">
                            <label for="nombre"><span class="text-danger"></span>Nombre</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="<?php echo $dato['nombre']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="precio_venta"><span class="text-danger">*</span>Direccion</label>
                            <input onkeypress="limit(this.value,'direccion',200)" class="form-control col-auto" id="direccion" type="text" name="direccion" placeholder="Escribe aquí el precio de venta" value="<?php echo $dato['direccion']; ?>">
                        </div>
                        <div class="w-100 d-block m-2"></div>
                        <div class="col">
                            <label for="precio_venta"><span class="text-danger">*</span>Telefono</label>
                            <input onkeypress="limit(this.value,'telefono',9)" maxlength="9" type="number" class="form-control" id="telefono" type="text" name="telefono" placeholder="Escribe aquí el precio de venta" value="<?php echo $dato['telefono']; ?>">
                        </div>
                        <div class="col">
                            <label for="precio_venta"><span class="text-danger">*</span>Fecha</label>
                            <input class="form-control" id="datep" type="date" name="datep" placeholder="Escribe aquí el precio de venta" value="<?php echo $dato['date']; ?>">
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
                <button id="butacped" class="btn btn-success" type="submit">Guardar</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    // $(document).ready(function(e) {
    //     var base_url = "< echo base_url(); ?>";
    //     $("#butacped").click(function() {
    //         if ($("#direccion").val() != "" & $("#telefono").val() != "") {
    //             $("#metodo_act").submit();
    //         } else {
    //             alert("Unas de las casillas esta incompleta, completarla porfavor");
    //         }

    //     });
    // });
</script>