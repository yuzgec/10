@props([
    'name',
    'label',
    'categories',
    'selected' => [],
    'column' => 3,
    'level' => 0,
    'parent' => null
])

@if($level === 0)
<div class="form-group mb-3 row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="nested-categories">
@endif

                    @foreach($categories->where('parent_id', $parent) as $category)
                        <div class="category-item" style="margin-left: {{ $level * 20 }}px">
                            <label class="form-check">
                                <input type="checkbox" 
                                    class="form-check-input category-checkbox" 
                                    name="{{ $name }}[]" 
                                    value="{{ $category->id }}"
                                    data-category-id="{{ $category->id }}"
                                    data-parent-id="{{ $category->parent_id }}"
                                    {{ in_array($category->id, $selected) ? 'checked' : '' }}>
                                <span class="form-check-label">{{ $category->name }}</span>
                            
                            </label>

                            @if($categories->where('parent_id', $category->id)->count() > 0)
                                <x-dashboard.form.nested-categories 
                                    :name="$name"
                                    :categories="$categories"
                                    :selected="$selected"
                                    :level="$level + 1"
                                    :parent="$category->id"
                                />
                            @endif
                        </div>
                    @endforeach

@if($level === 0)
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.nested-categories {
    max-height: 400px;
    overflow-y: auto;
    padding: 0.5rem;
}
.category-item {
    padding: 13px 0;
}
.category-item .category-item {
    border-left: 1px solid #eee;
    margin-top: 3px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.category-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const isChecked = this.checked;
            
            // Sadece üst kategorileri kontrol et, alt kategorileri etkileme
            if (isChecked) {
                let parentElement = this;
                while (parentElement) {
                    const parentId = parentElement.dataset.parentId;
                    if (parentId) {
                        const parent = document.querySelector(`[data-category-id="${parentId}"]`);
                        if (parent) {
                            parent.checked = true;
                            parentElement = parent;
                        } else {
                            break;
                        }
                    } else {
                        break;
                    }
                }
            }
            
            // Alt kategorilerin seçimini kaldırdık
            // const children = document.querySelectorAll(`[data-parent-id="${this.dataset.categoryId}"]`);
            // children.forEach(child => {
            //     child.checked = isChecked;
            //     const event = new Event('change');
            //     child.dispatchEvent(event);
            // });
        });
    });
});
</script>
@endpush
@endif