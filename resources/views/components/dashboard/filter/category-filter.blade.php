<div class="d-none d-sm-inline-block p-1">
    <form>
        <select class="form-select" name="category_id" onchange="location = this.value;">
            <option value="?category_id=0" {{ $selectedId == 0 ? 'selected' : null }}>Hepsi</option>
            @foreach ($categories ?? [] as $category)
                <option value="?category_id={{ $category->id }}" {{ $selectedId == $category->id ? 'selected' : null }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>
</div> 