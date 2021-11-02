<?php

use Illuminate\Support\Facades\Route;
use TenetUp\Zarinpal\Controller\ZarinpalController;

Route::prefix('/zarinpal')->name('zarinpal.')->group(function (){
    Route::get('/backPayment' , [ZarinpalController::class , 'backPayment'])->name('backPayment');
});
