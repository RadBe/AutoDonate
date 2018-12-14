<div class="form-group">
    <label for="name">Название</label>
    <input type="text" class="form-control" name="name" id="name" value="{{isset($server) ? $server->getName() : ''}}" autocomplete="off" />
</div>
<div class="form-group">
    <label for="r_ip">RCON-IP</label>
    <input type="text" class="form-control" name="r_ip" id="r_ip" value="{{isset($server) ? $server->getRconIP() : ''}}" />
</div>
<div class="form-group">
    <label for="r_port">RCON-Порт</label>
    <input type="number" class="form-control" name="r_port" id="r_port" min="1" value="{{isset($server) ? $server->getRconPort() : '1'}}" />
</div>
<div class="form-group">
    <label for="r_pass">RCON-Пароль</label>
    <input type="password" class="form-control" name="r_pass" id="r_pass" value="{{isset($server) ? $server->getRconPass() : ''}}"  autocomplete="new-password" />
</div>
<div class="form-group">
    <label for="enabled">Видимость</label>
    <select name="enabled" id="enabled" class="form-control">
        <option value="0">Скрыт</option>
        <option value="1" {{isset($server) && $server->isEnabled() ? 'selected' : ''}}>Видим</option>
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Сохранить"  />
</div>