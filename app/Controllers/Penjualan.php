<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\DetailPenjualanModel;

use App\Models\M_barang;
use App\Models\M_model;

class Penjualan extends BaseController
{
    
    public function index()
    {
        $model=new M_model();
        $on='penjualan.id_user=user.id_user';
        $data['jojo']=$model->join2('penjualan','user', $on);
        $data['title']='Data Penjualan';

        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('penjualan/view', $data);
        echo view('partial/footer_datatable');
    }
    private function calculateSubtotal($idBarang, $jumlah)
    {
        // Ambil model BarangModel (gantilah dengan nama model sesuai kebutuhan)
        $barangModel = new M_barang();
    
        // Ambil data barang berdasarkan $idBarang
        $barangData = $barangModel->where('id_barang', $idBarang)->first();
    
        // Pastikan data barang ditemukan
        if ($barangData) {
            // Ambil harga dari data barang
            $harga = $barangData['harga'];
    
            // Hitung subtotal
            return $harga * $jumlah;
        } else {
            // Handle ketika data barang tidak ditemukan, bisa dikembalikan dengan nilai default atau pesan error
            return 0;
        }
    }
    public function save()
    {
        // Lakukan validasi input
        // ...
    
        // Simpan data penjualan
        $penjualanModel = new PenjualanModel();
        // ...
    
        // Simpan detail penjualan
        $detailPenjualanModel = new DetailPenjualanModel();
        $idPenjualan = $this->request->getPost('id_penjualan');
        $idBarang = $this->request->getPost('id_barang');
        $jumlah = $this->request->getPost('jumlah');
    
        $total = 0;
    
        foreach ($idBarang as $key => $barang) {
            // Calculate subtotal on the server side
            $subtotal = $this->calculateSubtotal($barang, $jumlah[$key]);
            
            $total += $subtotal;
    
            $detailPenjualanModel->insert([
                'id_penjualan' => $idPenjualan,
                'id_barang' => $barang,
                'jumlah' => $jumlah[$key],
                'subtotal' => $subtotal,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    
        $penjualanModel->update($idPenjualan, ['total' => $total]);
    
        return redirect()->to('/penjualan')->with('success', 'Penjualan berhasil disimpan');
    }
   // Controller (Penjualan.php)
public function add($id_penjualan)
{
    $model = new M_model();
    $data['title']='Data Penjualan';
    $data['id_penjualan'] = $id_penjualan;
    $data['a'] = $model->tampil('barang');
    echo view('partial/header_datatable', $data);
    echo view('partial/side_menu');
    echo view('partial/top_menu');
    echo view('penjualan/form', $data);
    echo view('partial/footer_datatable');
}
public function tambah()
{
   
    
    
    $data1=array(
        'tanggal'=>date('Y-m-d H:i:s'),
        'id_user'=>session()->get('id'),
        'total'=>'0',
        'created_at' => date('Y-m-d H:i:s')
    );
    $model=new M_model();
    $model->simpan('penjualan', $data1);
   
    return redirect()->to('penjualan');
}
public function detail($id_penjualan) {
    // Load model PenjualanModel
    $penjualanModel = new DetailPenjualanModel();
    $data['title'] = 'Detail Penjualan';

    // Mengambil data penjualan dari model berdasarkan ID
    $data['penjualan'] = $penjualanModel->getPenjualanById($id_penjualan);

    echo view('partial/header_datatable', $data);
    echo view('partial/side_menu');
    echo view('partial/top_menu');
    echo view('penjualan/detail_penjualan', $data);
    echo view('partial/footer_datatable');
}
public function delete($id)
	{
		$model=new m_model();
		$where=array('id_penjualan'=>$id);
		$model->hapus('penjualan',$where);
		return redirect()->to('/penjualan');
	}
    public function delete_d($id)
	{
		$model=new m_model();
		$where=array('id'=>$id);
		$model->hapus('detail_penjualan',$where);
		return redirect()->to('/penjualan');
	}
    public function printNota($id_penjualan)
    {
        $penjualanModel = new DetailPenjualanModel();
   

    // Mengambil data penjualan dari model berdasarkan ID
    $data['penjualan'] = $penjualanModel->getPenjualanById($id_penjualan);

        $dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('nota',$data));
		$dompdf->setPaper('A4','potrait');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
      
    }
}
