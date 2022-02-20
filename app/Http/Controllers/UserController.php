<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function readAll() {
        return User::get();
    }

    public function readSingle($id) {
        $user = User::find($id);
        if(!$user) {
            return response()->json(null, 404);
        }
        return $user;
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'lastname' => 'required|max:255',
            'email' => 'email|required|unique:users|max:255',
            'firstname' => 'required|max:255',
            'password' => 'required|max:255'
         ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id) {

        $user = User::find($id);
        if(!$user) {
            return response()->json(null, 404);
        }

        $validator = Validator::make($request->all(), [
            'lastname' => 'required|max:255',
            'email' => ['email','required','max:255',Rule::unique('users')->ignore($user)],
            'firstname' => 'required|max:255',
            'password' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json($user, 200);
    }

    public function partialUpdate(Request $request, $id) {
        return response()->json(null, 200);
    }

    public function delete($id) {
        $user = User::find($id);
        if(!$user) {
            return response()->json(null, 404);
        }
        $user->delete();
        return response()->json([], 204);
    }
}
