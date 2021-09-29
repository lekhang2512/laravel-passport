<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * The UserRepository instance
     *
     * @var [UserRepository]
     */
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;

    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:woo_fb_pixel_users,email',
                'password' => 'required|string|confirmed',
            ]);

            $user = $this->userRepo->store([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ]);

            return $this->successResponse($response->json());

        } catch (ValidationException $validationException) {
            return $this->errorResponse([
                'errors'    => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email|exists:woo_fb_pixel_users,email',
                'password' => 'required|string',
            ]);

            $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ]);

            return $this->successResponse($response->json());

        } catch (ValidationException $validationException) {
            return $this->errorResponse([
                'errors'    => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $this->validate($request, [
                'refresh_token' => 'required|string',
            ]);

            $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
                'grant_type' => 'refresh_token',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'refresh_token' => $request->refresh_token,
                'scope' => '',
            ]);

            return $this->successResponse($response->json());

        } catch (ValidationException $validationException) {
            return $this->errorResponse([
                'errors'    => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Throwable $t) {
            throw $t;
        }
    }
}
