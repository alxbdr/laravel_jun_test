<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\DeleteUsers;

class UsersController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct () {
        $this->middleware('auth');
    }

    /**
     * Show basic view of user's profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('user.profile', [
            'title'=>'User profile'
        ]);
    }

    /**
     * Show form for editing user information
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit() {
        return view('user.edit', [
            'title' => 'Edit profile', 
            'user' => Auth::user()
        ]);
    }

    /**
     * Update user profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update() {
        return redirect()->back()->withErrors(['password'=>'Updating is not ready yet'])->withInput();
    }

    /**
     * Show confirmation form for deleting user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete() {
        return view('user.delete', [
            'title'=>'Delete profile'
        ]);
    }

    /**
     * Delete user and his codes from the storage.
     *
     * @param  App\Http\Requests\DeleteUsers  $request
     * @param  \App\Models\User  $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUsers $request, User $user) {
        $request->confirmed();
        $deleted = $user->destroy_profile(Auth::user()->id);
        if (!$deleted) {
            return redirect()->back()->withErrors(['password'=>'Profile has not been deleted'])->withInput();
        }
        return redirect()->route('login')->with('success', 'Your profile deleted');
    }
}
