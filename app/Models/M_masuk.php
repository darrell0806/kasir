<?php

namespace App\Models;
use CodeIgniter\Model;

class M_masuk extends Model
{		
	protected $table      = 'masuk';
	protected $primaryKey = 'id_masuk';
	protected $allowedFields = ['id_barang','jumlah', 'created_at','id_user','updated_at','deleted_at'];

	protected $useTimestamps = true;

    public function tampil($table) {
        return $this->db->table($table)
        ->orderBy('created_at', 'desc')
        ->get()
        ->getResult();
    }

	public function qedit($table, $data, $where)
	{
		return $this->db->table($table)->update($data, $where);
	}
	
    public function join2($table1, $table2, $on)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->where('masuk.deleted_at', null)
		->orderBy('created_at', 'desc')
		->get()
		->getResult();
	}
    public function join3($table1, $table2,$table3, $on,$on1){
        return $this->db->table($table1)
        ->join($table2, $on, 'left')
        ->join($table3, $on1, 'left')
        ->where('masuk.deleted_at', null)
		->orderBy('masuk.id_masuk', 'desc') 
        ->get()
        ->getResult();
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
    public function insertt($data)
    {
        // Assuming you have a session variable named 'id_user'
        $id_user = session()->get('id');
    
        // Adding id_user to the data array
        $data['id_user'] = $id_user;
       
        return $this->insert($data);
    }
    

    public function updateP($id, $data, $photo)
    {
        $findd = $this->find($id);
       
        return $this->update($id, $data);
    }

    public function deletee($id)
    {
        return $this->db->table($table)->delete($where);
    }
    public function getWhere($table, $where){
		return $this->db->table($table)->getWhere($where)->getRow();
	}
  
}