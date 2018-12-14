<?php

namespace App\Http\Controllers\Admin\Servers;

use App\DataObjects\Server\SaveDataObject;
use App\Exceptions\Server\ServerNotFoundException;
use App\Handlers\Admin\Servers\CreateHandler;
use App\Http\Request\Admin\ServerSaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function render()
    {
        NavMenu::$active = 'admin.servers';

        return view('admin.servers.create');
    }

    public function create(ServerSaveRequest $request, CreateHandler $handler)
    {
        try {
            $handler->handle(new SaveDataObject(
                $request->get('name'),
                $request->get('r_ip'),
                (int) $request->get('r_port'),
                $request->get('r_pass'),
                (int) $request->get('enabled')
            ));

            return redirect()->route('admin.servers')
                ->with('success_message', 'Сервер был успешно создан');
        } catch (ServerNotFoundException $exception) {
            return redirect()->route('admin.servers')->withErrors($exception->getMessage());
        } catch (ValidationException $exception) {
            return redirect()->route('admin.servers.create')->withErrors($exception->getMessage());
        }
    }
}
