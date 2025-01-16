<div>
    @foreach($children as $child)
        <div class="category-item">
            <label class="form-check">
                <input type="checkbox" 
                       class="form-check-input"
                       wire:click="selectCategory({{ $child->id }})"
                       @if(in_array($child->id, $selectedCategories)) checked @endif>
                <span class="form-check-label">{{ $child->name }}</span>
            </label>
            
            @if($child->children->count() > 0)
                <div class="category-children">
                    @include('livewire.partials.category-children', [
                        'children' => $child->children,
                        'level' => $level + 1
                    ])
                </div>
            @endif
        </div>
    @endforeach
</div> 