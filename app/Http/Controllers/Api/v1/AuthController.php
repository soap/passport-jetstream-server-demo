<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends ApiBaseController
{

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required:email',
            'password' => 'required:string'
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user) {
            return response([
                'message' => 'The given data was invalid',
                'errors' => [
                    'email' => 'Bad email provided'
                ]
            ], 401);
        }
        if (!Auth::attempt($fields)) {
            return response([
                'message' => 'The given data was invalid',
                'errors' => [
                    'password' => 'Bad credentials provided'
                ]
            ], 401);
        }

        // Generate Personal Access Token and return response
        return (new UserResource($user))->response()->setStatusCode(200);
    }

    /**
     * @authenticated
     * Perform API logout, token will be deleted
     */
    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return $this->respondWithMessage('Successfully Logged out');
    }
}
