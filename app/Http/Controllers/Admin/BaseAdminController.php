<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    /**
     * Шаблон, который должен использоваться при ответе.
     */
    protected $layout = 'layouts.app';
}
