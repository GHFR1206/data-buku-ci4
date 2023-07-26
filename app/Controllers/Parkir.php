<?php

namespace App\Controllers;

use App\Models\ParkirModel;
use App\Models\UsersModel;

class parkir extends BaseController
{
    protected $parkirModel;
    protected $userModel;

    public function __construct()
    {
        $this->parkirModel = new ParkirModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data_user = $this->userModel->getUsers(user_id());
        $currentPage = $this->request->getVar('page_parkir') ? $this->request->getVar('page_parkir') : 1;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $parkir = $this->parkirModel->search($keyword);
        }else {
            $parkir = $this->parkirModel;
        }

        $data = [
            'title' => 'Parking Dashboard | GHFR-ParkNet.id',
            'parkir' => $parkir->paginate(5, 'parkir'),
            'pager' => $this->parkirModel->pager,
            'currentPage' => $currentPage,
            'user' => $data_user,
            'status' => $this->parkirModel->count('status', 'Aktif')
        ];
        return view('parkir/index',$data);
    }

    public function detail($no_kendaraan)
    {
        $data_user = $this->userModel->getUsers(user_id());
        $data = [
            'title' => 'Detail parkir | GHFR-ParkNet.id',
            'parkir' => $this->parkirModel->getKendaraan($no_kendaraan),
            'user' => $data_user 
        ];

        return view('parkir/detail',$data);
    }

    public function create()
    {
        
        $data_user = $this->userModel->getUsers(user_id());
        $data = [
            'title'=>'Add Vehicle | GHFR-ParkNet.id',
            'validation'=> \Config\Services::validation(),
            'user' => $data_user,
        ];

        return view('parkir/create',$data);

    }
    
    public function save()
    {
        if (!$this->validate([
            'no_kendaraan' => [
                'rules' => 'required|is_unique[parkir.no_kendaraan]',
                'errors' => [
                    'required'=>'{field} harus diisi',
                    'is_unique'=>'{field} sudah terdaftar',
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} harus diisi',
                    'is_unique'=>'{field} sudah terdaftar',
                ]
            ],
            'tipe' => [
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} harus diisi',
                    'is_unique'=>'{field} sudah terdaftar',
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->to('/parkir/create')->withInput();
        }
        $no_kendaraan = url_title($this->request->getVar('no_kendaraan'), '-', false);
        
        $generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $kode_unik = substr(str_shuffle($generator),0,8);

        date_default_timezone_set('Asia/Jakarta');
        $waktu_masuk = date("Y-m-d H:i:s");

        if ($this->request->getVar('tipe') == 'Motor') {
            $gambar = "motor.png";
        }elseif ($this->request->getVar('tipe') == 'Mobil') {
            $gambar = "mobil.png";
        }else{
            $gambar = "truk.png";
        }

        $this->parkirModel->save([
            'no_kendaraan'=> $no_kendaraan,
            'kode_unik'=>$kode_unik,
            'tipe'=>$this->request->getVar('tipe'),
            'merk'=>$this->request->getVar('merk'),
            'status'=>$this->request->getVar('status'),
            'waktu_masuk' => $waktu_masuk,
            'waktu_keluar'=>$this->request->getVar('waktu_keluar'),
            'gambar' => $gambar
        ]);

        session()->setFlashdata('tambah', '"'. $this->request->getVar('no_kendaraan') .'" Berhasil ditambahkan');

        return redirect()->To('/parkir');
    }

    public function delete($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu_keluar = date("Y-m-d H:i:s");
        $this->parkirModel->update($id, [
            'waktu_keluar'=>$waktu_keluar,
            'status'=> 'Selesai',
        ]);
        session()->setFlashdata('hapus', 'Kendaraan berhasil keluar');
        return redirect()->to('/parkir');
    }
}
