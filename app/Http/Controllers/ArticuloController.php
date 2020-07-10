<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticuloFormRequest;
use DB;

class ArticuloController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
           $query = $request->searchText;

            $articulos = Articulo::where('nombre', 'LIKE', '%'.$query.'%')->orwhere('codigo', 'LIKE', '%'.$query.'%')->orderBy('id', 'desc')->paginate(5);
               
            return view('almacen.articulo.index', compact('articulos', 'query')); 
        
        
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::where('condicion', 1)->get();

        return view("almacen.articulo.create", compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloFormRequest $request)
    {
        $articulo = new Articulo();

        $articulo->nombre = $request->nombre;
        $articulo->categoria_id = $request->categoria_id;
        $articulo->codigo = $request->codigo;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->estado = 'Activo';

        if ($archivo = $request->file('imagen')) {
            
            $nombre = $archivo->getClientOriginalName();

            $archivo->move('images/articulos', $nombre);

            $articulo->imagen = $nombre;

        }

        $articulo->save();

        return redirect('almacen/articulo');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulo::findOrFail($id);

        return view('almacen.articulo.show', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        $categorias = Categoria::where('condicion', 1)->get();

        return view('almacen.articulo.edit', compact('articulo','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo = Articulo::findOrFail($id);

        $articulo->nombre = $request->nombre;
        $articulo->categoria_id = $request->categoria_id;
        $articulo->codigo = $request->codigo;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->estado = 'Activo';

        if ($archivo = $request->file('imagen')) {
            
            $nombre = $archivo->getClientOriginalName();

            $archivo->move('images/articulos', $nombre);

            $articulo->imagen = $nombre;

        }
        
        $articulo->update();

        return redirect('almacen/articulo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);

        $articulo->delete();

        return redirect('almacen/articulo');
    }
}
