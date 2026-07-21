<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table = 'promo';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'pourcentage',
    ];

    protected $useTimestamps = false;
}
