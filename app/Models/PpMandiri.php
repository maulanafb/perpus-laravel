<?php

namespace App\Models;

use App\Models\Databuku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PpMandiri extends Model
{
    protected $table ="ppmandiri";
    protected $guarded = [];
    use HasFactory;

    public function bukus(){
        return $this->hasMany(Databuku::class);
    }
}
