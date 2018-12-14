<div class="form-group">
    <label for="slug">Ссылка</label>
    <input type="text" class="form-control" name="slug" id="slug" value="{{isset($page) ? $page->getSlug() : ''}}" {{isset($page) ? 'readonly=""' : ''}} />
</div>
<div class="form-group">
    <label for="title">Описание</label>
    <input type="text" class="form-control" name="title" id="title" value="{{isset($page) ? $page->getTitle() : ''}}" />
</div>
<div class="form-group">
    <textarea class="form-control" name="content" id="page-content">{!! isset($page) ? $page->getContent() : '' !!}</textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Сохранить"  />
</div>