<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 25/05/18
 * Time: 01.28
 */

namespace App\Models;




use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='users';
    protected $primaryKey='id';
    public $timestamps=false;

}