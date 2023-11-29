<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengunjung extends Model
{
    use HasFactory;
    protected $table = "datapengunjung";
    protected $guarded = [];
    // Definisikan relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}