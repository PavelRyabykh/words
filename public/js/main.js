$('document').ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Add Category
    function addCategory() {
        showLoad();
        $('#messages').html('');

        let name = $('#createCategoryForm input[name="name"]').val();
        $.ajax({
            url: '/categories',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
            },
            success: function (data) {
                let div = $('<div id="category-' + data.id + '" class="col-md-4">\n' +
                    '        <div id="card-' + data.id + '" class="card mb-4 shadow-sm">\n' +
                    '            <a href="/categories/' + data.id + '">\n' +
                    '                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="black"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">' + data.name + '</text></svg>\n' +
                    '            </a>\n' +
                    '            <div class="card-body">\n' +
                    '                <div class="d-flex justify-content-between align-items-center">\n' +
                    '                    <div class="btn-group">\n' +
                    '                        <button data-id="' + data.id + '" data-toggle="modal" data-target="#updateModal" id="updateCategory" type="button" class="btn btn-sm btn-outline-secondary btn-update">Изменить</button>\n' +
                    '                        <button data-id="' + data.id + '" type="button" class="btn-delete btn btn-sm btn-outline-secondary">Удалить</button>\n' +
                    '                    </div>\n' +
                    '                    <small class="text-muted">Добавлено: 0</small>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </div>');
                $('#createModal').modal('hide');
                $('#row').append(div)
                hideLoad();
            },
            error: function(data) {
                if (data.status === 422) {
                    let errors = data.responseJSON.errors.name;
                    let block = document.createElement('div');
                    $(block).addClass('alert');
                    $(block).addClass('alert-danger');
                    $(block).attr('role', 'alert');
                    for (let i = 0; i < errors.length; i++) {
                        $(block).append(errors[i]);
                    }
                    $('#messages').prepend(block)
                    hideLoad();
                    return;
                }

                alert('Произошла ошибка добавления');
            }
        });
        return false;
    }
    //send request
    $('body').on('click', '#addAction', addCategory);
    $('#createCategoryForm').on('submit', addCategory);

//Delete Category
    $('body').on('click', '.btn-delete', function () {
        showLoad();
        let event = this;
        $('#card-' + $(event).data('id')).addClass('delete-element');
        $.ajax({
            url: '/categories/' + $(this).data('id'),
            type: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function (data) {
                if(data == '1') {
                    $('#category-' + $(event).data('id')).hide('slow', function () {
                        $(this).remove();
                    });
                } else {
                    alert('Произошла ошибка удаления');
                    $('#card-' + $(event).data('id')).removeClass('delete-element');
                }
                hideLoad();
            },
            error: function () {
                alert('Произошла ошибка удаления');
                $('#card-' + $(event).data('id')).removeClass('delete-element');
                hideLoad();
            }
        });
    });

    //Update Category
    function updateCategory() {
        showLoad();
        $('#messagesUpdate').html('');
        let text = $('#updateForm input[type="text"]').val();
        let id = $('#updateForm input[type="hidden"]').val();

        $.ajax({
            url: '/categories/' + id,
            type: 'POST',
            data: {
                _method: 'PUT',
                name: text,
            },
            success: function (data) {
                if(data == '1') {
                    $('#category-' + id + ' text').text(text);
                    $('#updateModal').modal('hide');
                } else {
                    alert('Произошла ошибка обновления');
                }
                hideLoad();
            },
            error: function (data) {
                if (data.status === 422) {
                    let errors = data.responseJSON.errors.name;
                    let block = document.createElement('div');
                    $(block).addClass('alert');
                    $(block).addClass('alert-danger');
                    $(block).attr('role', 'alert');
                    for (let i = 0; i < errors.length; i++) {
                        $(block).append(errors[i]);
                    }
                    $('#messagesUpdate').prepend(block);
                    return;
                }
                alert('Произошла ошибка обновления');
                hideLoad();
            }
        });
        return false;
    }
      //Open modal
    $('body').on('click', '.btn-update', function () {
        let event = this;
        let id = $(event).data('id');
        let text = $('#category-' + id + ' text').text();
        $('#updateForm input[type="text"]').val(text);
        $('#updateForm input[type="hidden"]').val(id);
    });
      //Send requests
    $('#updateAction').on('click', updateCategory);
    $('#updateForm').on('submit', updateCategory);

    //Add Word
    function addWord() {
        showLoad();
        $('#messagesWord').html('');
        let word = $('#createWord input[name="word"]').val();
        let transcription = $('#createWord input[name="transcription"]').val();
        let translation = $('#createWord input[name="translation"]').val();
        let example = $('#exampleCreate').val();
        let category_id = $('#createWord input[name="category_id"]').val();

        $.ajax({
            url: '/words',
            type: 'POST',
            dataType: 'json',
            data: {
                word: word,
                transcription: transcription,
                translation: translation,
                example: example,
                category_id: category_id,
            },
            success: function (data) {
                let tr = $('<tr id="tr-' + data.id + '">\n' +
                    '    <th scope="row"><span class="count"></span></th>' +
                    '    <td id="word">' + data.word + '</td>\n' +
                    '    <td id="transcription">' + data.transcription + '</td>\n' +
                    '    <td id="translation">' + data.translation + '</td>\n' +
                    '    <td id="example">' + data.example + '</td>\n' +
                    '<td><a data-toggle="modal" data-target="#updateModal" data-id="' + data.id + '" class="edit"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\\n\n' +
                    '                 <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>\\n\n' +
                    '                <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>\\n\n' +
                    '                </svg></a>\n' +
                    '        <a data-id="' + data.id + '" class="delete" id="delete"><svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\\n\n' +
                    '                <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>\\n\n' +
                    '                 <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>\\n\n' +
                    '                 <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>\\n\n' +
                    '                </svg></a></td>' +
                    '</tr>');
                $('#createModal').modal('hide');
                $('table').append(tr);
                hideLoad();
            },
            error: function(data) {
                if (data.status === 422) {
                    let errors = data.responseJSON.errors;
                    console.log(errors);
                    let block = document.createElement('div');
                    $(block).addClass('alert');
                    $(block).addClass('alert-danger');
                    $(block).attr('role', 'alert');

                    for (key in errors) {
                        for (let i = 0; i < errors[key].length; i++) {
                            $(block).prepend(errors[key][i] + '<br>');
                        }
                    }

                    $('#messagesWord').prepend(block);
                    hideLoad();
                    return;
                }
                alert('Произошла ошибка добавления');
            }
        });
        return false;
    }
    $('#addWord').on('click', addWord);
    $("#createWord").keyup(function(event){
        if(event.keyCode == 13){
            addWord();
        }
    });
    //Delete word
    $('table').on('click', '.delete', function() {
        showLoad();
        let id = $(this).data('id');
        let block = $('#tr-' + id);

        $.ajax({
            url: '/words/' + id,
            type: 'POST',
            data: {
              _method: 'DELETE',
                category_id: $('#updateWord input[name="category_id"]').val(),
            },
            success: function (data) {
                if (data == '1') {
                    $(block).remove();
                } else {
                    alert('Произошла ошибка удаления');
                }
                hideLoad();
            },
            error: function () {
                alert('Произошла ошибка удаления');
                hideLoad();
            }
        });
    });

    //Update word
    $('table').on('click', '.edit', function () {
        $('#messagesWordUpdate').html('');
        let id = $(this).data('id');
        let word = $('#tr-' + id + ' #word').text();
        let transcription = $('#tr-' + id + ' #transcription').text();
        let translation = $('#tr-' + id + ' #translation').text();
        let example = document.querySelector('#tr-' + id + ' #example').textContent;

        $('#updateWord input[name="word"]').val(word);
        $('#updateWord input[name="transcription"]').val(transcription);
        $('#updateWord input[name="translation"]').val(translation);
        $('#updateWord input[name="word_id"]').attr('value', id);
        $('#exampleUpdate').val(example);
    });
    function updateWord() {
        showLoad();
        let id = $('#updateWord input[name="word_id"]').attr('value');
        let word = $('#updateWord input[name="word"]').val();
        let transcription = $('#updateWord input[name="transcription"]').val();
        let translation = $('#updateWord input[name="translation"]').val();
        let example = $('#exampleUpdate').val();

        $.ajax({
            url: '/words/' + id,
            type: 'POST',
            data: {
                _method: 'PUT',
                word: word,
                transcription: transcription,
                translation: translation,
                example: example,
                category_id: $('#updateWord input[name="category_id"]').val(),
            },
            success: function (data) {
                $('#tr-' + id + ' #word').text(data.word);
                $('#tr-' + id + ' #transcription').text(data.transcription);
                $('#tr-' + id + ' #translation').text(data.translation);
                $('#tr-' + id + ' #example').html(data.example);
                $('#updateModal').modal('hide');
                hideLoad();
            },
            error: function (data) {
                if (data.status === 422) {
                    let errors = data.responseJSON.errors;
                    console.log(errors);
                    let block = document.createElement('div');
                    $(block).addClass('alert');
                    $(block).addClass('alert-danger');
                    $(block).attr('role', 'alert');

                    for (key in errors) {
                        for (let i = 0; i < errors[key].length; i++) {
                            $(block).prepend(errors[key][i] + '<br>');
                        }
                    }

                    $('#messagesWordUpdate').prepend(block);
                    hideLoad();
                    return;
                }
                alert('Произошла ошибка обновления');
            }
        });
        return false;
    }
    $('#updateWordBtn').on('click', updateWord);
    $("#updateWord").keyup(function(event){
        if(event.keyCode == 13){
            updateWord();
        }
    });
});

function showLoad() {
    $('.load').css('display', 'flex');
}

function hideLoad() {
    $('.load').css('display', 'none');
}
