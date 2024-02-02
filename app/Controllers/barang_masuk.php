<?php

namespace App\Controllers;
use App\Models\M_model;
use App\Models\M_masuk;

class barang_masuk extends BaseController
{
    public function index()
    {
       if(session()->get('level')== 1) {
        $model=new M_masuk();
        $on='masuk.id_barang=barang.id_barang';
        $on1='masuk.id_user=user.id_user';
        $data['jojo']=$model->join3('masuk', 'barang', 'user', $on,$on1);
        $data['title']='Data Barang Masuk';

        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('masuk/view', $data);
        echo view('partial/footer_datatable');
    }else {
        return redirect()->to('login');
    }
}

public function create()
{
    $model=new M_masuk();
    $data['a'] = $model->tampil('barang');
       
        $data['title']='Data Barang Masuk';
        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('masuk/tambah', $data); 
        echo view('partial/footer_datatable');
    
}
public function aksi_create()
{
    if(session()->get('level')==1||  session()->get('level')==2){
    $Model= new M_masuk();
    $data = $this->request->getPost();
   
    $Model->insertt($data);
    return redirect()->to('/barang_masuk');
}else{
    return redirect()->to('Login');
}
}


public function delete($id)
{ 
    
        if(session()->get('level')==1){
            $model=new m_model();
            $where=array('id_masuk'=>$id);
            $model->hapus('masuk',$where);
            return redirect()->to('/barang_masuk');
    }else{
        return redirect()->to('Login');
    }
    
}

}