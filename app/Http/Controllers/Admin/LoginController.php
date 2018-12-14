<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\Admin\LoginHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function render()
    {
        return view('admin.login');
    }

    public function login(Request $request, LoginHandler $handler)
    {
        try {
            $handler->handle($request->get('token'));

            return redirect()->route('admin')->with('success_message', 'Вы успешно авторизовались');
        } catch (\Exception $exception) {
            return redirect('/');
        }
    }
}
