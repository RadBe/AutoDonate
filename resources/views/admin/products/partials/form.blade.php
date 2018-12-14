<div class="form-group">
    <label for="category">Категория</label>
    <select name="category" id="category" class="form-control">
        @foreach($categories as $category)
            <option value="{{$category->getId()}}" {{isset($product) && $product->getCategory()->getId() == $category->getId() ? 'selected' : ''}}>{{$category->getName()}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Название</label>
    <input type="text" class="form-control" name="name" id="name" value="{{isset($product) ? $product->getName() : ''}}" />
</div>
<div class="form-group">
    <label for="price">Цена</label>
    <input type="number" class="form-control" name="price" id="price" min="1" value="{{isset($product) ? $product->getPrice() : ''}}" />
</div>
<div id="another_data"></div>
<div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Сохранить"  />
</div>