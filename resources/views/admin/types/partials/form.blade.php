<div class="form-group">
    <label for="type">ID</label>
    <input type="text" class="form-control" name="type" id="type" value="{{isset($type) ? $type->getType() : ''}}" {{isset($type) ? 'readonly=""' : ''}} />
</div>
<div class="form-group">
    <label for="name">Название</label>
    <input type="text" class="form-control" name="name" id="name" value="{{isset($type) ? $type->getName() : ''}}" />
</div>
<div class="form-group">
    <label for="surcharge">Доплата</label>
    <select name="surcharge" id="surcharge" class="form-control">
        <option value="0">Отключена</option>
        <option value="1" {{isset($type) && $type->isSurcharge() ? 'selected' : ''}}>Включена</option>
    </select>
</div>
<div class="form-group">
    <label for="distributor">Дистрибьютор</label>
    <select name="distributor" id="distributor" class="form-control">
        @foreach($distributors as $distributor)
            <option {{isset($type) && $type->getDistributor() == $distributor ? 'selected' : ''}}>{{$distributor}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="data">Дополнительно (в json формате)</label>
    <input type="text" class="form-control" name="data" id="data" value="{{isset($type) ? $type->getData() : ''}}" />
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Сохранить"  />
</div>