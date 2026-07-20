<?php

namespace App\Models;

use CodeIgniter\Model;

class ProprietaireModel extends Model
{
    protected $table = 'proprietaire';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
    ];

    protected $useTimestamps = false;
}
