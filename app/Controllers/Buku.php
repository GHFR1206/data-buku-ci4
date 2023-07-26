<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\UsersModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $userModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data_user = $this->userModel->getUsers(user_id());
        $currentPage = $this->request->getVar('page_buku') ? $this->request->getVar('page_buku') : 1;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $buku = $this->bukuModel->search($keyword);
        }else {
            $buku = $this->bukuModel;
        }

        $data = [
            'title' => 'Daftar Buku | Programming GHFR',
            'buku' => $buku->paginate(5, 'buku'),
            'pager' => $this->bukuModel->pager,
            'currentPage' => $currentPage,
            'user' => $data_user
        ];;
        return view('buku/index',$data);
    }

    public function detail($slug)
    {
        $data_user = $this->userModel->getUsers(user_id());
        $data = [
            'title' => 'Detail Buku | Programming GHFR',
            'buku' => $this->bukuModel->getBuku($slug),
            'user' => $data_user 
        ];

        return view('buku/detail',$data);
    }

    public function create()
    {   
        $data_user = $this->userModel->getUsers(user_id());
        $data = [
            'title'=>'Tambah Buku | Programming GHFR',
            'validation'=> \Config\Services::validation(),
            'user' => $data_user
        ];

        return view('buku/create',$data);

    }
    
    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul]',
                'errors' => [
                    'required'=>'{field} harus diisi',
                    'is_unique'=>'{field} sudah terdaftar',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} harus diisi',
                    'is_unique'=>'{field} sudah terdaftar',
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} harus diisi',
                    'is_unique'=>'{field} sudah terdaftar',
                ]
            ],
            'sampul' => [
                'rules' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image'=>'Pastikan file berupa gambar',
                    'mime_in'=>'Mohon gambar berupa JPG/JPEG/PNG',
                ]
            ],
        ])){
            // $validation = \Config\Services::validation();
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->to('/create')->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError()==4) {
            $namaSampul = 'default.jpg';
        }else{
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
        }
        
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'judul'=>$this->request->getVar('judul'),
            'slug'=>$slug,
            'kelas'=>$this->request->getVar('kelas'),
            'penulis'=>$this->request->getVar('penulis'),
            'penerbit'=>$this->request->getVar('penerbit'),
            'sampul'=>$namaSampul,
        ]);

        session()->setFlashdata('tambah', '"'. $this->request->getVar('judul') .'" Berhasil ditambahkan');

        return redirect()->To('/buku');
    }

    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);
    if ($buku['sampul'] != 'default.jpg') {
            unlink('img/'.$buku['sampul']);
        }
        $this->bukuModel->delete($id);
        session()->setFlashdata('hapus', 'Buku berhasil dihapus');
        return redirect()->to('/buku');
    }

    public function edit($slug)
    {
        $data_user = $this->userModel->getUsers(user_id());
        $data = [
            'title'=>'Edit Buku | Programming GHFR',
            'validation'=> \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($slug),
            'user' => $data_user
        ];

        return view('buku/edit',$data);
    }

    public function update($id)
    {
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        }else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required'=>'{field} Harus Diisi',
                    'is_unique'=>'{field} Harus Unik',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} Harus Diisi',
                    'is_unique'=>'{field} Harus Unik',
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} Harus Diisi',
                    'is_unique'=>'{field} Harus Unik',
                ]
            ],
            'sampul' => [
                'rules' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image'=>'Pastikan file berupa gambar',
                    'mime_in'=>'Mohon gambar berupa JPG/JPEG/PNG',
                ]
            ],
        ])){
            // $validation = \Config\Services::validation();
            return redirect()->to('/buku/edit/'. $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        }else{
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
            unlink('/img/'. $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'id'=>$id,
            'judul'=>$this->request->getVar('judul'),
            'slug'=>$slug,
            'kelas'=>$this->request->getVar('kelas'),
            'penulis'=>$this->request->getVar('penulis'),
            'penerbit'=>$this->request->getVar('penerbit'),
            'sampul'=>$namaSampul,
        ]);

        session()->setFlashdata('ubah','Buku berhasil diubah');

        return redirect()->to('/buku');
    }
}
