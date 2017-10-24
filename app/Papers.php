<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Papers extends Model
{
	protected $fillable = [
        'folder_id', 'reference_code', 'title', 'context'
    ];

    public function folder()
    {
        return $this->belongsTo(Folders::class, 'folder_id');
    }
}
