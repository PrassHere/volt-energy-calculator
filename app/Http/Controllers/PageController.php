<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function registrasi(): View
    {
        return view('auth.registrasi');
    }

    public function index(): View
    {
        $dashboard = [
            'activeDevices' => 24,
            'totalConsumption' => 1248,
            'estimatedCost' => 142.50,
        ];

        return view('index', compact('dashboard'));
    }

    public function analytics(): View
    {
        $analytics = [
            'totalConsumption' => 1284.5,
            'estimatedCost' => 241.08,
            'week' => [42, 38, 55, 48, 62, 35, 30],
            'month' => [320, 410, 380, 445],
        ];

        return view('pages.analytics', compact('analytics'));
    }

    public function history(): View
    {
        $history = [
            'lastUpdated' => '14 mins ago',
            'source' => 'Lab Mainframe',
            'systemVersion' => 'v2.4.1',
        ];

        return view('pages.history', compact('history'));
    }

    public function ecoTips(): View
    {
        return view('pages.eco-tips');
    }

    public function addDevice(): View
    {
        $calculator = [
            'defaultPower' => 100,
            'defaultUsage' => 8,
            'defaultTariff' => 0.15,
        ];

        return view('pages.add-device', compact('calculator'));
    }
}