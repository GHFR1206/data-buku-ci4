<?php

namespace App\Models;

use CodeIgniter\Model;

class ParkirModel extends Model
{
    protected $table = 'parkir';
    protected $userTimeStamps = true;
    protected $allowedFields=['no_kendaraan', 'kode_unik', 'merk', 'tipe', 'waktu_masuk', 'status', 'waktu_keluar', 'tarif','gambar'];

    public function getKendaraan($no_kendaraan=false)
    {
        if ($no_kendaraan == false) {
            return $this->findAll();
        }

        return $this->where(['no_kendaraan' => $no_kendaraan])->first();
    }

    public function search($keyword)
    {
        return $this->table('parkir')->like('no_kendaraan', $keyword)->orLike('merk', $keyword)->orLike('tipe', $keyword);
    }

    public function count($field, $syarat)
    {

        return $this->table('parkir')->where($field, 'Aktif')->selectCount($field)->first();
    }
}
