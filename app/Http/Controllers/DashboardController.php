<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function cliente()
    {
        return view('dashboards.cliente');
    }

    public function gerente()
    {
        return view('dashboards.gerente');
    }

    public function administrador()
    {
        return view('dashboards.administrador');
    }
}
