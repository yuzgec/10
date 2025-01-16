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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </span>
                    <input type="text" 
                           class="form-control" 
                           placeholder="Kategori Ara..." 
                           wire:model.debounce.300ms="search">
                </div>
            </div>

            <div class="category-tree">
                @if($search)
                    @foreach($cat as $category)
                        <div class="category-item">
                            <label class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       wire:click="selectCategory({{ $category->id }})"
                                       @if(in_array($category->id, $selectedCategories)) checked @endif>
                                <span class="form-check-label">
                                    <span class="text-muted">{{ $category->full_path }}</span>
                                </span>
                            </label>
                        </div>
                    @endforeach
                @else
                    @foreach($cat as $category)
                        <div class="category-item">
                            <label class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       wire:click="selectCategory({{ $category->id }})"
                                       @if(in_array($category->id, $selectedCategories)) checked @endif>
                                <span class="form-check-label">{{ $category->name }}</span>
                            </label>
                            
                            @if($category->children->count() > 0)
                                <div class="category-children">
                                    @include('livewire.partials.category-children', [
                                        'children' => $category->children,
                                        'level' => 1
                                    ])
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
            padding-left: 0;
        }
        .category-item {
            margin-bottom: 0.5rem;
        }
        .category-children {
            margin-left: 1.5rem;
            margin-top: 0.5rem;
            border-left: 1px solid #e5e7eb;
            padding-left: 1rem;
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