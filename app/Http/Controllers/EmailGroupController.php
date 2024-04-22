<?php

namespace App\Http\Controllers;

use App\Models\EmailGroup;
use Illuminate\Http\Request;

class EmailGroupController extends Controller
{
    public function index()
    {
        // get all email groups
        $emailGroups = EmailGroup::latest()->get(['id', 'name', 'slug']);

        return $emailGroups;
    }
}
