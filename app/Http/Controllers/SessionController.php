<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required_without:idcard|email',
            'idcard' => 'required_without:email|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->has('email')
            ? $request->only('email', 'password')
            : ['idcard' => $request->idcard, 'password' => $request->password];

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $user = User::find(Auth::id());

        if (!$user->is_active) {
            Auth::logout();
            return response()->json(['message' => 'Cuenta desactivada'], 403);
        }

        if($user->mfa_enabled){
            $token = $user->createToken('mfa-token', ['mfa-verify'])->plainTextToken;

            return response()->json([
                'mfa_required' => true,
                'mfa_token'    => $token,
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function verifyMfa(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = $request->user();

        if (!$user->tokenCan('mfa-verify')) {
            return response()->json(['message' => 'Token no válido'], 403);
        }

        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $valid = $google2fa->verifyKey($user->mfa_secret, $request->code);

        if (!$valid) {
            return response()->json(['message' => 'Código incorrecto'], 401);
        }

        $user->currentAccessToken()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);

    }

    public function setupMfa(Request $request)
    {
        $user = $request->user();

        if ($user->mfa_enabled) {
            return response()->json(['message' => 'MFA ya está activado'], 400);
        }

        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $secret = $google2fa->generateSecretKey();

        $user->update(['mfa_secret' => $secret]);

        $qrUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        return response()->json([
            'secret' => $secret,
            'qr_url' => $qrUrl,
        ]);
    }

     public function confirmMfa(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = $request->user();

        if ($user->mfa_enabled) {
            return response()->json(['message' => 'MFA ya está activado'], 400);
        }

        if (!$user->mfa_secret) {
            return response()->json(['message' => 'Primero ejecuta el setup de MFA'], 400);
        }

        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $valid = $google2fa->verifyKey($user->mfa_secret, $request->code);

        if (!$valid) {
            return response()->json(['message' => 'Código incorrecto, vuelve a escanear el QR'], 401);
        }

        $user->update(['mfa_enabled' => true]);

        return response()->json(['message' => 'MFA activado correctamente']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
