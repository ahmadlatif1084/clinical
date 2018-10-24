<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'todos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function scopePriortize($query){
        return $query->orderBy('priorty','asc');
    }

}
