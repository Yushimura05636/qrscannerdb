<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'gender',
        'qr_code',
        'token',
        'password',
    ];

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
