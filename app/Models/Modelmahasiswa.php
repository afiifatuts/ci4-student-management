<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmahasiswa extends Model{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'nohp';

    //field yang wajib diisi
    protected $allowedFields = ['nohp'];

    
}

