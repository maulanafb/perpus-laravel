<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpKolektif extends Model
{
    protected $table = "ppkolektif";
    protected $guarded = [];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function databuku()
    {
        return $this->belongsTo(Databuku::class, 'id_buku');
    }
}