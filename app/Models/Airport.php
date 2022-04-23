<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "code";
    public $incrementing = false;
    protected $keyType = 'string';
}
