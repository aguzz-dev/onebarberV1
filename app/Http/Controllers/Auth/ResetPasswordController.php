<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordLink;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LinkEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'message' => 'Password reset successfully'
        ], Response::HTTP_OK);
    }

    public function sendLinkResetPassword(LinkEmailRequest $request)
    {
        $url = URL::temporarySignedRoute('user.reset-password-mail',
            now()->addMinutes(10), ['email' => $request->email]);

        Mail::to($request->email)->send(new ResetPasswordLink($url));

        return response()->json([
            'message' => 'Reset password link sent on your email'
        ], Response::HTTP_OK);
    }

    public function resetPasswordFromMail(Request $request)
    {
        if($request->password != $request->password_confirmation){
            return response()->json([
                'message' => 'Invalid password'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            "message" => "Password has been changed"
        ], Response::HTTP_OK);

    }
}
