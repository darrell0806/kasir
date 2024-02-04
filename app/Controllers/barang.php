<?php

namespace App\Controllers;
use App\Models\M_model;
use App\Models\M_barang;

class barang extends BaseController
{
    public function index()
    {
      
        $model=new M_barang();
        $data['jojo']=$model->tampil('barang');
        $data['title']='Data Barang';

        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('barang/view', $data);
 
}

public function create()
{
   
       
        $data['title']='Data Barang';
        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('barang/tambah', $data); 
        echo view('partial/footer_datatable');
    
}
public function aksi_create()
{
    if(session()->get('level')==1||  session()->get('level')==2){
    $Model= new M_barang();
    $data = $this->request->getPost();
    $photo = $this->request->getFile('fotob');
    $Model->insertt($data, $photo);
    return redirect()->to('/barang');
}else{
    return redirect()->to('Login');
}
}
public function edit($id)
{ 
    
        $model=new M_barang();
        $where=array('id_barang'=>$id);
        $data['jojo']=$model->getWhere('barang',$where);
      
        $data['title']='Data Barang';
        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('barang/edit',$data);
        echo view('partial/footer_datatable');    
    
}

public function aksi_edit()
{ 
    
       
        $Model = new M_barang();
        $data = $this->request->getPost();
        $photo = $this->request->getFile('fotob');
    
       
        if ($photo->isValid() && ! $photo->hasMoved()) {
           
            $Model->updateP($id, $data, $photo);
        } else {
           
            $Model->update($id, $data);
        }
    
        return redirect()->to('/barang');
   
    }

public function delete($id)
{ 
    {
       
        $Model = new M_barang();
        $Model->deletee($id);
        return redirect()->to('/barang');
   
    }
}


}