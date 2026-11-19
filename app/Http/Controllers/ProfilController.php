<?php

namespace App\Http\Controllers;

use App\Models\FotoProfil;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfilController extends Controller
{
    // Lihat profil
    public function show(): View
    {
        $user = Auth::user();

        return view('pages.profil', compact('user'));
    }

    // Menampilkan gambar foto profil milik user yang login (dibaca dari database)
    public function foto(): Response
    {
        $foto = FotoProfil::find(Auth::user()->email);

        abort_if(! $foto, 404);

        return response(base64_decode($foto->data), 200, [
            'Content-Type'  => $foto->mime,
            // Boleh di-cache browser; URL berubah (?v=...) saat foto diganti
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }

    // Ubah nama dan foto profil
    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'foto' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp',
                'max:2048',                                   // maks 2 MB
                'dimensions:max_width=4000,max_height=4000',  // cegah gambar raksasa
            ],
        ], [
            'nama.required'    => 'Nama lengkap wajib diisi.',
            'foto.image'       => 'File harus berupa gambar.',
            'foto.mimes'       => 'Format foto harus jpg, jpeg, png, atau webp.',
            'foto.max'         => 'Ukuran foto maksimal 2 MB.',
            'foto.dimensions'  => 'Dimensi foto maksimal 4000 x 4000 piksel.',
            'foto.uploaded'    => 'Foto gagal diunggah. Pastikan ukurannya tidak lebih dari 2 MB.',
        ]);

        // Perkecil foto dulu (di luar transaksi); error validasi langsung kembali ke form
        $jpeg = $request->hasFile('foto') ? $this->perkecilFoto($request->file('foto')) : null;

        DB::transaction(function () use ($request, $user, $data, $jpeg) {
            $versi = $user->foto_versi;

            // Hapus foto jika dicentang
            if ($request->boolean('hapus_foto')) {
                FotoProfil::where('email', $user->email)->delete();
                $versi = null;
            }

            // Simpan/ganti foto baru
            if ($jpeg !== null) {
                FotoProfil::updateOrCreate(
                    ['email' => $user->email],
                    ['mime' => 'image/jpeg', 'data' => base64_encode($jpeg)]
                );
                $versi = now()->timestamp;
            }

            $user->update([
                'nama'       => $data['nama'],
                'foto_versi' => $versi,
            ]);
        });

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Potong bagian tengah gambar menjadi persegi, kecilkan ke 256 x 256 piksel,
     * lalu ubah menjadi JPEG. Hasilnya ~15-30 KB, cukup ringan untuk database.
     */
    private function perkecilFoto(UploadedFile $file, int $sisi = 256): string
    {
        if (! function_exists('imagecreatefromstring')) {
            throw ValidationException::withMessages([
                'foto' => 'Ekstensi PHP GD belum aktif di server.',
            ]);
        }

        $sumber = @imagecreatefromstring((string) file_get_contents($file->getRealPath()));

        if ($sumber === false) {
            throw ValidationException::withMessages([
                'foto' => 'File gambar tidak dapat dibaca.',
            ]);
        }

        $lebar  = imagesx($sumber);
        $tinggi = imagesy($sumber);
        $ukuran = min($lebar, $tinggi);
        $x      = intdiv($lebar - $ukuran, 2);
        $y      = intdiv($tinggi - $ukuran, 2);

        $kanvas = imagecreatetruecolor($sisi, $sisi);
        imagefill($kanvas, 0, 0, imagecolorallocate($kanvas, 255, 255, 255)); // latar putih untuk PNG transparan
        imagecopyresampled($kanvas, $sumber, 0, 0, $x, $y, $sisi, $sisi, $ukuran, $ukuran);

        ob_start();
        imagejpeg($kanvas, null, 85);

        return (string) ob_get_clean();
    }
}