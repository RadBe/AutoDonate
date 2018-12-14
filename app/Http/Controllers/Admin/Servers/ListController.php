<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Exceptions\Server\ServerNotFoundException;
use App\Handlers\Admin\Servers\DeleteHandler;
use App\Handlers\Admin\Servers\ListHandler;
use App\NavMenu;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function render(ListHandler $handler)
    {
        NavMenu::$active = 'admin.servers';

        return view('admin.servers.list', [
            'servers' => $handler->getServers()
        ]);
    }

    public function delete(DeleteHandler $handler, int $id)
    {
        try {
            $server = $handler->getServer($id);

            $handler->handle($server);

            return redirect()->route('admin.servers')
                ->with('success_message', "Вы успешно удалили сервер #{$server->getName()}");
        } catch (ServerNotFoundException $exception) {
            return redirect()->route('admin.servers')->withErrors($exception->getMessage());
        }
    }
}
