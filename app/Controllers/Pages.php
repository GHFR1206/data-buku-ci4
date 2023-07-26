<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Pages extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data_user = $this->userModel->getUsers(user_id());

        $data = [
            'title'=>'Web | Programming GHFR',
            'user' => $data_user
        ];
        return view('/pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title'=>'About | Programming GHFR',
            'breadcrumb' => [
                'Home' => '/',
                'About' => '/pages/about',
            ]
        ];

        return view('/pages/about',$data);
    }
    public function contact()
    {
        $data = [
            'title'=>'Contact | Programming GHFR',
            'alamat'=> [
                [
                    'tipe'=>'Rumah',
                    'alamat'=>'Ciherang',
                    'kab'=>'Bogor',
                    'provinsi'=>'Jawa Barat'
                ],
                [
                    'tipe'=>'Sekolah',
                    'alamat'=>'Ciomas',
                    'kab'=>'Bogor',
                    'provinsi'=>'Jawa Barat'
                ]
            ],
            'breadcrumb' => [
                'Home' => '/',
                'Contact' => '/pages/contact',
            ]
        ];

        return view('/pages/contact',$data);
    }


}
