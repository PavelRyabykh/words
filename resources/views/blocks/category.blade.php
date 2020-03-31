<div id="category-{{ $category->id }}" class="col-md-4">
        <div id="card-{{ $category->id }}" class="card mb-4 shadow-sm">
            <a href="/categories/{{ $category->id }}">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="black"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $category->name }}</text></svg>
            </a>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button data-id="{{ $category->id }}" data-toggle="modal" data-target="#updateModal" id="updateCategory" type="button" class="btn btn-sm btn-outline-secondary btn-update">Изменить</button>
                        <button data-id="{{ $category->id }}" type="button" class="btn-delete btn btn-sm btn-outline-secondary">Удалить</button>
                    </div>
                    <small class="text-muted">Добавлено: {{ count($category->words) }}</small>
                </div>
            </div>
        </div>
    </div>

