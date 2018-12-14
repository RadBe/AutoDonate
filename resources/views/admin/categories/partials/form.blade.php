<div class="form-group">
    <label for="server">Сервер</label>
    <select name="server" id="server" class="form-control">
        <?php /* @var \App\Entity\Server[] $servers */ ?>
        @foreach($servers as $server)
            <option value="{{$server->getId()}}" {{isset($category) && $category->getId() == $server->getId() ? 'selected' : ''}}>{{$server->getName()}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="type">Тип</label>
    <select name="type" id="type" class="form-control">
        <?php /* @var \App\Entity\ProductType[] $types */ ?>
        @foreach($types as $type)
            <option value="{{$type->getType()}}" {{isset($category) && $category->getType()->getType() == $type->getType() ? 'selected' : ''}}>{{$type->getName()}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Название</label>
    <input type="text" class="form-control" name="name" id="name" value="{{isset($category) ? $category->getName() : ''}}" />
</div>
<div class="form-group">
    <label for="weight">Вес категории (для сортировки)</label>
    <input type="number" class="form-control" name="weight" id="weight" min="1" value="{{isset($category) ? $category->getWeight() : '0'}}" />
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Сохранить"  />
</div>