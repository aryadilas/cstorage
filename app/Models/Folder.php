<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sheet;

class Folder extends Model
{
    protected $fillable = [
        'name',
        'lang'
    ];

    public function sheets()
    {
        return $this->hasMany(Sheet::class);    
    }
    
}
