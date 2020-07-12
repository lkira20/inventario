<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Venta;
use App\articulo_venta;
use App\Articulo;
use App\Persona;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class VentaController extends Controller
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
        $totales = [];
        $query = trim($request->searchText);

        $ventas = Venta::where('num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('id', 'desc')
        ->paginate(5);

        while ($contador < count($ventas)) {

            $total= 0;

            $vent  = $ventas[$contador];

            foreach ($vent->articulos as $art) 
            {
                $total += $art->pivot->precio_venta * $art->pivot->cantidad;
    
            }

            $totales[$vent->id] = $total; 
            $contador++;
        }
     
        return view('ventas.venta.index', compact('ventas', 'query', 'totales')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $personas = Persona::where('tipo_persona', 'Cliente')->get();

        $articulos = Articulo::where('estado', 'Activo')->where('stock', '>', 0)->get();

        $contador = 0;
        $promedio = [];

        while ($contador < count($articulos)) {

        $total= 0;
            
            $art  = $articulos[$contador];

            foreach ($art->ingreso as $resultado) 
            {
                $total += $resultado->pivot->precio_venta;
    
            }

            //PROMEDIO CON EL QUE SE VENDERA CADA ARTICULO
            $promedio[$art->id] = $total / count($art->ingreso); 

            $contador++;
        }

        return view('ventas.venta.create', compact('personas', 'articulos', 'promedio'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaFormRequest $request)
    {
        //
        try {

            DB::beginTransaction();

            $venta = new Venta();

            $venta->persona_id = $request->persona_id;
            $venta->tipo_comprobante = $request->tipo_comprobante;
            $venta->serie_comprobante = $request->serie_comprobante;
            $venta->num_comprobante = $request->num_comprobante;
            $venta->total_venta = $request->total_venta;

            $mytime = Carbon::now();
            $venta->fecha_hora = $mytime->toDateTimeString();
            $venta->impuesto = '18';
            $venta->total_venta = $request->total_venta;
            $venta->estado = 'A';

            $venta->save();

            //detalles de ingreso ARTICULO
            $articulo_id = $request->articulo_id;
            $cantidad = $request->cantidad;
            $precio_venta = $request->precio_venta;
            $descuento = $request->descuento;

            $cont = 0;

            while ($cont < count($articulo_id)) {
                
                $detalle = new articulo_venta();

                $detalle->venta_id = $venta->id;
                $detalle->articulo_id = $articulo_id[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->save();

                $cont = $cont+1;
            }

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollback();
        }

        return Redirect('ventas/venta');
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
        $venta = Venta::findOrFail($id);

        $detalle = $venta->articulos;
        $total = [];
        foreach ($detalle as $art) {
           $total[$art->id] = $art->pivot->cantidad * $art->pivot->precio_venta;
        }

        return  view('ventas.venta.show', compact('venta', 'detalle', 'total'));
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

        $venta = Venta::findOrFail($id);

        $detalle = $venta->articulos;

        $personas = Persona::where('tipo_persona', 'Cliente')->get();

        $articulo = Articulo::where('estado', 'Activo')->get();

        return view('ventas.venta.edit', compact('venta','detalle','personas', 'articulo'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VentaFormRequest $request, $id)
    {
        //
         //
        try {

            DB::beginTransaction();

            $venta = Venta::findOrFail($id);

            $venta->persona_id = $request->persona_id;
            $venta->tipo_comprobante = $request->tipo_comprobante;
            $venta->serie_comprobante = $request->serie_comprobante;
            $venta->num_comprobante = $request->num_comprobante;
            $mytime = Carbon::now();
            $venta->fecha_hora = $mytime->toDateTimeString();
            $venta->impuesto = '18';
            $venta->total_venta = $request->total_venta;
            $venta->estado = 'A';

            $venta->save();
            //detalles de ingreso ARTICULO
            $articulo_id = $request->articulo_id;
            $cantidad = $request->cantidad;
            $precio_venta = $request->precio_venta;
            $descuento = $request->descuento;

            $cont = 0;

            while ($cont < count($articulo_id)) {
                
                $detalle = articulo_ingreso::where('ingreso_id', $ingreso->id);

                $detalle->venta_id = $venta->id;
                $detalle->articulo_id = $articulo_id[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->update();

                $cont = $cont+1;
            }

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollback();
        }

        return Redirect('ventas/venta');
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
        $venta = Venta::findOrFail($id);

        $venta->delete();

         return Redirect('ventas/venta');
    }

    public function anular($id)
    {
        //
         $venta = Venta::findOrFail($id);

         $venta->estado = "C"; 
         $venta->update();

         return Redirect('ventas/venta');
    }

    public function activa($id)
    {
        //
         $venta = Venta::findOrFail($id);

         $venta->estado = "A"; 
         $venta->update();

         return Redirect('ventas/venta');
    }
}
