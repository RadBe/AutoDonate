<?php

namespace App\Http\Controllers\Admin\Servers;

use App\DataObjects\Server\SaveDataObject;
use App\Exceptions\Server\ServerNotFoundException;
use App\Handlers\Admin\Servers\EditHandler;
use App\Http\Request\Admin\ServerSaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class EditController extends Controller
{
    public function render(EditHandler $handler, int $id)
    {
        NavMenu::$active = 'admin.servers';

        try {
            return view('admin.servers.edit', [
                'server' => $handler->getServer($id)
            ]);
        } catch (ServerNotFoundException $exception) {
            return redirect()->route('admin.servers')->withErrors($exception->getMessage());
        }
    }

    public function edit(ServerSaveRequest $request, EditHandler $handler, int $id)
    {
        try {
            $handler->handle(new SaveDataObject(
                $request->get('name'),
                $request->get('r_ip'),
                (int) $request->get('r_port'),
                $request->get('r_pass'),
                (int) $request->get('enabled')
            ), $handler->getServer($id));

            return redirect()->route('admin.servers.edit', ['id' => $id])
                ->with('success_message', 'Сервер был успешно изменен');
        } catch (ServerNotFoundException $exception) {
            return redirect()->route('admin.servers')->withErrors($exception->getMessage());
        } catch (ValidationException $exception) {
            return redirect()->route('admin.servers.edit', ['id' => $id])->withErrors($exception->getMessage());
        }
    }
}
