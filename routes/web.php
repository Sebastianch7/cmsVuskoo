<?php

use App\Http\Controllers\AlarmasController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ComercializadorasController;
use App\Http\Controllers\ComerciosController;
use App\Http\Controllers\CuponesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormularioContactenosController;
use App\Http\Controllers\FormularioLeadsController;
use App\Http\Controllers\FormularioNewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MicrocreditosController;
use App\Http\Controllers\OperadorasController;
use App\Http\Controllers\PaginaWebFooterController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\ParillaFibraController;
use App\Http\Controllers\ParillaFibraMovilController;
use App\Http\Controllers\ParillaFibraMovilTvController;
use App\Http\Controllers\ParillaGasController;
use App\Http\Controllers\ParillaLuzController;
use App\Http\Controllers\ParillaLuzGasController;
use App\Http\Controllers\ParillaMovilController;
use App\Http\Controllers\ParrillaAutoconsumoController;
use App\Http\Controllers\ParrillaStreamingController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SegurosSaludController;
use App\Http\Controllers\TipoCuponController;
use App\Http\Controllers\TraduccionCategoriasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [DashboardController::class, 'contadorServicio'])->middleware(['auth']);
Route::get('/home', [DashboardController::class, 'contadorServicio'])->middleware(['auth']);
Route::resource('usuarios', UserController::class)->middleware(['auth'])->names('user');
Route::resource('permisos', PermisosController::class)->names('permisos')->middleware(['auth']);
Route::resource('roles', RolesController::class)->names('roles')->middleware(['auth']);
Route::resource('comercializadoras', ComercializadorasController::class)->names('comercializadoras')->middleware(['auth']);
Route::resource('proveedores', ProveedoresController::class)->names('proveedores')->middleware(['auth']);
Route::resource('operadoras', OperadorasController::class)->names('operadoras')->middleware(['auth']);
Route::resource('comercios', ComerciosController::class)->names('comercios')->middleware(['auth']);
Route::resource('paises', PaisesController::class)->names('paises')->middleware(['auth']);
Route::resource('categorias', CategoriasController::class)->names('categorias')->middleware(['auth']);
Route::resource('tipoCupon', TipoCuponController::class)->names('tipoCupones')->middleware(['auth']);
/* Telefonia */
Route::resource('parrillamovil', ParillaMovilController::class)->names('parrillamovil')->middleware(['auth']);
Route::get('parrillamovilDuplicate/{id}', [ParillaMovilController::class, 'duplicateOffer'])->name('parrillamovilDuplicate')->middleware(['auth']);
/* Fibra */
Route::resource('parrillafibra', ParillaFibraController::class)->names('parrillafibra')->middleware(['auth']);
Route::get('parrillafibraDuplicate/{id}', [ParillaFibraController::class, 'duplicateOffer'])->name('parrillafibraDuplicate')->middleware(['auth']);
/* Seguros */
Route::resource('alarmas', AlarmasController::class)->names('alarmas')->middleware(['auth']);
Route::resource('segurossalud', SegurosSaludController::class)->names('segurossalud')->middleware(['auth']);
Route::get('alarmasDuplicate/{id}', [ParillaFibraController::class, 'duplicateOffer'])->name('alarmasDuplicate')->middleware(['auth']);
/* Finanzas españa */
/* Route::resource('unificadoras', UnificadoresController::class)->names('unificadoras')->middleware(['auth']);*/
Route::resource('microcreditos', MicrocreditosController::class)->names('microcreditos')->middleware(['auth']);
/* fibra movil */
Route::resource('parrillafibramovil', ParillaFibraMovilController::class)->names('parrillafibramovil')->middleware(['auth']);
Route::get('parrillafibramovilDuplicate/{id}', [ParillaFibraMovilController::class, 'duplicateOffer'])->name('parrillafibramovilDuplicate')->middleware(['auth']);
/* fibra movil tv */
Route::resource('parrillafibramoviltv', ParillaFibraMovilTvController::class)->names('parrillafibramoviltv')->middleware(['auth']);
Route::get('parrillafibramoviltvDuplicate/{id}', [ParillaFibraMovilTvController::class, 'duplicateOffer'])->name('parrillafibramoviltvDuplicate')->middleware(['auth']);
/* gas */
Route::resource('parrillagas', ParillaGasController::class)->names('parrillagas')->middleware(['auth']);
Route::get('parrillagasDuplicate/{id}', [ParillaGasController::class, 'duplicateOffer'])->name('parrillagasDuplicate')->middleware(['auth']);
/* luz */
Route::resource('parrillaluz', ParillaLuzController::class)->names('parrillaluz')->middleware(['auth']);
Route::get('parrillaluzDuplicate/{id}', [ParillaLuzController::class, 'duplicateOffer'])->name('parrillaluzDuplicate')->middleware(['auth']);
/* luzgas */
Route::resource('parrillaluzgas', ParillaLuzGasController::class)->names('parrillaluzgas')->middleware(['auth']);
Route::get('parrillaluzgasDuplicate/{id}', [ParillaLuzGasController::class, 'duplicateOffer'])->name('parrillaluzgasDuplicate')->middleware(['auth']);
/* autoconsumo */
Route::resource('parrillaautoconsumo', ParrillaAutoconsumoController::class)->names('parrillaautoconsumo')->middleware(['auth']);
/* streaming */
Route::resource('streaming', ParrillaStreamingController::class)->names('streaming')->middleware(['auth']);
/*  */
/* Route::get('Contenidomarcacreatecomercializadora/{id}', [ContenidoMarcaController::class, 'createContent'])->name('Contenidomarcacreatecomercializadora')->middleware(['auth']);
Route::get('Contenidomarcacreateoperadora/{id}', [ContenidoMarcaController::class, 'createContent'])->name('Contenidomarcacreateoperadora')->middleware(['auth']);
 */
Route::get('contadorservicio/{servicio}', [DashboardController::class, 'contadorServicio'])->middleware(['auth']);
/* Route::get('contadorservicio', [DashboardController::class, 'contadorServicio'])->middleware(['auth']); */

/* cupones */
Route::resource('cupones', CuponesController::class)->names('cupones')->middleware(['auth']);
Route::get('cuponesDuplicate/{id}', [CuponesController::class, 'duplicateOffer'])->name('cuponesDuplicate')->middleware(['auth']);
/* prestamos */
Route::resource('prestamos', PrestamosController::class)->names('prestamos')->middleware(['auth']);
Route::get('prestamosDuplicate/{id}', [PrestamosController::class, 'duplicateOffer'])->name('prestamosDuplicate')->middleware(['auth']);
/* Banca */
Route::resource('bancos', BancaController::class)->names('bancos')->middleware(['auth']);
Route::get('bancosDuplicate/{id}', [BancaController::class, 'duplicateOffer'])->name('bancosDuplicate')->middleware(['auth']);
/* Pagina web */
Route::resource('paginaweb', PaginaWebFooterController::class)->names('paginaweb')->middleware(['auth']);
/* traducciones */
Route::resource('traduccionCategorias', TraduccionCategoriasController::class)->names('traduccionCategorias')->middleware(['auth']);
/* menu */
Route::resource('paginawebmenu', MenuController::class)->names('paginawebmenu')->middleware(['auth']);
Route::resource('paginawebsubmenu', MenuItemController::class)->names('paginawebsubmenu')->middleware(['auth']);
Route::post('addStoreItemEdit/{id}', [MenuItemController::class, 'addStoreItemEdit'])->name('addStoreItemEdit')->middleware(['auth']);
/* Formularios */
Route::resource('formulariocontactenos', FormularioContactenosController::class)->names('formulariocontactenos')->middleware(['auth']);
Route::resource('formularionews', FormularioNewsletterController::class)->names('formularionews')->middleware(['auth']);
Route::resource('formularioleads', FormularioLeadsController::class)->names('formularioleads')->middleware(['auth']);
/* Blog */
Route::resource('blog', BlogController::class)->names('blog')->middleware(['auth']);
Route::get('blogPreview/{id}', [BlogController::class, 'blogPreview'])->name('blogPreview')->middleware(['auth']);

/* NUEVO */
Route::get('/tarifas/create/{tipo}', [MicrocreditosController::class, 'createOffer'])->name('tarifas.create');

Route::post('/upload-image', function (Request $request) {
    if ($request->hasFile('image')) { // Clave correcta: 'image'
        $file = $request->file('image'); // Accede al archivo con la clave correcta
        $extension = $file->getClientOriginalExtension(); // Obtén la extensión del archivo
        $nombreArchivo = 'imagen_' . time() . '.' . $extension; // Nombre único con timestamp
        $path = Storage::disk('public')->putFileAs('imagenesBlog', $file, $nombreArchivo); // Guarda el archivo

        if ($path) {
            $urlImagen = 'https://cms.vuskoo.com/storage/imagenesBlog/' . $nombreArchivo; // URL completa
            return response()->json(['success' => true, 'file' => $urlImagen]); // Devuelve la URL
        }
    }

    return response()->json(['success' => false, 'message' => 'Error al subir la imagen.'], 400);
});
