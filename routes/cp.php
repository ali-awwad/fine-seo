<?php

use AliAwwad\FineSeo\Http\Controllers\SeoFieldsController;
use Illuminate\Support\Facades\Route;

Route::get('fine-seo',[SeoFieldsController::class, 'index'])->name('fine-seo.index');

Route::post('fine-seo/setup',[SeoFieldsController::class, 'setup'])->name('fine-seo.setup');
Route::post('fine-seo/brand',[SeoFieldsController::class, 'brand'])->name('fine-seo.brand');


