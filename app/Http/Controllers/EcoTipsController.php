<?php

namespace App\Http\Controllers;

use App\Models\TipsHematEnergi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EcoTipsController extends Controller
{
    /**
     * KF-08: Menampilkan daftar tips hemat energi dengan fitur pencarian.
     */
    public function index(Request $request): View
    {
        $q = trim((string) $request->input('q', ''));

        $query = TipsHematEnergi::query();

        if ($q !== '') {
            $kata = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $q);
            $query->where(function ($sub) use ($kata) {
                $sub->whereRaw("judul_tips LIKE ? ESCAPE '!'", ['%' . $kata . '%'])
                    ->orWhereRaw("konten LIKE ? ESCAPE '!'", ['%' . $kata . '%'])
                    ->orWhereRaw("kategori LIKE ? ESCAPE '!'", ['%' . $kata . '%']);
            });
        }

        $tips = $query->orderBy('id_tips')->get();
        $featuredTip = $tips->first();
        $otherTips = $tips->skip(1);

        return view('pages.eco-tips', compact('tips', 'featuredTip', 'otherTips', 'q'));
    }
}
