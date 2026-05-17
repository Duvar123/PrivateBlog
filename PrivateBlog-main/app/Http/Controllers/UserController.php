<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('id')->get();

        return view('dashboard', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'avatar' => ['nullable', 'image', 'max:4096'],
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name' => trim($data['name'].' '.$data['last_name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuario creado.');
    }

    public function edit(User $user)
    {
        $nombreCompleto = trim($user->name);
        $firstName = '';
        $lastName = '';
        if ($nombreCompleto !== '') {
            $trozos = explode(' ', $nombreCompleto, 2);
            $firstName = $trozos[0];
            $lastName = isset($trozos[1]) ? trim($trozos[1]) : '';
        }

        return view('users.edit', compact('user', 'firstName', 'lastName'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:4096'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'string', 'min:4', 'confirmed'];
        }

        $data = $request->validate($rules);

        $user->name = trim($data['name'].' '.$data['last_name']);
        $user->email = $data['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $this->deleteAvatarFile($user->avatar);
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'No puedes borrar tu propia cuenta mientras estás dentro.');
        }

        $this->deleteAvatarFile($user->avatar);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Usuario eliminado.');
    }

    private function deleteAvatarFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
