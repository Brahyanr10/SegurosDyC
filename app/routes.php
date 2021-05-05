<?php 


Route::get('/', function()
{
	return View::make('index');
});

Route::get('inicio', function()
{
	return View::make('index');
});

Route::get('nosotros', function()
{
	return View::make('nosotros');
});

Route::get('servicios', function()
{
	return View::make('servicios');
});

Route::get('respaldo', function()
{
	return View::make('respaldo');
});


Route::get('pagos', function()
{
	return View::make('pagos');
});

Route::get('contacto', function()
{
	return View::make('contacto');
});



?>

