<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Editorial extends Moloquent
{
    
    protected $connection = 'mongodb';
    protected $collection = 'editoriales';

    protected $fillable = [
        'nombre', 'descripcion', 'estado'
    ];


}
