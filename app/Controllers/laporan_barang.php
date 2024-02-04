<?php

namespace App\Controllers;
use App\Models\M_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class laporan_barang extends BaseController

{
    public function index()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2){
			$model=new M_model();
            $data['title']='Data barang';
			$kui['kunci']='print_barang';
            echo view('partial/header_datatable',$data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('filter_barang',$kui);
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
    $kui['duar'] = $model->filterbku('barang', $awal, $akhir);
    echo view('v_brg', $kui);
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
        $kui['duar'] = $model->filterbku('barang', $awal, $akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('v_brg',$kui));
		$dompdf->setPaper('A4','potrait');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
	}else{
		return redirect()->to('/login');
	}
	}
    public function excel()
	{
		if(session()->get('level')==1 ||  session()->get('level')==2){
		$model=new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $data= $model->filterbku('barang', $awal, $akhir);
        

		$spreadsheet=new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID Barang')
		->setCellValue('B1', 'Nama Barang')
		->setCellValue('C1', 'Stock')
		->setCellValue('D1', 'Harga');
      
	

		$column=2;
		

		foreach($data as $data){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'. $column, $data->id_barang)
			->setCellValue('B'. $column, $data->nama_brg)
			->setCellValue('C'. $column, $data->stock)
			->setCellValue('D'. $column, $data->harga);
            
		
			$column++;
		}
	

		$writer = new XLsx($spreadsheet);
		$fileName = 'Data Laporan Barang';


		header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition:attachment;filename='.$fileName.'.xls');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}else{
		return redirect()->to('/login');
	}
	}
}