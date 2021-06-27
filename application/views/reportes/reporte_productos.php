<?php
	ini_set('display_errors', 1);	
	require APPPATH.'/third_party/fpdf/fpdf.php';
	require APPPATH.'/third_party/plantilla_reporte_productos.php';
	
	$this->db->order_by('codigo', 'ASC');
	$datosProductos = $this->db->get_where('productos' , array("activo" => 1))->result();
	
	$logo = base_url()."images/logo.png";
	
	$datos = array('titulo' => 'Reporte de productos', 'logo' => $logo );
	
	$pdf = new PDF('P','mm','letter', $datos);
	$pdf->SetTitle('Reporte de ventas');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetWidths(array(30,70,30,30,30));
	$pdf->SetFont('Arial','B',8);
	$pdf->Row(array(utf8_decode('Código'),'Nombre','Precio de compra','Precio de venta', 'Existencia'));
	$pdf->SetFont('Arial','',8);
	
	$total = 0;
	$numVentas = 0;
	
	foreach($datosProductos as $row){
		$pdf->Row(array($row->codigo, utf8_decode($row->nombre), number_format($row->precio_compra, 2, '.', ','), number_format($row->precio_venta, 2, '.', ','), $row->existencia));
		$total = $total + $row->precio_venta;
		++$numVentas;
	}
	
	$pdf->Output("I",'Reporte de productos');
