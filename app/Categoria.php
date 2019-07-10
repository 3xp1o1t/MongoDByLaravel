<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Categoria extends Moloquent
{

    protected $connection = 'mongodb';
    protected $collection = 'categorias';

    protected $fillable = [
        'name', 'description', 'status'
    ];
    
}
