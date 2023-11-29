<?php

namespace App\Models;

use App\Models\Databuku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PpMandiri extends Model
{
    protected $table = "ppmandiri";
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