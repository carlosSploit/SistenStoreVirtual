<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel">
            <!--Se necesita hacer un reporte del monto total de ventas y pedidos diarias. (lineal)-->
            <div class="card">
                <div class="card-header">
                    Ventas Diarias Activas
                </div>
                <div class="card-body">
                    <canvas id="myChart" class="col-auto" height="100"></canvas>
                </div>
            </div>
            <br>
            <div class="row m-0">
                <!--Se necesita hacer un reporte de los productos más vendidos.(torta)-->
                <div class="card col px-1">
                    <div class="card-header">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <div class="accordion-button" onclick='cuerpoDat("#mychart1")'>
                                    <h6>Productos mas vendidos</h6>
                                </div>
                            </h2>
                            <div id="mychart1CO" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="w-100">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> # </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> nombres </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> total </h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="mychart1TI">
                                        </tbody>
                                    </table>
                                    <!--<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart1" class="d-block"></canvas>
                    </div>
                </div>
                <div class="w-100 d-block d-md-none red m-2"></div>
                <div class="w-0 d-none d-md-block red m-2"></div>
                <!--Se necesita hacer un reporte de los productos más vendidos y dan más ganancias. (torta)-->
                <div class="card col px-1">
                    <div class="card-header">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <div class="accordion-button" onclick='cuerpoDat("#mychart2")'>
                                    <h6>Productos con mas ganancias brinda vendidos</h6>
                                </div>
                            </h2>
                            <div id="mychart2CO" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="w-100">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> # </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> nombres </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> total </h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="mychart2TI">
                                        </tbody>
                                    </table>
                                    <!--<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <canvas id="myChart2" class="d-block"></canvas>
                    </div>
                </div>
            </div>
            <br>
            <div class="row m-0">
                <!--Se necesita hacer un reporte de los productos más pedidos.(torta)-->
                <div class="card col px-1">
                    <div class="card-header">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <div class="accordion-button" onclick='cuerpoDat("#mychart3")'>
                                    <h6>Productos mas pedidos</h6>
                                </div>
                            </h2>
                            <div id="mychart3CO" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="w-100">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> # </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> nombres </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> total </h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="mychart3TI">
                                        </tbody>
                                    </table>
                                    <!--<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body4">
                        <canvas id="myChart3" class="col-auto" height="200"></canvas>
                    </div>
                </div>
                <div class="w-100 d-block d-md-none red m-2"></div>
                <div class="w-0 d-none d-md-block red m-2"></div>
                <!--Se necesita hacer un reporte de los productos más pedidos y dan más ganancias.(torta)-->
                <div class="card col px-1">
                    <div class="card-header">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <div class="accordion-button" onclick='cuerpoDat("#mychart4")'>
                                    <h6>Productos con mas ganancias brinda pedidos</h6>
                                </div>
                            </h2>
                            <div id="mychart4CO" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="w-100">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> # </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> nombres </h6>
                                                </th>
                                                <th scope="col" class="mx-auto">
                                                    <h6 class="m-1"> total </h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="mychart4TI">
                                        </tbody>
                                    </table>
                                    <!--<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body5">
                        <canvas id="myChart4" class="col-auto" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!--inicializar algunas vizualisaciones-->
<script type="text/javascript">
    $("#mychart1CO").hide();
    $("#mychart2CO").hide();
    $("#mychart3CO").hide();
    $("#mychart4CO").hide();
</script>
<!--SELECT CASE WHEN WEEKDAY(DATE(v.fecha)) = 0 THEN "Lunes" WHEN WEEKDAY(DATE(v.fecha)) = 1 THEN "Martes" WHEN WEEKDAY(DATE(v.fecha)) = 2 THEN "Miercoles" WHEN WEEKDAY(DATE(v.fecha)) = 3 THEN "Jueves" WHEN WEEKDAY(DATE(v.fecha)) = 4 THEN "Viernes" WHEN WEEKDAY(DATE(v.fecha)) = 5 THEN "Sabado" WHEN WEEKDAY(DATE(v.fecha)) = 6 THEN "Domingo" END as Dias , DATE(v.fecha), SUM(v.total) as total FROM ventas as v  WHERE `activo` <> 0 GROUP BY DATE(v.fecha) ORDER BY 2 DESC LIMIT 6-->
<script type="text/javascript">
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/Analitic/Analitic/' + 0,
        success: function(response) {
            if (response == 0) {
                alert("No se we pero no funqueichon");
            } else {
                var resultado = JSON.parse(response);
                var ctx = document.getElementById('myChart').getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: resultado.L,
                        datasets: [{
                            label: resultado.MA,
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 10,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 5,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: resultado.D, //paramValores,//vertical
                            spanGaps: false,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        }
    });
</script>
<!--SELECT SUM(dp.cantidad), p.nombre FROM productos p, detalle_venta_producto dp, ventas v WHERE dp.id_producto = p.id AND v.id = dp.id_venta AND v.activo <> 0 GROUP BY p.nombre ORDER BY 1 DESC LIMIT 4-->
<script type="text/javascript">
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/Analitic/Analitic/' + 1,
        success: function(response) {
            if (response == 0) {
                $(tagCodigo).val('');
            } else {
                var resultado = JSON.parse(response);
                tablaDat(resultado, "#mychart1");
                //colocar informacion al cuadro
                var ctx1 = document.getElementById('myChart1').getContext('2d');
                var myChart1 = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: resultado.LA,
                        datasets: [{
                            label: resultado.L[0],
                            data: resultado.D,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        }
    });

    function cuerpoDat(content) {
        console.log();
        if ($(content + "CO").is(":visible")) {
            $(content + "CO").hide();
        } else {
            $(content + "CO").show();
        }
    }

    function tablaDat(resultado, tabla) {
        var text = "";
        var cont = 0;
        var color = ["table-danger", "table-warning", "table-info", "table-success"];
        resultado.DA.forEach(element => {
            console.log(element);
            text = text + "<tr class='" + color[cont] + "'><th scope='col' class='mx-auto'><h6 class='m-1'> " + cont + " </h6></th><td scope='col' class='mx-auto'><h6 class='m-1'> " + element.nombre + " </h6></td><td scope='col' class='mx-auto'><h6 class='m-1'> " + element.total + " </h6></td></tr>";
            cont++;
        });
        $(tabla + "TI").html(text);
    }
</script>
<!--SELECT SUM(dp.cantidad*(p.precio_venta-p.precio_compra)) as total, p.nombre FROM productos p, detalle_venta_producto dp, ventas v WHERE dp.id_producto = p.id AND v.id = dp.id_venta AND v.activo <> 0 GROUP BY p.nombre ORDER BY 1 DESC LIMIT 4-->
<script type="text/javascript">
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/Analitic/Analitic/' + 2,
        success: function(response) {
            if (response == 0) {
                $(tagCodigo).val('');
            } else {
                var resultado = JSON.parse(response);
                tablaDat(resultado, "#mychart2");

                var ctx2 = document.getElementById('myChart2').getContext('2d');

                var myChart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: resultado.LA,
                        datasets: [{
                            label: resultado.L[0],
                            data: resultado.D,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        }
    });
</script>
<!--SELECT SUM(dp.cantidad), p.nombre FROM productos p, detalle_venta_producto dp, ventas v, pedido pe WHERE dp.id_producto = p.id AND v.id = dp.id_venta AND v.folio = pe.folio AND v.activo <> 0 GROUP BY p.nombre ORDER BY 1 DESC LIMIT 4-->
<script type="text/javascript">
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/Analitic/Analitic/' + 3,
        success: function(response) {
            if (response == 0) {
                $(tagCodigo).val('');
            } else {
                var resultado = JSON.parse(response);
                tablaDat(resultado, "#mychart3");
                var ctx3 = document.getElementById('myChart3').getContext('2d');

                var myChart3 = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: resultado.LA,
                        datasets: [{
                            label: resultado.L[0],
                            data: resultado.D,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        }
    });
</script>
<!--SELECT SUM(dp.cantidad*(p.precio_venta-p.precio_compra)) as total, p.nombre FROM productos p, detalle_venta_producto dp, ventas v, pedido pe WHERE dp.id_producto = p.id AND v.id = dp.id_venta AND v.activo <> 0 AND pe.folio = v.folio GROUP BY p.nombre ORDER BY 1 DESC LIMIT 4-->
<script type="text/javascript">
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/Analitic/Analitic/' + 4,
        success: function(response) {
            if (response == 0) {
                $(tagCodigo).val('');
            } else {
                var resultado = JSON.parse(response);
                tablaDat(resultado, "#mychart4");
                var ctx4 = document.getElementById('myChart4').getContext('2d');

                var myChart4 = new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: resultado.LA,
                        datasets: [{
                            label: resultado.L[0],
                            data: resultado.D,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        }
    });
</script>