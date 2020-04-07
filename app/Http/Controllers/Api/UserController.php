<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getPersonalInfo(Request $request)
    {
        return Account::find(auth()->user()->id);
    }
}