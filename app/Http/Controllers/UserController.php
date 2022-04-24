<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function index()
    {
        return view("users.index");
    }

    public function create()
    {
        return view("users.edit");
    }

    public function store(UserStoreRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route("user.index")
            ->with("successes", [__("messages.save_success")]);
    }

    public function edit(User $user)
    {
        return view("users.edit")
            ->with("user", $user);
    }

    public function update(UserStoreRequest $request, User $user)
    {
        $user->update(collect([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ])
            ->when($request->has('password') && ! empty($request->get('password')), function ($query) use ($request) {
                $query->put('password', bcrypt($request->password));
            })->toArray());

        return redirect()->route("user.index")
            ->with("successes", [__("messages.save_success")]);
    }

    public function destroy(User $user)
    {
        abort_if($user->id == auth()->user()->id, 403);

        $user->delete();
        return redirect()->route("user.index")
                         ->with("successes", [__("messages.delete_success")]);
    }
}
