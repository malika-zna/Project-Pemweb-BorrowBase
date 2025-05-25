<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ndepan' => 'required|string|max:50',
            'nbelakang' => 'required|string|max:50',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = new User();
        $user->ndepan = $request->ndepan;
        $user->nbelakang = $request->nbelakang;
        $user->kontak = $request->kontak;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/foto'), $namaFile);
            $user->foto = $namaFile;
        }

        $user->save();

        return redirect()->route('admin.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string',
            // validasi lain sesuai kebutuhan
        ]);

        $user = auth()->user();
        $user->jabatan = $request->jabatan;
        // update field lain jika perlu
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateTahun(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:1900|max:2099',
        ]);

        $user = auth()->user();
        $user->tahun = $request->tahun;
        $user->save();

        return response()->json(['message' => 'Tahun berhasil diperbarui.']);
    }

    public function updateNama(Request $request)
    {
        $request->validate([
            'field' => 'required|in:ndepan,nbelakang,kontak,email,password',
            'value' => 'required|string|max:191',
        ]);

        $user = auth()->user();

        if ($request->field === 'password') {
            $user->password = bcrypt($request->value);
        } else {
            $user->{$request->field} = $request->value;
        }
        $user->save();

        return response()->json(['message' => 'Data berhasil diperbarui.']);
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        // Hapus foto lama jika ada
        if ($user->foto && file_exists(public_path('uploads/foto/' . $user->foto))) {
            unlink(public_path('uploads/foto/' . $user->foto));
        }

        // Simpan foto baru
        $file = $request->file('foto');
        $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/foto'), $namaFile);

        $user->foto = $namaFile;
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diubah.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Akun Anda berhasil dihapus secara permanen.');
    }
}
