<?php

namespace App\Http\Controllers;

use App\Models\TipsHematEnergi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTipsController extends Controller
{
    public const KATEGORI = [
        'Efisiensi',
        'Air',
        'Standby',
        'Peralatan',
        'Laundry',
        'Terbarukan',
        'Lainnya',
    ];

    /**
     * Tampilan daftar tips & form kelola tips untuk Admin
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', $request->input('q', '')));
        $selectedCategory = trim((string) $request->input('category', $request->input('kategori', '')));

        $query = TipsHematEnergi::query();

        if ($search !== '') {
            $kata = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $search);
            $query->where(function ($sub) use ($kata) {
                $sub->whereRaw("judul_tips LIKE ? ESCAPE '!'", ['%' . $kata . '%'])
                    ->orWhereRaw("konten LIKE ? ESCAPE '!'", ['%' . $kata . '%']);
            });
        }

        if ($selectedCategory !== '') {
            $query->where('kategori', $selectedCategory);
        }

        $tips = $query->orderByDesc('is_featured')->orderBy('id_tips')->get();

        $editTip = null;
        if ($request->filled('edit')) {
            $editTip = TipsHematEnergi::find($request->input('edit'));
        }

        $kategoriList = self::KATEGORI;

        return view('pages.admin-tips', compact(
            'tips',
            'editTip',
            'kategoriList',
            'search',
            'selectedCategory'
        ));
    }

    /**
     * Simpan tips baru
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'judul_tips'  => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'konten'      => ['nullable', 'string'],
            'category'    => ['nullable', 'string', 'max:100'],
            'kategori'    => ['nullable', 'string', 'max:100'],
            'savings'     => ['nullable', 'string', 'max:150'],
            'penghematan' => ['nullable', 'string', 'max:150'],
            'featured'    => ['nullable'],
            'is_featured' => ['nullable'],
        ]);

        $judul  = trim($data['title'] ?? $data['judul_tips'] ?? '');
        $konten = trim($data['description'] ?? $data['konten'] ?? '');

        if ($judul === '' || $konten === '') {
            return back()
                ->withInput()
                ->with('error', 'Judul tips dan deskripsi wajib diisi.');
        }

        $kategori    = $data['category'] ?? $data['kategori'] ?? null;
        $penghematan = $data['savings'] ?? $data['penghematan'] ?? null;
        $isFeatured  = $request->boolean('featured') || $request->boolean('is_featured');

        if ($isFeatured) {
            TipsHematEnergi::where('is_featured', true)->update(['is_featured' => false]);
        }

        TipsHematEnergi::create([
            'judul_tips'  => $judul,
            'konten'      => $konten,
            'kategori'    => $kategori,
            'penghematan' => $penghematan,
            'is_featured' => $isFeatured,
            'icon'        => 'lightbulb',
        ]);

        return redirect()
            ->route('admin.tips')
            ->with('success', 'Tips hemat energi "' . $judul . '" berhasil ditambahkan.');
    }

    /**
     * Perbarui tips
     */
    public function update(Request $request, TipsHematEnergi $tip): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'judul_tips'  => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'konten'      => ['nullable', 'string'],
            'category'    => ['nullable', 'string', 'max:100'],
            'kategori'    => ['nullable', 'string', 'max:100'],
            'savings'     => ['nullable', 'string', 'max:150'],
            'penghematan' => ['nullable', 'string', 'max:150'],
            'featured'    => ['nullable'],
            'is_featured' => ['nullable'],
        ]);

        $judul  = trim($data['title'] ?? $data['judul_tips'] ?? '');
        $konten = trim($data['description'] ?? $data['konten'] ?? '');

        if ($judul === '' || $konten === '') {
            return back()
                ->withInput()
                ->with('error', 'Judul tips dan deskripsi wajib diisi.');
        }

        $kategori    = $data['category'] ?? $data['kategori'] ?? null;
        $penghematan = $data['savings'] ?? $data['penghematan'] ?? null;
        $isFeatured  = $request->boolean('featured') || $request->boolean('is_featured');

        if ($isFeatured) {
            TipsHematEnergi::where('id_tips', '!=', $tip->id_tips)
                ->where('is_featured', true)
                ->update(['is_featured' => false]);
        }

        $tip->update([
            'judul_tips'  => $judul,
            'konten'      => $konten,
            'kategori'    => $kategori,
            'penghematan' => $penghematan,
            'is_featured' => $isFeatured,
        ]);

        return redirect()
            ->route('admin.tips')
            ->with('success', 'Tips hemat energi "' . $judul . '" berhasil diperbarui.');
    }

    /**
     * Hapus tips
     */
    public function destroy(TipsHematEnergi $tip): RedirectResponse
    {
        $judul = $tip->judul_tips;
        $tip->delete();

        return redirect()
            ->route('admin.tips')
            ->with('success', 'Tips "' . $judul . '" berhasil dihapus.');
    }
}
