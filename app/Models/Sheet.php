<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folder;

class Sheet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'folder_id',
        'title',
        'code',
        'description',
        'language'
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

}
