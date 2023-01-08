<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (in_groups('Superadmin')) {
            return view('dashboard', [
                'title' => 'Home - Superadmin'
            ]);
        } else {
            return view('home', [
                'title' => 'Home'
            ]);
        }
    }

    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}
