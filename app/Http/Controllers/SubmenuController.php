<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\niveles_acceso;
use App\Models\users;

use Exception;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\Cliente;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use Auth;

class SubmenuController extends Controller
{
    function locker()
    {
        return view('submenus.lock');
    }

    function settings()
    {
        return view('submenus.settings');
    }
}
