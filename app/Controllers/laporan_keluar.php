<?php

namespace App\Controllers;
use App\Models\M_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class laporan_keluar extends BaseController

{
    public function index()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2){
			$model=new M_model();
            $data['title']='Data Barang Keluar';
			$kui['kunci']='print_keluar';
            echo view('partial/header_datatable',$data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('filter_keluar',$kui);
            echo view('partial/footer_datatable');    
		}else{
			return redirect()->to('/login');
		}
	}
    public function print_windows()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2){
    $model = new M_model();
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $kui['duar'] = $model->filtersip('detail_penjualan', $awal, $akhir);
    echo view('v_sip', $kui);
}else{
	return redirect()->to('login');
}
	}
    public function pdf()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2  ){
		$model = new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $kui['duar'] = $model->filtersip('detail_penjualan', $awal, $akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('v_sip',$kui));
		$dompdf->setPaper('A4','potrait');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
	}else{
		return redirect()->to('/login');
	}
	}
    public function excel()
    {
        if(session()->get('level') == 1 || session()->get('level') == 2){
            $model = new M_model();
            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');
            $data = $model->filtersip('detail_penjualan', $awal, $akhir);
    
            $spreadsheet = new Spreadsheet();
    
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID Penjualan')
                ->setCellValue('B1', 'Nama Barang')
                ->setCellValue('C1', 'Jumlah')
                ->setCellValue('D1', 'Subtotal');
    
            $column = 2;
            $grandTotal = 0; // Initialize the grand total
    
            foreach ($data as $data) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $data->id)
                    ->setCellValue('B' . $column, $data->nama_brg)
                    ->setCellValue('C' . $column, $data->jumlah)
                    ->setCellValue('D' . $column, $data->subtotal);
    
                $grandTotal += $data->subtotal; // Add the subtotal to the grand total
                $column++;
            }
    
            // Display the total in the last row
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, 'Total:')
                ->setCellValue('D' . $column, $grandTotal);
    
            $writer = new XLsx($spreadsheet);
            $fileName = 'Data Laporan Barang Keluar';
    
            header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
            header('Cache-Control: max-age=0');
    
            $writer->save('php://output');
        } else {
            return redirect()->to('/login');
        }
    }
    
}