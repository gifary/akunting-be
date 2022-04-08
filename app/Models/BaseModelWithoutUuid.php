<?php
/**
 * Created by PhpStorm.
 * User: gifary
 * Date: 12/20/18
 * Time: 2:34 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Model ini digunakan jika primary key dari model ber type integer
 * Class BaseModelWithoutUuid
 * @package App\Models
 */
class BaseModelWithoutUuid extends Model
{
    protected $guarded =['_token','id'];
}
