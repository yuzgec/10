<div>
    @foreach($children as $child)
        <div class="category-item">
            <div class="category-header">
                <div class="d-flex align-items-center w-100">
                    @if($child->children->count() > 0)
                        <button type="button" 
                                class="btn-toggle {{ in_array($child->id, $expandedCategories) ? 'expanded' : '' }}"
                                wire:click.stop="toggleExpand({{ $child->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-toggle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="9 6 15 12 9 18" />
                            </svg>
                        </button>
                    @else
                        <span class="btn-toggle-placeholder"></span>
                    @endif

                    <label class="form-check category-label">
                        <input type="checkbox" 
                               class="form-check-input" 
                               wire:click="selectCategory({{ $child->id }})"
                               @checked(in_array($child->id, $selectedCategories))>
                        <span class="form-check-label">{{ $child->translate('tr')->name }}</span>
                    </label>
                </div>
            </div>
            
            @if($child->children->count() > 0)
                <div class="category-children {{ in_array($child->id, $expandedCategories) ? 'show' : '' }}">
                    @include('livewire.partials.category-children', [
                        'children' => $child->children,
                        'level' => $level + 1
                    ])
                </div>
            @endif
        </div>
    @endforeach
</div> 