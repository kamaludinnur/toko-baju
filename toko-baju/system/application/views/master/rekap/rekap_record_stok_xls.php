<?php

$total_keuntungan = 0;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Manajemen Toko Baju")
                             ->setLastModifiedBy("Manajemen Toko Baju")
                             ->setTitle("Rekap Record Stok")
                             ->setSubject("Rekap Record Stok");

// header

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:H1')->setCellValueByColumnAndRow(0, 1, "Rekap Record Stok");

$rangeTanggal = "Tanggal " . date('d/m/Y', strtotime($start_date));
if($start_date != $end_date) $rangeTanggal .= " sampai " . date('d/m/Y', strtotime($end_date));

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:H2')->setCellValueByColumnAndRow(0, 2, $rangeTanggal);

for ($n = 0; $n <= 9; $n++)
    $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($n, 4)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20)->setBold(true);
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);

$objPHPExcel->getActiveSheet()
            ->setCellValueByColumnAndRow(0, 4, "No")
            ->setCellValueByColumnAndRow(1, 4, "Tanggal")
            ->setCellValueByColumnAndRow(2, 4, "Merek")
            ->setCellValueByColumnAndRow(3, 4, "Model")
            ->setCellValueByColumnAndRow(4, 4, "Warna")
            ->setCellValueByColumnAndRow(5, 4, "Ukuran")
            ->setCellValueByColumnAndRow(6, 4, "Stok Akhir")
            ->setCellValueByColumnAndRow(7, 4, "Jenis Transaksi");

// column width

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

// the real data

$i = 5; foreach($data_rekapan as $data) :

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $i - 4);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, date('d/m/Y', strtotime($data['tanggal'])));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $data['merek']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $data['model']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $data['warna']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $data['ukuran']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $data['stok_akhir']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $data['jenis']);

$i++; endforeach;

// border
$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A5:H' . ($i-1))->applyFromArray($styleThinBlackBorderOutline);

$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFill()->setFillType(Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDDDDDD');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Rekap');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="rekap_record_stok_' . time() . '.xls"');

$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter->save("php://output");