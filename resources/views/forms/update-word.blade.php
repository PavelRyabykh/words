<form id="updateWord">
    <div class="form-group">
        <label for="exampleInputEmail1">Слово</label>
        <input type="text" name="word" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Транскрипция</label>
        <input type="text" name="transcription" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Перевод</label>
        <input type="text" name="translation" class="form-control">
    </div>
    <input type="hidden" name="category_id" value="{{ $id }}">
    <input type="hidden" name="word_id" value="">
</form>
<div class="form-group">
    <label for="exampleFormControlTextarea2">Пример</label>
    <textarea name="example" class="form-control" id="exampleUpdate" rows="3"></textarea>
</div>
