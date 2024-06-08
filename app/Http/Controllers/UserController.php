<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Group;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $users = User::OrderBy('id', 'desc')->paginate();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUser $request)
    {

        $user = User::create($request->all());

        Auth::login($user);

        return redirect()->route('users.show', $user)->with('success', 'Register successfully');
    }

    public function show(User $user)
    {
        $tasks = $user->tasks->map(function ($task) use ($user) {
            $userTask = TaskUser::where('task_id', $task->id)->where('user_id', $user->id)->first();
            if ($userTask) {
                $task->groupOfTask = $userTask->group;
            }

            return $task;
        });

        return view('users.show', compact('user', 'tasks'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(StoreUser $request, User $user)
    {
        if (empty($request->input('password'))) {
            $request->merge(['password' => $user->password]);
        }

        $user->update($request->all());

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        dd('quiero vaquero');
        $user->delete();
        return redirect()->route('users.index');
    }

    public function deleteTask(int $userId, int $taskId)
    {
        $user = User::find($userId);
        $taskFromUser = TaskUser::where('user_id', $userId)->where('task_id', $taskId)->first();
        $taskFromUser->delete();
        return redirect()->route('users.show', $user);
    }


    public function login(Request $request)
    {

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.show');
    }
}
