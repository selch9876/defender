<div class="form-group">
    <label for="title">Başlık</label>
    <input type="text" id="title" class="form-control" name="title" value="{{ old('title', optional($program ?? null)->title) }}">
</div>
    
<div>
    <label for="content">Açıklama</label>
    <textarea name="content" id="content" class="form-control">{{ old('content', optional($program ?? null)->content) }}</textarea>
</div>

<div>
    <label for="embed-link">Embed Linki</label>
    <input type="text" name="embed_link" id="embed-link" class="form-control" value="{{ old('embed_link', optional($program ?? null)->embed_link) }}">
</div>

<div class="form-group">
    <label><strong>Kategori :</strong></label><br>
    @foreach($categories as $category)
    <label><input type="checkbox" name="category_id[]"  value="{{ $category->id }}"> {{ $category->name }}</label>
    @endforeach
</div>  

<div class="form-group">
    <input type="file" name="thumbnail" class="form-control-file"/>
</div>
    
@errors @enderrors    