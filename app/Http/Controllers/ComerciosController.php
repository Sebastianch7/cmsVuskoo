<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Comercios;
use App\Models\Paises;
use App\Models\States;
use App\Models\TipoCupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ComerciosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:comercios.view')->only('index');
        $this->middleware('can:comercios.view.btn-create')->only('create', 'store');
        $this->middleware('can:comercios.view.btn-edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comercios = Comercios::all();
        return view('clientes.comercios.index', compact('comercios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Paises::all();
        $estados = States::all();
        $categorias = Categorias::all();
        $tipoCupon = TipoCupon::all();
        return view('clientes.comercios.create', compact('estados', 'paises', 'categorias', 'tipoCupon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $urlLogo = '';
        $logo_negativo = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $nombreArchivo = str_replace(['-', '.', ' ' . '  '], '_', strtolower(Str::slug($request->nombre))) . '.' . $extension;
            $path = Storage::disk('public')->putFileAs('/logos', $file, $nombreArchivo);
            $urlLogo = 'https://cms.vuskoo.com/storage/logos/' . $nombreArchivo;
        }
        if ($request->hasFile('logo_negativo')) {
            $file = $request->file('logo_negativo');
            $extension = $file->getClientOriginalExtension();
            $nombreArchivo = str_replace(['-', '.', ' ' . '  '], '_', strtolower(Str::slug($request->nombre))) . '_negativo.' . $extension;
            $path = Storage::disk('public')->putFileAs('/logos', $file, $nombreArchivo);
            $logo_negativo = 'https://cms.vuskoo.com/storage/logos/' . $nombreArchivo;
        }

        return $comercios = Comercios::create([
            'nombre' => ($request->nombre),
            'slug_tarifa' => Str::slug($request->slug_tarifa),
            'idPerseo' => $request->idPerseo,
            'url_comercio' => $request->url_comercio,
            'logo' => $urlLogo,
            'logo_negativo' => $logo_negativo,
            'fecha_registro' => now(),
            'categoria' => $request->categoria,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('comercios.index')->with('info', 'comercio creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comercios $comercios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comercio = Comercios::find($id);
        $paises = Paises::all();
        $estados = States::all();
        $categorias = Categorias::all();
        $tipoCupon = TipoCupon::all();
        return view('clientes.comercios.edit', compact('tipoCupon', 'comercio', 'estados', 'paises', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $comercio)
    {
        $comercios = Comercios::find($comercio);
        $urlLogo = null;
        $logo_negativo = null;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $nombreArchivo = str_replace(['-', '.', ' ' . '  '], '_', strtolower(Str::slug($request->nombre))) . '.' . $extension;
            $path = Storage::disk('public')->putFileAs('logos', $file, $nombreArchivo);
            $urlLogo = 'https://cms.vuskoo.com/storage/logos/' . $nombreArchivo;
        }

        if ($request->hasFile('logo_negativo')) {
            $file = $request->file('logo_negativo');
            $extension = $file->getClientOriginalExtension();
            $nombreArchivo = str_replace(['-', '.', ' ' . '  '], '_', strtolower(Str::slug($request->nombre))) . '_negativo.' . $extension;
            $path = Storage::disk('public')->putFileAs('logos', $file, $nombreArchivo);
            $logo_negativo = 'https://cms.vuskoo.com/storage/logos/' . $nombreArchivo;
        }

        // Crear un array de datos a actualizar
        $data = $request->all();

        $data['slug_tarifa'] = Str::slug($request->slug_tarifa);
        if ($urlLogo) {
            $data['logo'] = $urlLogo;
        }
        if ($logo_negativo) {
            $data['logo_negativo'] = $logo_negativo;
        }

        // Actualizar el modelo
        $comercios->update($data);
        return redirect()->route('comercios.index')->with('info', 'comercio editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comercios $comercios)
    {
        //
    }
}
