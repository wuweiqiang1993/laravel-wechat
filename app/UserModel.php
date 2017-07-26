<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function addUser($message)
    {
        DB::beginTransaction();
        $this->insert($message);
        DB::commit();
    }
}
