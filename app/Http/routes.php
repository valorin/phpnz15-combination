<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Database\QueryException;
use Illuminate\Filesystem\Filesystem;

$app->get('/', function (Filesystem $filesystem) use ($app) {

    $flags = [];

    $flags['composer'] = true;

    if (env('APP_ENV') == 'production' && !env('APP_DEBUG')) {
        $flags['envApp'] = true;
    }

    try {
        $db = $app->make('db');

        if ($db->table('status')->where('component', 'scheduler')->first()) {
            $flags['scheduler'] = true;
        }

        if ($db->table('status')->where('component', 'queue')->first()) {
            $flags['queue'] = true;
        }

        // Both are working!
        $flags['dbConnection'] = true;
        $flags['dbTables'] = true;

        // Now it's time to check for the '.ansible' flag files.
        if (!count($filesystem->glob(base_path('.ansible-*')))) {
            return redirect('thankyou');
        }
    } catch (QueryException $e) {
        // Database connected, but no table found...
        $flags['dbConnection'] = true;
    } catch (\Exception $e) {
        if ($e->getMessage() == 'Database does not exist.') {
            // Database connected, but no table found...
            $flags['dbConnection'] = true;
        }
    }

    return view('locked', $flags);
});

$app->get('thankyou', function () use ($app) {
    return view('thankyou');
});
