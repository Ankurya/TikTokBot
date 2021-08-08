<?php

namespace App\Http\Controllers\Open;

use App\Enums\EntityEnums;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Construct function to define
     * commonly used entities
     * 
     */
    public function __construct()
    {
        $this->parent = 'open.';
    }
    
    /**
     * Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view($this->parent . EntityEnums::DASHBOARD);
    }

    /**
     * Accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function accounts()
    {
        return view($this->parent . EntityEnums::ACCOUNTS); 
    }
}
