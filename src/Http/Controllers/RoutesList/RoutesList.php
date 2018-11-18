<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 10/25/16
 * Time: 23:22
 */


namespace Larangular\RoutesList\Http\Controllers\RoutesList;

use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Routing\Route;

class RoutesList {

    public function __construct() {
    }

    public function index() {
        return [
            'data' => $this->getRoutes()
        ];
    }

    public function getRoutes(string $component = null): array {
        $response = [];
        $routes = RouteFacade::getRoutes()
                  ->getRoutes();

        foreach ($routes as $route) {
            if(!is_null($component) && !$this->isComponentInRoute($route, $component)) {
                continue;
            }

            $route->id = $this->makeId($route);
            $response[] = $route;
        }

        return $response;
    }

    public function routes($component = '') {

        $r = Route::getRoutes()
                  ->getRoutes();
        $response = [];


        foreach ($r as $value) {
            if ($component == '' || $this->isComponentInRoute($value, $component)) {
                $path = $value->uri();
                $methods = implode('|', $value->methods());
                $c = $value->getAction();
                $response[] = implode('', [
                    '<tr>',
                    '<td>' . $methods . '</td>',
                    '<td><a href="/' . $path . '" >' . $path . '</a></td>',
                    '<td>' . @$c['controller'] . '</td>',
                    '</tr>'
                ]);

            }
        }

        return '<table style="width:100%">'.implode('', $response).'</table>';
    }

    private function makeId(Route $route): string {
        return md5(json_encode($route));
    }

    private function isComponentInRoute(Route $route, string $component): bool {
        return str_contains($route->getPath(), $component);
    }


}
