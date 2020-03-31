<form id="createWord">
    <div class="form-group">
        <label>Слово</label>
        <input type="text" name="word" class="form-control">
    </div>
    <div class="form-group">
        <label>Транскрипция</label>
        <input type="text" name="transcription" class="form-control">
    </div>
    <div class="form-group">
        <label>Перевод</label>
        <input type="text" name="translation" class="form-control">
    </div>
    <input type="hidden" name="category_id" value="{{ $id }}">
</form>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Пример</label>
    <textarea name="example" class="form-control" id="exampleCreate" rows="3"></textarea>
</div>
