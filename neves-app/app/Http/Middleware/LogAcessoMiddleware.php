<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->server->get('REMOTE_ADDR');
        $route = $request->getRequestUri(); //pois está no primeiro nivel
        LogAcesso::create(['log'=>"IP $ip requesitou a rota $route"]);
        // return Response("o requeste foi apanhado pelo middleware e acabou no middleware $ip , $route ");
        // return $next($request);
        $response = $next($request); // posso guardar a resposta dada pela aplicação dentro de uma variavel
        $response->setStatusCode(201, 'O status da resposta e o texto da resposta foram modificados'); // para depois a poder manipular de maneira necessária 

        return $response;
    }
}
