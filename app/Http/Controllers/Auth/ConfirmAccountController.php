<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

class ConfirmAccountController extends Controller
{
    public function verificationNotice() {
    	return view('auth.verify-email');
    }

    public function verificationVerify(EmailVerificationRequest $request, $id) {
    	$request->fulfill();

	    $user = User::find($id);
	    $user->status = User::ACTIVE;
        $user->user_ip = $request->ip();
	    $user->update();

	    return redirect()->to('/')->with('good', 'Nice work!');
    }

    public function verificationVend(Request $request) {
    	$request->user()->sendEmailVerificationNotification();

    	return back()->with('message', 'Verification link sent!');
    }
}
