<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folders extends Model
{ 
	protected $fillable = [
        'code', 'name'
    ];
    
    public function papers()
    {
        return $this->hasMany('App\Papers', 'folder_id');
    }
}
