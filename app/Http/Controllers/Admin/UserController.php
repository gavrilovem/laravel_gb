<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('admin.users.index', ['users' => $user->getUsers()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $userModel
     * @param int $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $userModel, int $user)
    {
        return view('admin.users.edit', ['user' => $userModel->getUser($user)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->only('access_level');
        $res = $user->fill($data)->save();
        if ($res) {
            return redirect()->route('admin.user.index')
                ->with('success', __('messages.user.update.success'));
        }
        return back()->withInput()->with('error', __('messages.user.update.error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $userModel
     * @param int $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $userModel, int $user)
    {
        $res = $userModel->deleteUser($user);

        if ($res) {
            return redirect()->route('admin.user.index')
                ->with('success', __('messages.user.delete.success'));
        }
        return back()->withInput()->with('errors', __('messages.user.delete.error'));
    }
}
