<?php
	/*
		Copyright (c) 2020 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	
	ini_set('display_errors', 1);	
	require APPPATH.'/third_party/fpdf/fpdf.php'; 
	
	$pdf = new FPDF('P','mm','letter');
	$pdf->AddPage();
	$pdf->SetMargins(10,10,10);
	$pdf->SetTitle("Compra");
	$pdf->SetFont('Arial', 'B', 10);
	
	$datosCompra = $this->db->get_where('almacen_movimiento' , array('id' => $id_compra))->row();
	$detalleCompra = $this->db->get_where("detalle_almacen_movimiento", ["id_movimiento" => $id_compra])->result();
	
	$fecha = substr($datosCompra->fecha,0, 10);
	$hora = substr($datosCompra->fecha,11, 8);

	$pdf->Cell(196, 5, utf8_decode('Entrada de productos') , 0,1,'C');
	$pdf->SetFont('Arial', 'B', 9);
	
	$pdf->image(base_url().'images/logo.png', 185, 10, 25,20, 'PNG');
	$pdf->Multicell(50, 4, utf8_decode($this->db->get_where('configuracion' , array('nombre' =>'tienda_nombre'))->row()->valor) , 0,'L',0);
	
	$pdf->Ln(1);
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(20, 5, utf8_decode('Dirección: '), 0,0,'L');
	$pdf->SetFont('Arial', '', 8);
	$pdf->Multicell(130, 4, utf8_decode('Dirección: '.$this->db->get_where('configuracion' , array('nombre' =>'tienda_direccion'))->row()->valor), 0,'L', 0);
	
	$pdf->Ln(1);
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(20, 5, 'Fecha y hora:', 0,0,'L');
	$pdf->SetFont('Arial', '', 8);
	$pdf->Cell(40, 5, $datosCompra->fecha, 0,1,'L');
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(20, 5, 'Movimiento:', 0,0,'L');
	$pdf->SetFont('Arial', '', 8);
	$pdf->Cell(40, 5, 'Compra', 0,0,'L');
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(10, 5, 'Folio:', 0,0,'L');
	$pdf->SetFont('Arial', '', 8);
	$pdf->Cell(40, 5, $datosCompra->folio, 0,1,'L');

	$pdf->Ln();

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->setTextcolor(255,255,255);
	$pdf->Cell(196, 5, 'Detalle de productos',1,1,'C',1);
	$pdf->setTextcolor(0,0,0);
	$pdf->Cell(14, 5, utf8_decode('Nº'), 1,0,'L');
	$pdf->Cell(25, 5, utf8_decode('Código'), 1,0,'L');
	$pdf->Cell(77, 5, utf8_decode('Descripción'), 1,0,'L');
	$pdf->Cell(25, 5, 'Precio', 1,0,'L');
	$pdf->Cell(25, 5, 'Cantidad', 1,0,'L');
	$pdf->Cell(30, 5, 'Importe', 1,1,'L');

	$pdf->SetFont('Arial', '', 7);
	
	$contador = 1;

	foreach($detalleCompra as $row){
		$pdf->Cell(14, 5, $contador, 1,0,'L');
		$pdf->Cell(25, 5, $row->id_producto, 1,0,'L');
		$pdf->Cell(77, 5, utf8_decode($row->descripcion), 1,0,'L');
		$pdf->Cell(25, 5, number_format($row->precio_unitario, 2, '.', ','), 1,0,'R');
		$pdf->Cell(25, 5, $row->cantidad, 1,0,'C');
		$importe  = number_format($row->cantidad * $row->precio_unitario, 2, '.', ',');
		$pdf->Cell(30, 5, $importe, 1,1,'R');
		$contador++;
	}
	
	$pdf->Ln();
	/*$pdf->Cell(141);
	$pdf->Cell(25, 4, 'Subtotal', 0,0,'R');
	$pdf->Cell(30, 4, '$ '.$datosCompra->total, 0,1,'R');
	$pdf->Cell(141);
	$pdf->Cell(25, 4, 'Impuesto', 0,0,'R');
	$pdf->Cell(30, 4, '$ 0.00', 0,1,'R');*/
	$pdf->Cell(141);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(25, 4, 'Total', 0,0,'R');
	$pdf->Cell(30, 4, '$ '.number_format($datosCompra->total, 2, ',', '.'), 0,1,'R');
	
	$pdf->Output("compra_pdf.pdf", 'I');
	
?>							