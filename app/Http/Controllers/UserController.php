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
    public function index(Request $request)
    {
        $filter = $request->input('filter', '');

        $recordsPerPage = 10;
        if (!empty($request->records_per_page)) {
            $recordsPerPage = (int) $request->records_per_page;
            if ($recordsPerPage > 50) {
                $recordsPerPage = 50;
            }
        }

        $query = User::query()->with('role')->orderBy('id');

        if ($filter !== '') {
            $query->where(function ($q) use ($filter) {
                $q->where('name', 'LIKE', '%'.$filter.'%')
                    ->orWhere('email', 'LIKE', '%'.$filter.'%');
            });
        }

        $users = $query->paginate($recordsPerPage);

        return view('dashboard', [
            'users' => $users,
            'data' => $request,
        ]);
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
        ]);
        User::create([
            'name' => trim($data['name'].' '.$data['last_name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
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


        $user->save();

        return redirect()->route('dashboard')->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'No puedes borrar tu propia cuenta mientras estás dentro.');
        }
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Usuario eliminado.');
    }


}
