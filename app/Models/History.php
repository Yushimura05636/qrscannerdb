<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'person_id',
        'timeIn',
        'timeOut',
        'date'
    ];

    public function person()
    {
        return $this->belongsTo(People::class);
    }
}
