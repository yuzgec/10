<div>
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Kategoriler</h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="categories[]" value="{{ json_encode($selectedCategories) }}">
            
            <div class="mb-3">
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <x-dashboard.icon.search />
                    </span>
                    <input type="text" 
                           class="form-control" 
                           placeholder="Kategori Ara..." 
                           wire:model.live.debounce.300ms="search">
                </div>
            </div>

            <div class="category-tree">
                @if($search)
                    @foreach($cat as $category)
                        <div class="category-item">
                            <label class="form-check category-label">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       wire:click="selectCategory({{ $category->id }})"
                                       @checked(in_array($category->id, $selectedCategories))>
                                <span class="form-check-label">
                                    <span class="text-muted">{{ $category->translate('tr')->name }}</span>
                                </span>
                            </label>
                        </div>
                    @endforeach
                @else
                    @foreach($cat as $category)
                        <div class="category-item">
                            <div class="category-header">
                                <div class="d-flex align-items-center w-100">
                                    @if($category->children && $category->children->count() > 0)
                                        <button type="button" 
                                                class="btn-toggle {{ in_array($category->id, $expandedCategories) ? 'expanded' : '' }}"
                                                wire:click.stop="toggleExpand({{ $category->id }})">
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
                                               wire:click="selectCategory({{ $category->id }})"
                                               @checked(in_array($category->id, $selectedCategories))>
                                        <span class="form-check-label">{{ $category->translate('tr')->name }}</span>
                                    </label>
                                </div>
                            </div>
                            
                            @if($category->children && $category->children->count() > 0)
                                <div class="category-children {{ in_array($category->id, $expandedCategories) ? 'show' : '' }}">
                                    @foreach($category->children as $child)
                                        <div class="category-item">
                                            <div class="category-header">
                                                <div class="d-flex align-items-center w-100">
                                                    @if($child->children && $child->children->count() > 0)
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

                                            @if($child->children && $child->children->count() > 0)
                                                <div class="category-children {{ in_array($child->id, $expandedCategories) ? 'show' : '' }}">
                                                    @include('livewire.partials.category-children', [
                                                        'children' => $child->children,
                                                        'level' => 2
                                                    ])
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <style>
    .category-tree {
        max-height: 400px;
        overflow-y: auto;
        padding: 0.5rem;
    }
    
    .category-item {
        margin-bottom: 0.25rem;
    }
    
    .category-header {
        display: flex;
        align-items: center;
        padding: 0.25rem;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    
    .category-header:hover {
        background-color: var(--tblr-light);
    }
    
    .btn-toggle {
        background: none;
        border: none;
        width: 24px;
        height: 24px;
        padding: 0;
        margin-right: 0.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-toggle .icon-toggle {
        transition: transform 0.2s;
    }
    
    .btn-toggle.expanded .icon-toggle {
        transform: rotate(90deg);
    }
    
    .btn-toggle-placeholder {
        width: 24px;
        margin-right: 0.5rem;
    }
    
    .category-label {
        margin: 0;
        cursor: pointer;
        padding: 0.25rem;
        flex: 1;
    }
    
    .category-children {
        margin-left: 2rem;
        border-left: 1px solid var(--tblr-border-color);
        padding-left: 0.5rem;
        display: block !important;
    }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('selectedCategoriesUpdated', (event) => {
                document.querySelector('input[name="categories[]"]').value = JSON.stringify(event.selectedCategories);
            });
        });
    </script>
    @endpush
</div> 