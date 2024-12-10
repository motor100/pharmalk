<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::all();

        return view('dashboard.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $roles = Role::All();

        return view('dashboard.users-create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|alpha|min:3|max:20',
            'email' => 'required|unique:users|min:3|max:40',
            'role_id' => 'required',
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user_id = User::insertGetId([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($validated['password']),
            'remember_token' => NULL,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::insert('insert into users_roles (user_id, role_id) values (?, ?)', [$user_id, $validated["role_id"]]);

        return redirect('/dashboard/users')->with('status', 'Добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        return view('dashboard.users-show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        $auth_user = Auth::user();

        if($user->id == $auth_user->id) {
            return redirect('/profile');
        } else {

            $roles = Role::All();

            return view('dashboard.users-edit', compact('user', 'roles'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required|alpha|min:3|max:20',
            'role_id' => 'required',
        ]);

        $email = $request->input("email");

        $user = User::find($validated["id"]);
 
        // Валидация и проверка на уникальный email
        if ($user->email != $email) {
            $request->validate([
                'email' => 'required|unique:users|min:3|max:40',
            ]);
            $user->email_verified_at = null;
            $user->save();
        }

        $user->update([
            "name" => $validated["name"],
            "email" => $email,
            "updated_at" => now()
        ]);

        DB::table('users_roles')
                ->where('user_id', $validated["id"])
                ->update([
                    'role_id' => $validated["role_id"]
                ]);

        return redirect('/dashboard/users')->with('status', 'Обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        $user->delete();

        return redirect('/dashboard/users');
    }

    /**
     * Update the password.
     */
    public function password(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        User::where('id', $validated["id"])
            ->update([
                'password' => Hash::make($validated["password"]),
                'updated_at' => now()
            ]);

        return redirect('/dashboard/users')->with('status', 'Обновлено');
    }
}
