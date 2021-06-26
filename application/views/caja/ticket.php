<?php
	
	ini_set('display_errors', 1);	
	require APPPATH.'/third_party/fpdf/fpdf.php';
	require APPPATH.'/third_party/numeros_letras.php';
	
	$pdf = new FPDF('P','mm',array(80, 290));
	$pdf->AddPage();
	$pdf->SetMargins(5,5,5);
	$pdf->SetTitle("Ticket");
	$pdf->SetFont('Arial', 'B', 9);
	
	$this->db->select('v.*,c.nombre AS cliente, fp.descripcion');
	$this->db->from('ventas v');
	$this->db->join('clientes c', 'v.id_cliente = c.id');
	$this->db->join('forma_pago fp', 'v.forma_pago = fp.forma_pago');
	$this->db->where('v.id', $id_venta);
	$datosVenta = $this->db->get()->row();

	$detalleVenta = $this->db->get_where("detalle_venta_producto", ["id_venta" => $id_venta])->result();
	
	$fecha = substr($datosVenta->fecha,0, 10);
	$hora = substr($datosVenta->fecha,11, 8);
	
	$pdf->image(base_url().'images/logo.png', 55, 3, 20,15, 'PNG');
	$pdf->SetXY(5,7);
	$pdf->Multicell(50, 4, utf8_decode($this->db->get_where('configuracion' , array('nombre' =>'tienda_nombre'))->row()->valor) , 0,'C',0);
	
	$pdf->SetXY(5,15);
	
	$pdf->Ln(1);
	$pdf->SetFont('Arial', '', 7);
	$pdf->Multicell(70, 4, utf8_decode($this->db->get_where('configuracion' , array('nombre' =>'tienda_direccion'))->row()->valor), 0,'C', 0);
	$pdf->Multicell(70, 4, utf8_decode($this->db->get_where('configuracion' , array('nombre' =>'tienda_telefono'))->row()->valor), 0,'C', 0);
	
	$pdf->SetFont('Arial', '', 8);
	$pdf->Ln(1);
	$pdf->Cell(60, 4, utf8_decode('Nº ticket:  ').$datosVenta->folio, 0,1,'L');
	$pdf->MultiCell(60, 4, utf8_decode($datosVenta->cliente), 0,'L',0);
	
	$pdf->Cell(60, 4, '=========================================', 0,1,'L');
	
	$pdf->Cell(7, 3, 'Cant.', 0,0,'L');
	$pdf->Cell(36, 3, utf8_decode('Descripción'), 0,0,'L');
	$pdf->Cell(14, 3, 'Precio', 0,0,'L');
	$pdf->Cell(14, 3, 'Importe', 0,1,'L');
	$pdf->Cell(70, 3, '------------------------------------------------------------------------', 0,1,'L');
	
	$pdf->SetFont('Arial', '', 6);
	
	foreach($detalleVenta as $row){
		$importe  = number_format(($row->cantidad * $row->precio_unitario), 2, '.', ',');
		$pdf->Cell(7, 3, $row->cantidad, 0,0,'C');
		$y = $pdf->GetY();
		$pdf->MultiCell(36, 3, utf8_decode($row->descripcion), 0,'L');
		$y2 = $pdf->GetY();
		$pdf->SetXY(48, $y);
		$pdf->Cell(14, 3, '$ '.number_format($row->precio_unitario, 2, '.', ','), 0,1,'C');
		$pdf->SetXY(62, $y);
		$pdf->Cell(14, 3, '$ '.$importe, 0,1,'C');
		$pdf->SetY($y2);
	}

	$pdf->Ln(2);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(50, 4, 'Total', 0,0,'R');
	$pdf->Cell(20, 4, '$ '.number_format($datosVenta->total, 2, '.', ','), 0,1,'R');

	$pdf->SetFont('Arial', '', 8);
	$pdf->MultiCell(70, 4, utf8_decode(ucfirst(strtolower($datosVenta->descripcion))), 0, 'L', 0);
	$decimales = explode(".",$datosVenta->total);
	$pdf->MultiCell(70, 4, utf8_decode(ucfirst(strtolower(NumeroALetras::convertir($datosVenta->total, 'pesos')))).' '.$decimales[1].'/100 M.N', 0, 'L', 0);
	
	$pdf->Ln();
	$pdf->Cell(5);
	$pdf->Cell(30, 4, 'Fecha: '.date("d/m/Y", strtotime($fecha)), 0,0,'L');
	$pdf->Cell(30, 4, 'Hora: '.$hora, 0,1,'L');
	
	$pdf->Ln(3);
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Multicell(70, 4, utf8_decode($this->db->get_where('configuracion' , array('nombre' =>'ticket_leyenda'))->row()->valor), 0,'C', 0);
	
	$pdf->Output("Ticket.pdf", 'I');
