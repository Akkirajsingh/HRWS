<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Entrust;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
  function redirectToAdminDashboard(){
      $data  = getUserArray();

      //dd(Entrust::can('ADMIN_USER_EDIT'));

      return view('pages.admin.user.user-list',['data' => $data]);
  }

}
