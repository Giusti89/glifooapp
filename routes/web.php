<?php

use App\Http\Controllers\AdvertisingsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DetallesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PubliController;
use App\Http\Controllers\RedesController;
use App\Http\Controllers\SellsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\SpotsController;
use App\Http\Controllers\SubproductsController;
use App\Http\Controllers\VideosController;
use App\Models\subproducts;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::view('/', 'inicio')->name('inicio');
Route::view('/inicio', 'inicio')->name('inicio');
Route::view('error', 'error.index')->name('error');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contactos');
Route::post('/contacto.store', [ContactoController::class, 'store'])->name('contacto.store');


Route::controller(PubliController::class)->group(function () {
    Route::get('/publi', 'index')->name('publicidad');
    Route::get('/Glifoo-publicidad/{slug}', 'show')->name('publicidad.show');
});

Route::view('privacidad', 'privacidad')->name('privacidad');
Route::get('nosotros', [ProfileController::class, 'tarjetas'])->name('nosotros');
Route::get('servicios', [ServiceController::class, 'mostrar'])->name('servicios');
Route::get('portfolio', [ServiceController::class, 'avatar'])->name('portfolio');



// RUTAS PRIVADAS
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile','edit')->name('profile.edit');
        Route::get('/usuarios.editusuarios/{id}','editacion')->name('editusu')->middleware('checkAdmin');
        Route::put('/usuarios.editusuarios/{id}','abc')->name('modify');
        Route::delete('/usuarios.editusuarios.eliminar/{id}','eliminar')->name('borrarusuario')->middleware('checkAdmin');    
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    Route::get('/dashboard', [RegisteredUserController::class, 'mostrar'])->name('dashboard');
    // servicios
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/cservicios','index')->name('cservicios.index');
        Route::post('cservicios','store')->name('cservicios.store');
        Route::get('cservicios.nuevopost','crearServicio')->name('cservicios.nuevo');
        Route::get('cservicios.delete/{id}','destroy')->name('cservicios.delete');
        Route::get('cservicios.edit /{id}','edit')->name('cservicios.edit');
        Route::put('cservicios.edit/{id}','update')->name('cservicios.update');
    });    
    // clientes
    Route::controller(ClienteController::class)->group(function () {
        Route::get('/clientes','index')->name('clientes.index');
        Route::get('/clientes.nuevo','create')->name('novo');
        Route::post('/clientes.store','store')->name('crear');
        Route::delete('/clientes/{cliente}', 'destroy')->name('elicliente');
        Route::get('/clientes.edit/{id}','edit')->name('editarcli');
        Route::put('/clientes/{id}','update')->name('clientes.update');
    });
    //productos
    Route::controller(ProductosController::class)->group(function () {
        Route::get('/productos.index/{idproducto}', 'index')->name('mostrarprod');
        Route::get('/productos.nuevo/{idservicio}', 'create')->name('nproducto');
        Route::post('/productos.store', 'store')->name('creare');
        Route::delete('/productos/{producto}', 'destroy')->name('eliminarprod');
    });    
    //sub productos
    Route::controller(SubproductsController::class)->group(function () {
        Route::get('/subproductos.index/{subproducto}','index')->name('subproductos');
        Route::get('/subproductos.nuevo/{parametro}','create')->name('nsproducto');    
        Route::post('/subproductos.store','store')->name('sstore');
        Route::delete('/subproductos.delete/{producto}','destroy')->name('eliminarsprod');
    });    
    //solicitudes
    Route::controller(SolicitudesController::class)->group(function () {
        Route::get('/solicitudes','index')->name('solicitudes.index');
        Route::get('/solicitudes.nuevo','create')->name('nsolicitud');
        Route::post('/solicitudes.store','store')->name('completado');
        Route::get('/solicitudes.edit/{id}','edit')->name('editarsolicitud');
        Route::put('/solicitudes/{id}','update')->name('actualizarsolicitud');
        Route::put('/detalle/{id}','cambioEstado')->name('terminado');
        Route::delete('/detalle.delete/{solicitudes}','destroy')->name('solicitud.delete');        
    });
    //Detalles
    Route::controller(DetallesController::class)->group(function () {
        Route::get('/detalle.index/{id}', 'index')->name('detalle');
        Route::post('/detalle.store', 'store')->name('detalle.store');
        Route::delete('/detalle/{id}', 'destroy')->name('detalle.destroy');
        Route::get('/detalle.pdf/{id}', 'pdf')->name('pdf');
    });
    // publicidad-Spots
    Route::controller(SpotsController::class)->group(function(){
        Route::get('/publicidad.index', 'index')->name('publicidad.index');
        Route::get('/spots.create','create')->name('crearPubli');
        Route::post('/spots.store', 'store')->name('spot.store');
        Route::get('/spots.edit/{id}', 'edit')->name('spot.edit');
        Route::delete('/spots.delete/{id}', 'destroy')->name('spot.delete');
        Route::get('/publicidad.pubstore/{id}', 'pstore')->name('storepub');
        Route::put('/publicidad/{id}','update')->name('publicidad.update');
    });
    
    Route::controller(AdvertisingsController::class)->group(function(){
        Route::get('/adveristings.index', 'index')->name('adveristings');
        Route::get('/adveristings.create','create')->name('acreate.dveristings');
        Route::post('/adveristings.store','store')->name('adveristings.store');
        Route::get('/adveristings.edit/{id}','edit')->name('editarPublicidad');
        Route::put('/adveristings/{id}','update')->name('adveristings.update');
        Route::delete('/adveristings/{id}', 'destroy')->name('adveristings.destroy');
    });
    Route::controller(ArticlesController::class)->group(function(){
        Route::post('/publicidad.pubstore.store', 'store')->name('pubstore.store');
        Route::delete('/publicidad.pubstore.delete/{id}', 'destroy')->name('pubstore.delete');
        Route::get('/articulo.edit/{id}', 'edit')->name('articulo.edit');
        Route::put('/articulo.update/{id}', 'update')->name('articulo.update');
    });

    Route::controller(RedesController::class)->group(function(){
        Route::get('/redes.index/{id}', 'index')->name('redes.index');
        Route::post('/redes.create', 'store')->name('redes.store');
        Route::delete('/redes.delete/{id}', 'destroy')->name('redes.delete');
        Route::get('/redes.edit/{id}', 'edit')->name('redes.edit');
        Route::put('/redes.update/{id}', 'update')->name('redes.update');       
    });

    Route::controller(VideosController::class)->group(function(){
        Route::get('/videos.index/{id}', 'index')->name('video.index');
        Route::post('/videos.create', 'store')->name('video.store');
        Route::delete('/videos.delete/{id}', 'destroy')->name('video.delete');
        Route::get('/videos.edit/{id}', 'edit')->name('video.edit');
        Route::put('/videos.update/{id}', 'update')->name('video.update');       
    });

    Route::controller(ImagesController::class)->group(function(){
        Route::get('/galeria.index/{id}', 'index')->name('galeria.index');
        Route::post('/galeria.create', 'store')->name('galeria.store');
        Route::delete('/galeria.delete/{id}', 'destroy')->name('galeria.delete');
        Route::get('/galeria.edit/{id}', 'edit')->name('galeria.edit');
        Route::put('/galeria.update/{id}', 'update')->name('galeria.update');
        Route::put('/galeria.cambio/{id}', 'cambio')->name('galeria.cambio');
               
    });

    Route::controller(SellsController::class)->group(function(){
        Route::get('/tienda.index/{id}', 'index')->name('tienda.index');
        Route::post('/tienda.create', 'store')->name('tienda.store');
        Route::delete('/tienda.delete/{id}', 'destroy')->name('tienda.delete');
        Route::get('/tienda.edit/{id}', 'edit')->name('tienda.edit');
        Route::put('/tienda.update/{id}', 'update')->name('tienda.update');       
    });



});


require __DIR__ . '/auth.php';
