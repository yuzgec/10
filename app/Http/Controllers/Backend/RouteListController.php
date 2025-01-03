<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RouteListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $routes = collect(Route::getRoutes())->map(function ($route) {
            $action = $route->getAction();
            $actionName = isset($action['controller']) 
                ? class_basename($action['controller']) 
                : (is_callable($action['uses']) ? 'Closure' : $action['uses']);

            return [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName() ?? '-',
                'action' => $actionName,
                'middleware' => implode(', ', array_map(function($middleware) {
                    return is_object($middleware) ? get_class($middleware) : $middleware;
                }, $route->middleware())),
                'domain' => $route->getDomain() ?? '-'
            ];
        })->filter(function ($route) use ($search) {
            // Temel filtreleme
            $baseFilter = !str_contains($route['uri'], '_ignition') && 
                         !str_contains($route['uri'], 'sanctum') &&
                         !str_contains($route['uri'], '_debugbar');
            
            // Arama filtresi
            if ($search) {
                return $baseFilter && (
                    str_contains(strtolower($route['name']), strtolower($search)) ||
                    str_contains(strtolower($route['uri']), strtolower($search)) ||
                    str_contains(strtolower($route['action']), strtolower($search))
                );
            }
            
            return $baseFilter;
        })->values()->all();

        return view('backend.route-list.index', compact('routes', 'search'));
    }
} 