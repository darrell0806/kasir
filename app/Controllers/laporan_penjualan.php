<?php

namespace App\Controllers;
use App\Models\M_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class laporan_penjualan extends BaseController

{
    public function index()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2){
			$model=new M_model();
            $data['title']='Data Penjualan';
			$kui['kunci']='print_penjualan';
            echo view('partial/header_datatable',$data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('filter_penjualan',$kui);
            echo view('partial/footer_datatable');    
		}else{
			return redirect()->to('/Home');
		}
	}
    public function print_windows()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2){
    $model = new M_model();
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $kui['duar'] = $model->filterbk('penjualan', $awal, $akhir);
    echo view('v_pen', $kui);
}else{
	return redirect()->to('login');
}
	}
    public function pdf()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2 ){
		$model = new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $kui['duar'] = $model->filterbk('penjualan', $awal, $akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('v_pen',$kui));
		$dompdf->setPaper('A4','potrait');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
	}else{
		return redirect()->to('/login');
	}
	}
	public function excel()
	{
		if (session()->get('level') == 1 || session()->get('level') == 2) {
			$model = new M_model();
			$awal = $this->request->getPost('awal');
			$akhir = $this->request->getPost('akhir');
			$data = $model->filterbk('penjualan', $awal, $akhir);
	
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'Tanggal')
				->setCellValue('B1', 'Petugas')
				->setCellValue('C1', 'Total');
	
			$column = 2;
			$grandTotal = 0; // Initialize the grand total
	
			foreach ($data as $data) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $data->tanggal)
					->setCellValue('B' . $column, $data->nama)
					->setCellValue('C' . $column, $data->total);
	
				$grandTotal += $data->total; // Add the total to the grand total
				$column++;
			}
	
			// Display the grand total row at the end
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, 'Total')
				->setCellValue('C' . $column, $grandTotal);
	
			$writer = new XLsx($spreadsheet);
			$fileName = 'Data Laporan Penjualan';
	
			header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		} else {
			return redirect()->to('/login');
		}
	}
	
}