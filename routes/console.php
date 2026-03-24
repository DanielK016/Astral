<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('stellaris:hello', function () {
    $this->info('Hello from Stellaris Galaxy CRUD!');
})->purpose('Test command');
