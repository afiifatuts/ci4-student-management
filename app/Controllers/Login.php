<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        return view('login/index');
    }

    public function cekuser() {
        if($this->request->isAJAX()){
            $userid = $this->request->getVar('userid');
            $pass = $this->request->getVar('pass');

            $validation = \Config\Services::validation();

            $valid = $this ->validate([
                'userid'=>[
                    'label'=>'ID User',
                    'rules'=>'required',
                    'errors'=> [
                        'required'=> '{field} tidak boleh kosong'
                    ]
                    ],
                'pass'=>[
                        'label'=>'Password',
                        'rules'=>'required',
                        'errors'=> [
                            'required'=> '{field} tidak boleh kosong'
                        ]
                        ],
            ]);

            if(!$valid){
                $msg =[
                    //ini adalah data json yang kita kirimkan
                    'error'=>[
                        'userid' => $validation->getError('userid'),
                        'password' => $validation->getError('pass'),
                    ]
                    ];

                    echo json_encode($msg);
            }
        }
    }
}
