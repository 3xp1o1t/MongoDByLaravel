<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index(Request $request){
        $filtro = $request->filtro;
        $buscar = $request->buscar;

        if($buscar == ''){
            
            $categorias = DB::collection('categorias')->orderBy('nombre', 'asc')->paginate(10);                
                
        }else{
            $categorias = DB::collection('categorias')->where($filtro, 'like', '%'. $buscar . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(10);
        }
        $result = [
            'pagination' => [
                'total'        => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page'     => $categorias->perPage(),
                'last_page'    => $categorias->lastPage(),
                'from'         => $categorias->firstItem(),
                'to'           => $categorias->lastItem(),
            ],
            'categorias' => $categorias
        ];

        return $result;
    }

    public function store(Request $request){
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = true;
        $categoria->save();
    }

    public function update(Request $request){
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
    }

    public function desactivar(Request $request){
        $categoria = Categoria::findOrFail($request->id);
        $categoria->estado = false;
        $categoria->save();
    }

    public function activar(Request $request){
        $categoria = Categoria::findOrFail($request->id);
        $categoria->estado = true;
        $categoria->save();
    }

}
