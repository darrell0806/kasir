<?php

namespace App\Models;
use CodeIgniter\Model;

class M_barang extends Model
{		
	protected $table      = 'barang';
	protected $primaryKey = 'id_barang';
	protected $allowedFields = ['fotob','nama_brg', 'stock', 'harga', 'created_at'];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;

    public function tampil($table) {
        return $this->db->table($table)
        ->orderBy('created_at', 'desc')
        ->where('barang.deleted_at', null)
        ->get()
        ->getResult();
    }

	public function qedit($table, $data, $where)
	{
		return $this->db->table($table)->update($data, $where);
	}


	
    public function getById($id)
    {
        $data = $this->find($id);
        if (!$data) {
            throw new \Exception('Data not found');
        }
        return $data;
    }

    public function updatet($id, $data)
    {
        return $this->update($id, $data);
    }
    public function insertt($data, $photo)
{
    if ($photo && $photo->isValid()) {
        $imageName = $photo->getRandomName();
        $photo->move(ROOTPATH . 'public/images', $imageName);
        $data['fotob'] = $imageName;
    } else {
        $data['fotob'] = 'default.png'; 
    }
   
    return $this->insert($data);
}
    public function updateP($id, $data, $photo)
    {
        $findd = $this->find($id);
        $currentImage = $findd['foto'];
        if ($photo != null) {
            $newImageName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/images', $newImageName);
            $data['fotob'] = $newImageName;
        } else {
            $data['fotob'] = $currentImage;
        }
        return $this->update($id, $data);
    }

    public function deletee($id)
    {
        return $this->delete($id);
    }
    public function getWhere($table, $where){
		return $this->db->table($table)->getWhere($where)->getRow();
	}
  
}