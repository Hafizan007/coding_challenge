<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;

class BonusController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        foreach (Bonus::all() as $bonus) {
            echo $bonus->total_pembayaran;
        }
        return view('home', compact('name'));
    }
}

