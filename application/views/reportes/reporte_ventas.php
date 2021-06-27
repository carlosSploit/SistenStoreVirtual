<?php
	ini_set('display_errors', 1);	
	require APPPATH.'/third_party/fpdf/fpdf.php';
	require APPPATH.'/third_party/plantilla_reporte_ventas.php';

	function ordenarFecha($fecha){
		$arreglo = explode("-", $fecha);
		return $arreglo[2].'-'.$arreglo[1].'-'.$arreglo[0];
	}

	function ordenarFechaHora($fechaHora){
		$fecha = substr($fechaHora, 0, 10);
		$hora = substr($fechaHora, 11);
		$arreglo = explode("-", $fecha);
		return $arreglo[2].'-'.$arreglo[1].'-'.$arreglo[0].' '.$hora;
	}

	$where = '';

	if($caja != 0){
		$where = ' AND v.id_caja='.$caja;
	}  
	
	$datosVenta = $this->db->query("SELECT v.fecha, v.folio, v.total, c.nombre FROM ventas AS v INNER JOIN clientes AS c ON v.id_cliente=c.id WHERE v.activo = 1 AND DATE(v.fecha) BETWEEN '$fecha_inicio' AND '$fecha_fin' $where ORDER BY v.folio ASC")->result();
	
	$logo = base_url()."images/logo.png";
	
	$datos = array('titulo' => 'Reporte de ventas', 'logo' => $logo, 'inicio' => ordenarFecha($fecha_inicio), 'fin' => ordenarFecha($fecha_fin));
	
	$pdf = new PDF('P','mm','letter', $datos);
	$pdf->SetTitle('Reporte de ventas');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetWidths(array(35,35,70,35));
	$pdf->SetFont('Arial','B',8);
	$pdf->Row(array('Fecha','Folio', 'Cliente','Total'));
	$pdf->SetFont('Arial','',8);
	
	$total = 0;
	$numVentas = 0;
	
	foreach($datosVenta as $row){
		$pdf->Row(array(ordenarFechaHora($row->fecha), $row->folio, $row->nombre, number_format($row->total, 2, '.', ',')));
		$total = $total + $row->total;
		++$numVentas;
	}
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(140,5,'Total',0,0,'R');
	$pdf->Cell(35,5, number_format($total, 2, '.', ','),1,1,'C');
	$pdf->Ln(2);
	$pdf->Cell(70,5, utf8_decode('Número de ventas: ').$numVentas,0,0,'L');
	
	$pdf->SetFont('Arial','',8);
	
	$pdf->Output("I",'Reporte de ventas');
