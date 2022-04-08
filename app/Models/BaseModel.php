<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * User: gifary
 * Date: 11/12/18
 * Time: 1:41 PM
 */

class BaseModel extends Model
{
    Use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded =['_token','id'];
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    public $keyType='string';

    /**
     * @var array
     */
    protected static $relatedTable=[];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        $relations = static::$relatedTable;
        static::deleting(function($model)use($relations) {
            foreach ($relations as $relation){
                if(method_exists($model,$relation)){
                    try{
                        if(method_exists($model->{$relation}(),'detach')){
                            $model->{$relation}()->detach();
                        }else{
                            $model->{$relation}()->delete();
                        }
                    }catch (Exception $exception){
                        Log::error('error deleted relation table',['message'=>$exception->getMessage()]);
                    }
                }
            }
        });

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
