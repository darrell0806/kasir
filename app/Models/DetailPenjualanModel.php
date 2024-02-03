<?php

namespace App\Models;

use CodeIgniter\Model;



class DetailPenjualanModel extends Model
{
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_penjualan', 'id_barang', 'jumlah', 'subtotal'];
    
    public function getPenjualanById($id) {
        return $this->join('barang', 'barang.id_barang = detail_penjualan.id_barang')
                    ->where('id_penjualan', $id)
                   -> findAll();
    }
    public function getDetailPenjualanById($id)
    {
        return $this->join('barang', 'barang.id_barang = detail_penjualan.id_barang')
        ->where('id_penjualan', $id)
       ->find($id);
    }

    // Metode untuk mengambil total penjualan berdasarkan ID penjualan
    public function getTotalPenjualan($id_penjualan)
    {
        $detail_penjualan = $this->where('id_penjualan', $id_penjualan)->findAll();

        $total = 0;
        foreach ($detail_penjualan as $row) {
            $total += ($row['harga'] * $row['jumlah']);
        }

        return $total;
    }
    public function hapus($table, $where){
        return $this->db->table($table)->delete($where);
    }
    // Metode untuk mengupdate total penjualan berdasarkan ID penjualan
    public function updateTotalPenjualan($id_penjualan, $total_penjualan_baru)
    {
        $data = ['total' => $total_penjualan_baru];
        $this->where('id_penjualan', $id_penjualan)->update($data);
    }
}
