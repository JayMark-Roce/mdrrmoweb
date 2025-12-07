<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $adminLogs = LoginLog::where('user_type', 'admin')
            ->orderBy('login_at', 'desc')
            ->paginate(50, ['*'], 'admin_page');

        $driverLogs = LoginLog::where('user_type', 'driver')
            ->orderBy('login_at', 'desc')
            ->paginate(50, ['*'], 'driver_page');

        return view('admin.logs.index', [
            'adminLogs' => $adminLogs,
            'driverLogs' => $driverLogs,
        ]);
    }
}
