<?php

namespace App\Controllers;

use App\Models\Modelmahasiswa;

class Mahasiswa extends BaseController
{
    public function index(): string
    {
       
        // var dumb 
        // return d($mhs->findAll());
        return view('mahasiswa/viewtampildata');
    }

    public function ambildata()  {
            if($this->request->isAJAX()){
                $mhs = new Modelmahasiswa;
                $data = [
                    'dataMhs' => $mhs->findAll()
                ];

                $msg=[
                    'data'=> view('mahasiswa/datamahasiswa',$data)
                ];
                echo json_encode($msg);

            }else{
                exit("Maaft tidak dapat diproses");
            }
    }

    public function formtambah()
    {
        if($this->request->isAJAX()){
            $msg=[
                'data'=> view('mahasiswa/modaltambah')
            ];
            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }
    }

    public function simpandata()
    {
        if($this->request->isAJAX()){

            //tambahkan library service validasi 
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                //tangkap name dari inputan kita
                'nobp'=>[
                    //beberapa role 
                    'label' => 'Nomor BP',
                    //rulesnya lalu nama db dan tablenya
                    'rules' => 'required|is_unique[mahasiswa.nohp]',
                    //handle errornya
                    'errors'=>[
                        'required'=>'{field} tidak boleh kosong',
                        'is_unique'=>'{field} tidak boleh ada yang sama, silahkan coba yang lain'
                    ]
                    ],
                    'nama'=>[
                        //beberapa role 
                        'label' => 'Nama Mahasiswa',
                        //rulesnya 
                        'rules' => 'required',
                        //handle errornya
                        'errors'=>[
                            'required'=>'{field} tidak boleh kosong'
                        ]
                    ]
             ]);
            
            //jika validasinya salah 
            if(!$valid){

                $msg =[
                    'error'=>[
                        'nobp'=>$validation->getError('nobp'),
                        'nama'=>$validation->getError('nama')
                    ]
                    ];
                } else{
                    $simpanData =[
                        //nama field -> inputan
                        'nohp'=> $this -> request ->getVar('nobp'),
                        'nama'=> $this -> request ->getVar('nama'),
                        'tmplahir'=> $this -> request ->getVar('tempat'),
                        'tgllahir'=> $this -> request ->getVar('tgl'),
                        'jenkel'=> $this -> request ->getVar('jenkel'),
                    ];

                    $mhs = new Modelmahasiswa;

                    $mhs->insert($simpanData);

                    $msg =[
                        "sukses" => 'Data Mahasiswa berhasil tersimpan'
                    ];
                }
                
                
        echo json_encode($msg);
        }else{
            exit("Maaf tidak dapat diproses");
        }
    }
}
