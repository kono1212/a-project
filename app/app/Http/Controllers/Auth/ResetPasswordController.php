<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller

{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
    
        // リセットトークンを生成
        $resetToken = Str::random(60);
    
        // パスワードリセットのロジックを変更
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) use ($resetToken) {
                $this->resetPassword($user, $password, $resetToken);
            }
        );
    
        if ($response == Password::PASSWORD_RESET) {
            // リセットが成功した場合は、適切なResponseを返す
            return $this->sendResetResponse($request, $response);
        } else {
            // リセットが失敗した場合は、適切なResponseを返す
            return $this->sendResetFailedResponse($request, $response);
        }
    }
    
    // パスワードリセットのメソッドを修正
    protected function resetPassword($user, $password, $resetToken)
    {
        $user->reset_token = $resetToken; // リセットトークンを保存
        $user->password = Hash::make($password);
        $user->save();
    }
    
}
