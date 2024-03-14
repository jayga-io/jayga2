<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('remove:controllers', function(){
    // File location
    $file_location = base_path() . '/app/Http/Controllers' ;

    // Check if exist
    if (file_exists($file_location)) {
       // exec('rm ' . $file_location);
       rmdir($file_location);
        $this->info('Folder has been deleted!');
    } else {
        $this->error('Cannot delete , file not found.');
    }
});

Artisan::command('remove:models', function(){
    $file_location = base_path() . 'app/Models' ;
    if(file_exists($file_location)){
        rmdir($file_location);
        $this->info('Models Folder deleted');
    }else{
        $this->error('Can not delete, file not found');
    }
});

Artisan::command('remove:database', function(){
    $file_location = base_path() . '/database' ;
    if(file_exists($file_location)){
        rmdir($file_location);
        $this->info('Database folder deleted');
    }else{
        $this->error('Can not delete, file not found');
    }
});