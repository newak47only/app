<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
   
    //
    protected $table = 'informations';
    public function adminuser()
    {
        return $this->belongsTo(Adminuser::class);
    }
}
