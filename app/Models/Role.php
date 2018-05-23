<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 08/05/18
 * Time: 18.21
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = false;
}