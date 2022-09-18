<?php

namespace App\Models;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table 		= 'tokens';
    protected $primaryKey   = 'id';
    public $timestamps      = false;
    // const CREATED_AT     = 'create_dttm';
    // const UPDATED_AT     = 'update_dttm';

}
