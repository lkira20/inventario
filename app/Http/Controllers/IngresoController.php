<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresoFormRequest;
use App\Ingresos;
use App\Articulo;
use App\Persona;
use App\Detalle_ingreso;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

use App\articulo_ingreso;
class IngresoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    

        $contador = 0;
        $total= 0;
        $totales = [];
        $query = trim($request->searchText);

        $ingresos = Ingresos::where('num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('id', 'desc')
        ->paginate(5);

        while ($contador < count($ingresos)) {
            
            $ing  = $ingresos[$contador];

            foreach ($ing->articulos as $art) 
            {
                $total += $art->pivot->precio_compra;
    
            }

            $totales[$ing->id] = $total; 
            $contador++;
        }
        
        return view('compras.ingreso.index', compact('ingresos', 'query', 'totales')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $personas = Persona::where('tipo_persona', 'Proveedor')->get();

        $articulos = Articulo::where('estado', 'Activo')->get();

        return view('compras.ingreso.create', compact('personas', 'articulos'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngresoFormRequest $request)
    {
        //
        try {

            DB::beginTransaction();

            $ingreso = new Ingresos();

            $ingreso->persona_id = $request->persona_id;
            $ingreso->tipo_comprobante = $request->tipo_comprobante;
            $ingreso->serie_comprobante = $request->serie_comprobante;
            $ingreso->num_comprobante = $request->num_comprobante;
            $mytime = Carbon::now();
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto = '18';
            $ingreso->estado = 'A';

            $ingreso->save();
            //detalles de ingreso ARTICULO
            $articulo_id = $request->articulo_id;
            $cantidad = $request->cantidad;
            $precio_compra = $request->precio_compra;
            $precio_venta = $request->precio_venta;

            $cont = 0;

            while ($cont < count($articulo_id)) {
                
                $detalle = new articulo_ingreso();

                $detalle->ingreso_id = $ingreso->id;
                $detalle->articulo_id = $articulo_id[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();

                $cont = $cont+1;
            }

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollback();
        }

        return Redirect('compras/ingreso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $ingreso = Ingresos::findOrFail($id);

        $detalle = $ingreso->articulos;
        $total = 0;
        foreach ($detalle as $art) {
           $total += $art->pivot->cantidad * $art->pivot->precio_compra;
        }

        return  view('compras.ingreso.show', compact('ingreso', 'detalle', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $ingreso = Ingresos::with('articulos')->findOrFail($id);

        $detalle = $ingreso->articulos;

        $personas = Persona::where('tipo_persona', 'Proveedor')->get();

        $articulos = Articulo::where('estado', 'Activo')->get();

        return view('compras.ingreso.edit', compact('ingreso','detalle','personas', 'articulos'));   

        //return compact('ingreso','detalle','personas', 'articulos');   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IngresoFormRequest $request, $id)
    {
        //
         //
        try {

            DB::beginTransaction();

            $ingreso = Ingresos::findOrFail($id);

            $ingreso->persona_id = $request->persona_id;
            $ingreso->tipo_comprobante = $request->tipo_comprobante;
            $ingreso->serie_comprobante = $request->serie_comprobante;
            $ingreso->num_comprobante = $request->num_comprobante;
            $mytime = Carbon::now();
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto = '18';
            $ingreso->estado = 'A';

            $ingreso->save();
            //detalles de ingreso ARTICULO
            $articulo_id = $request->articulo_id;
            $cantidad = $request->cantidad;
            $precio_compra = $request->precio_compra;
            $precio_venta = $request->precio_venta;

            $cont = 0;

            while ($cont < count($articulo_id)) {
                
                $detalle = articulo_ingreso::where('ingreso_id', $ingreso->id);

                $detalle[$cont]->ingreso_id = $ingreso->id;
                $detalle[$cont]->articulo_id = $articulo_id[$cont];
                $detalle[$cont]->cantidad = $cantidad[$cont];
                $detalle[$cont]->precio_compra = $precio_compra[$cont];
                $detalle[$cont]->precio_venta = $precio_venta[$cont];
                $detalle->update();

                $cont = $cont+1;
            }

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $ingreso = Ingresos::findOrFail($id);

         $ingreso->delete();

         return Redirect('compras/ingreso');
    }
}
