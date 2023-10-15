<?php

namespace App\Controllers;

use App\Models\Modelmahasiswa;
use App\Models\Modeldatamahasiswa;
use Config\Services;

class Mahasiswa extends BaseController
{
    // public function hash() {
    //     echo password_hash('admin',PASSWORD_BCRYPT);
    // }
    public function index(): string
    {
       
        // var dumb 
        // return d($mhs->findAll());
        return view('mahasiswa/viewtampildata');
    }

    public function ambildata()  {
            if($this->request->isAJAX()){
                $data = [
                    'dataMhs' => $this->mhs->findAll()
                ];

                $msg=[
                    'data'=> view('mahasiswa/datamahasiswa',$data)
                ];
                echo json_encode($msg);

            }else{
                exit("Maaft tidak dapat diproses");
            }
    }

    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatamahasiswa($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tombolEdit ="<button type=\"button\" class=\"btn btn-info btn-sm\" onclick=\"edit('".$list->nohp."')\">
                <i class=\"fa fa-tags\"></i>
                </button>" ;
                $tombolHapus ="<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('".$list->nohp."')\">
                <i class=\"fa fa-trash\"></i>
                </button>";
                $tombolUpload ="<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"upload('".$list->nohp."')\">
                <i class=\"fa fa-image\"></i>
                </button>";
                //column yang akan ditampilkan
                $row[] = "      <input type=\"checkbox\" name=\"nohp[]\" class=\"centangNobp\" value=\"$list->nohp>\">";
                $row[] = $no;
                $row[] = $list->nohp;
                $row[] = $list->nama;
                $row[] = $list->tmplahir;
                $row[] = $list->tgllahir;
                $row[] = $list->jenkel;
                $row[] = $list->prodinama;
                $row[] = $tombolEdit ." ". $tombolHapus." ". $tombolUpload;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
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

                  

                    $this->mhs->insert($simpanData);

                    $msg =[
                        "sukses" => 'Data Mahasiswa berhasil tersimpan'
                    ];
                }
                
                
        echo json_encode($msg);
        }else{
            exit("Maaf tidak dapat diproses");
        }
    }

    public function formedit(){
        if($this->request->isAJAX()){
            $nobp = $this->request->getVar('nobp');
            $row = $this->mhs->find($nobp);
            $data = [
                //dikirim ke view -> field
                'nobp'=> $row['nohp'],
                'nama'=> $row['nama'],
                'tempat'=> $row['tmplahir'],
                'tanggal'=> $row['tgllahir'],
                'jenkel'=> $row['jenkel'],
            ];

            $msg =[
                "sukses" => view('mahasiswa/modaledit',$data)
            ];

            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }

    }

    public function updatedata(){
        if($this->request->isAJAX()){
                    $nobp= $this -> request ->getVar('nobp');
                    $simpanData =[
                        //nama field -> inputan
                        'nama'=> $this -> request ->getVar('nama'),
                        'tmplahir'=> $this -> request ->getVar('tempat'),
                        'tgllahir'=> $this -> request ->getVar('tgl'),
                        'jenkel'=> $this -> request ->getVar('jenkel'),
                    ];


                    $this->mhs->update($nobp,$simpanData);

                    $msg =[
                        "sukses" => 'Data Mahasiswa berhasil diupdate'
                    ];
        echo json_encode($msg);
        }else{
            exit("Maaf tidak dapat diproses");
        }

    }

    public function hapus(){
        if($this->request->isAJAX()){
            $nobp= $this -> request ->getVar('nobp');
           

            $this->mhs->delete($nobp);

            $msg =[
                "sukses" => "Data Mahasiswa dengan nobp $nobp berhasil dihapus"
            ];
            echo json_encode($msg);
            }else{
                exit("Maaf tidak dapat diproses");
            }
    }

    public function formtambahbanyak()
    {
        if($this->request->isAJAX()){
            $msg=[
                'data'=> view('mahasiswa/formtambahbanyak')
            ];
            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }
    }
   
    public function simpandatabanyak()
    {
        if($this->request->isAJAX()){

            $nobp = $this->request->getVar('nobp');
            $nama = $this->request->getVar('nama');
            $tempat = $this->request->getVar('tempat');
            $tgl = $this->request->getVar('tgl');
            $jenkel = $this->request->getVar('jenkel');

            $jmldata = count($nobp);

            for ($i=0; $i < $jmldata; $i++) { 
                $this ->mhs->insert([
                    'nohp' => $nobp[$i],
                    'nama' => $nama[$i],
                    'tmplahir' => $tempat[$i],
                    'tgllahir' => $tgl[$i],
                    'jenkel' => $jenkel[$i],
                ]);
            }

            $msg = [
                "sukses"=> "$jmldata Data berhasil disimpan"
            ];
            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }
    }

    public function hapusbanyak(){
        if($this->request->isAJAX()){

            $nobp = $this->request->getVar('nohp');

            $jmldata = count($nobp);

            for ($i=0; $i < $jmldata; $i++) { 
                $this ->mhs->delete($nobp[$i]);
            }

            $msg = [
                "sukses"=> "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }
    }

    public function formupload(){
        if($this->request->isAJAX()){

            $nobp = $this->request->getVar('nobp');

            $data = [
                'nobp' => $nobp
            ];

            $msg =[
                'sukses' => view('mahasiswa/modalupload',$data)
            ];

            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }
    }

    public function doupload() {
        if($this->request->isAJAX()){

            $nobp = $this->request->getVar('nobp');

            $validation = \Config\Services::validation();

            if($_FILES['foto']['name']==NULL && $this->request->getpost('imagecam')==''){
                $msg = ['error'=>'Silahkan pilih satu ya'];
            }

            //upload dengan webcam
           else if($_FILES['foto']['name']==NULL){
                //cek data apakah sudah ada fotonya supaya tdk menumpuk
                $cekdata = $this->mhs->find($nobp);
                $fotolama = $cekdata['foto'];
                if($fotolama != NULL || $fotolama != ""){
                    unlink($fotolama);
                }

                $image = $this->request->getPost('imagecam');
                $image = str_replace('data:image/jpeg;base64,','',$image);

                $image = base64_decode($image,true);

                $filename = $nobp.'.jpg';
                file_put_contents(FCPATH.'/assets/foto/'.$filename,$image);

                $updatedata =[
                    'foto' => './assets/foto/' . $filename 
                ];

                $this->mhs->update($nobp,$updatedata);

                $msg=[
                    'sukses' => 'Berhasil Upload Foto menggunakan Webcam'
                ];

            }else{
                $valid = $this->validate([
                    'foto'=>[
                        'label'=> 'Upload Foto',
                        'rules'=> 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                        'errors'=> [
                            'uploaded'=>'{field} wajib diisi',
                            'mime_in'=>'Harus dalam bentuk gambar, jangan file lain',
                        ]
    
                    ]
                    ]);
    
                if(!$valid){
                    $msg =[
                        'error' => [
                            'foto' => $validation->getError('foto')
                        ]
                    ];
                }
                //upload dari file
                else{
    
                    //cek data apakah sudah ada fotonya supaya tdk menumpuk
                    $cekdata = $this->mhs->find($nobp);
                    $fotolama = $cekdata['foto'];
                    if($fotolama != NULL || $fotolama != ""){
                        unlink($fotolama);
                    }
    
                    $filefoto = $this->request->getFile('foto');
                    $filefoto->move('assets/foto',$nobp.".".$filefoto->getExtension());
                    
                    $updatedata =[
                        'foto' => './assets/foto/' . $filefoto->getName() 
                    ];
    
                    $this->mhs->update($nobp,$updatedata);
                    
                    $msg=[
                        'sukses' => 'Berhasil Upload'
                    ];
                }
            }

  

            echo json_encode($msg);

        }else{
            exit("Maaf tidak dapat diproses");
        }
    }
}
