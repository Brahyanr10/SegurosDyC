<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

/*Route::filter('auth', function(){

	if(Auth::guest()) 
	return Redirect::guest('login');
});*/


Route::filter('auth', function()
{
	if (Auth::guest()) 
	{
		if ( Request::ajax() )
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login')->with('mensaje_error', 'Debes iniciar sesión para acceder');
			
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});



//filtro para gestion de  roles

//0=usuario activo novato
//1 = Inactivo sin acceso al sistema
//2=usuario desclasificado
//3=usuario activo participando ronda 1
//4=usuario activo ronda 2
//5=usuario activo ronda 3
//Verificamos que el usuario no esté autenticado
//controlamos todos los roles de usuarios desde aquí

Route::filter('roles', function($ruta,$peticion,$roles,$redirect)
{  
    $roles = explode("-", $roles);
    if(!in_array(Auth::user()->estado, $roles))
        return Redirect::to($redirect);        
});



/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*prueba = {
        "test": {{$test}}
            }*/