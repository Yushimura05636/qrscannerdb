<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'description',
        'datetime',
        'person_id'
    ];

    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }
}
