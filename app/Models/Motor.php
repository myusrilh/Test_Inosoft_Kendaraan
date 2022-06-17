<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'motors';
    protected $fillable =['tipe_suspensi','tipe_transmisi','mesin'];
}
