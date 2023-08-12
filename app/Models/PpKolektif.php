<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpKolektif extends Model
{
    protected $table ="ppkolektif";
    protected $guarded = [];
    use HasFactory;

    public function bukus(){
        return $this->hasMany(DataBuku::class);
    }
}
