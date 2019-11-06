<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Adminuser extends Model
{
    protected $table = 'admin_users';

    public function profile()
    {
        return $this->hasOne(Information::class);
    }
}
