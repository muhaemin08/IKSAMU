<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        if ($request->has('q') && $request->q) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => User::count(),
            'superadmin' => User::where('role', 'superadmin')->count(),
            'admin' => User::where('role', 'admin')->count(),
            'penulis' => User::where('role', 'penulis')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|alpha_dash|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|in:superadmin,admin,penulis',
            'email' => 'nullable|string|email|max:255|unique:users,email',
        ]);

        if (empty($validated['email'])) {
            $validated['email'] = strtolower($validated['username']) . '@miftahululum.sch.id';
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return back()->with('success', "User baru '{$validated['name']}' (@{$validated['username']}) berhasil ditambahkan ke sistem!");
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'alpha_dash', 'max:50', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:superadmin,admin,penulis',
            'password' => 'nullable|string|min:6',
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if (empty($validated['email']) && empty($user->email)) {
            $validated['email'] = strtolower($validated['username']) . '@miftahululum.sch.id';
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', "Data user '{$user->name}' berhasil diperbarui!");
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Perhatian: Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan login!');
        }

        $nama = $user->name;
        $user->delete();

        return back()->with('success', "User '{$nama}' berhasil dihapus dari sistem!");
    }
}
