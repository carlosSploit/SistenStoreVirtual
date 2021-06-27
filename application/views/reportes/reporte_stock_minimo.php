<?php
	ini_set('display_errors', 1);	
	require APPPATH.'/third_party/fpdf/fpdf.php';
	require APPPATH.'/third_party/plantilla_reporte_stock_minimo.php';
	
	$pm = &get_instance();
	$pm->load->model("productosModel");
	$datosProductos = $pm->productosModel->porStockMinimo();

	$logo = base_url()."images/logo.png";
	
	$datos = array('titulo' => 'Reporte de productos con stock mínimo', 'logo' => $logo );
	
	$pdf = new PDF('P','mm','letter', $datos);
	$pdf->SetTitle('Reporte de ventas');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetWidths(array(30,70,30,30,30));
	$pdf->SetFont('Arial','B',8);
	$pdf->Row(array(utf8_decode('Código'),'Nombre','Precio de venta',utf8_decode('Stock mínimo'), 'Existencia'));
	$pdf->SetFont('Arial','',8);
	
	$total = 0;
	$numVentas = 0;
	
	foreach($datosProductos as $row){
		$pdf->Row(array($row->codigo, utf8_decode($row->nombre), number_format($row->precio_venta, 2, '.', ','), number_format($row->stock_minimo, 2, '.', ','), $row->existencia));
		$total = $total + $row->precio_venta;
		++$numVentas;
	}
	
	$pdf->Output("I",'Reporte stock minimo');
