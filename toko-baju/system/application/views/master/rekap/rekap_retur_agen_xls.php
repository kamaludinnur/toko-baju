<?php

$total_keuntungan = 0;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Manajemen Toko Baju")
                             ->setLastModifiedBy("Manajemen Toko Baju")
                             ->setTitle("Rekap Retur Agen")
                             ->setSubject("Rekap Retur Agen");

// header

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:K1')->setCellValueByColumnAndRow(0, 1, "Rekap Retur Agen");

$rangeTanggal = "Tanggal " . date('d/m/Y', strtotime($start_date));
if($start_date != $end_date) $rangeTanggal .= " sampai " . date('d/m/Y', strtotime($end_date));

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:K2')->setCellValueByColumnAndRow(0, 2, $rangeTanggal);

for ($n = 0; $n <= 10; $n++)
    $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($n, 4)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20)->setBold(true);
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);

$objPHPExcel->getActiveSheet()
            ->setCellValueByColumnAndRow(0, 4, "No")
            ->setCellValueByColumnAndRow(1, 4, "No. Transaksi")
            ->setCellValueByColumnAndRow(2, 4, "Tanggal")
            ->setCellValueByColumnAndRow(3, 4, "Agen")
            ->setCellValueByColumnAndRow(4, 4, "Merek")
            ->setCellValueByColumnAndRow(5, 4, "Model")
            ->setCellValueByColumnAndRow(6, 4, "Warna")
            ->setCellValueByColumnAndRow(7, 4, "Ukuran")
            ->setCellValueByColumnAndRow(8, 4, "Jumlah")
            ->setCellValueByColumnAndRow(9, 4, "Harga")
            ->setCellValueByColumnAndRow(10, 4, "Refund");

// column width

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

// the real data

$i = 5; foreach($data_rekapan as $data) :

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $i - 4);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $data['id_order']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, date('d/m/Y', strtotime($data['tanggal'])));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, "{$data['kode_agen']} ({$data['agen']})");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $data['merek']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $data['model']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $data['warna']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $data['ukuran']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $data['jumlah']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $data['harga']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $data['refund']);


$total_keuntungan += $data['refund'];
$i++; endforeach;

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, "Total")->getStyleByColumnAndRow(9, $i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $total_keuntungan)->getStyleByColumnAndRow(10, $i)->getFont()->setBold(true);

// border
$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A4:K4')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A5:K' . ($i-1))->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle("A$i:K$i")->applyFromArray($styleThinBlackBorderOutline);

$objPHPExcel->getActiveSheet()->getStyle('A4:K4')->getFill()->setFillType(Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDDDDDD');
$objPHPExcel->getActiveSheet()->getStyle("A$i:K$i")->getFill()->setFillType(Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDDDDDD');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Rekap');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="rekap_retur_agen_' . time() . '.xls"');

$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter->save("php://output");