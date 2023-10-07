<?php

namespace App\Controllers;

use App\Models\Modelmahasiswa;

class Mahasiswa extends BaseController
{
    public function index(): string
    {
        $mhs = new Modelmahasiswa;
        $data = [
            'dataMhs' => $mhs->findAll()
        ];
        // var dumb 
        // return d($mhs->findAll());
        return view('mahasiswa/viewtampildata', $data);
    }
}
