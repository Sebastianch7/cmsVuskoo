<?php

namespace App\Http\Controllers;

use App\Models\Banca;
use App\Models\CategoriasPrestamos;
use App\Models\EmisorBanca;
use App\Models\Microcreditos;
use App\Models\Prestamos;
use App\Models\States;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class MicrocreditosController extends Controller
{
    public function createOffer($tipo)
    {
        $states = States::all();
        $prestadoras = Banca::all();
        $categorias = CategoriasPrestamos::whereIn('id', [5])->get();
        $emisor = EmisorBanca::all();
        $operadorasList = $prestadoras->mapWithKeys(function ($prestadoras) {
            return [$prestadoras->id => $prestadoras->nombre . ' - ' . $prestadoras->paises->nombre];
        });
        $solicitud = match ($tipo) {
            'soluciones_de_deuda' => 4,
            'microcredito' => 5,
            'prestamo' => 6,
        };
        return view('microcreditos.create', compact('states', 'operadorasList', 'categorias', 'prestadoras', 'emisor','tipo','solicitud'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifas = Prestamos::whereIn('categoria', [5])->get();
        return view('microcreditos.index', compact('tarifas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
    {
        $states = States::all();
        $prestadoras = Banca::all();
        $categorias = CategoriasPrestamos::whereIn('id', [5])->get();
        $emisor = EmisorBanca::all();
        $operadorasList = $prestadoras->mapWithKeys(function ($prestadoras) {
            return [$prestadoras->id => $prestadoras->nombre . ' - ' . $prestadoras->paises->nombre];
        });
        return view('microcreditos.create', compact('states', 'operadorasList', 'categorias', 'prestadoras', 'emisor'));
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $empresa = Banca::find($request->banca);
        $pais = $empresa->pais;
        Prestamos::create([
            'banca' => $request->banca,
            'titulo' => $request->titulo,
            'selector1' => $request->selector1,
            'valorMaximo' => $request->valorMaximo,
            'parrilla_1' => $request->parrilla_1,
            'parrilla_2' => $request->parrilla_2,
            'parrilla_3' => $request->parrilla_3,
            'parrilla_4' => $request->parrilla_4,
            'url_redirct' => $request->url_redirct,
            'destacada' => $request->destacada,
            'estado' => $request->estado,
            'categoria' => $request->categoria,
            'pais' => $pais,
            'interes_mensual' => $request->interes_mensual,
            'inteses_anual' => $request->inteses_anual,
            'ingresos_minimos' => $request->ingresos_minimos,
            'slug_tarifa' => Str::slug($request->slug_tarifa),
        ]);
        return redirect()->route('prestamos.index')->with('info', 'Tarifa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Microcreditos $microcreditos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarifa = Prestamos::find($id);
        $states = States::all();
        $prestadoras = Banca::all();
        $tipo = CategoriasPrestamos::select('nombre as tipo')->where('id', $tarifa->categoria)->first();
        $emisor = EmisorBanca::all();
        $operadorasList = $prestadoras->mapWithKeys(function ($prestadoras) {
            return [$prestadoras->id => $prestadoras->nombre . ' - ' . $prestadoras->paises->nombre];
        });
        return view('microcreditos.edit', compact('tarifa', 'operadorasList', 'states','tipo', 'prestadoras', 'emisor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empresa = Banca::find($request->banca);
        $pais = $empresa->pais;

        $request['pais'] = $pais;
        $request['slug_tarifa'] = Str::slug($request->slug_tarifa);
        $tarifa = Prestamos::find($id);
        $tarifa->update($request->all());

        return back()->with('info', 'Información actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Microcreditos $microcreditos)
    {
        //
    }
}
