<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function __construct()
    {
        //Koneksi ke database
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

            
            }
            if(!$valid){
                $msg =[
                    //ini adalah data json yang kita kirimkan
                    'error'=>[
                        'userid' => $validation->getError('userid'),
                        'password' => $validation->getError('pass'),
                    ]
                    ];

                }else{
                    //cek user dulu ke database 
                    $query_cekuser = $this->db->query("SELECT * FROM users JOIN levels ON levelid=userlevelid WHERE userid= '$userid'");

                    $result = $query_cekuser->getResult();

                    if(count($result)>0){
                        //lanjutkan
                        $row = $query_cekuser ->getRow();
                        $password_user = $row->userpass;

                        if(password_verify($pass, $password_user)){
                            //lanjutkan(buat session untuk menyimpan user login)
                            $simpan_session = [
                                'login'=>true,
                                'iduser'=>$userid,
                                'namauser'=>$row->usernama,
                                'idlevel'=>$row->userlevelid,
                                'namalevel'=>$row->levelnama,
                            ];
                            //menyimpan session
                            $this->session->set($simpan_session);
                            $msg=[
                                'sukses'=>[
                                    'link'=>'mahasiswa'
                                ]
                                ];
                        }else{
                            $msg=[
                                'error'=>[
                                    'password'=>'Maaf password anda salah'
                                ]
                            ];
                        }

                    }else{
                        $msg = [
                            'error'=>[
                                'userid'=>'Maaf ID User tidak ditemukan'
                            ]
                            ];
                    }
                }

                
                echo json_encode($msg);
    }

    public function keluar() {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
