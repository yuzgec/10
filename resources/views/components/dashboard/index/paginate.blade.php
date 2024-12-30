@props(['model', 'name'])
<div class="d-flex align-items-center justify-content-center mt-2">
    {{ $model->appends(['siralama' => $name, 'q' => request('q'), 'category_id' => request('category_id')])->links() }}
</div>