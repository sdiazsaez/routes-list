<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 3/24/18
 * Time: 21:41
 */

namespace Larangular\RoutesList;

use Illuminate\Support\ServiceProvider;

class RoutesListServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/Http/Routes/RoutesListRoutes.php');
    }

}
