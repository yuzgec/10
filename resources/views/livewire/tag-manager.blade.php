    <div class="card mb-3">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.tag/> Etiketler</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="tag-input-wrapper position-relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="tagInput"
                        wire:keydown.enter.prevent="addTag"
                        wire:keydown.tab.prevent="addTag"
                        wire:keydown.arrow-down.prevent="$set('highlightIndex', 0)"
                        class="form-control"
                        placeholder="Etiket eklemek için yazın ve enter'a basın..."
                    >
                    
                    @if(!empty($suggestions))
                    <div class="tag-suggestions position-absolute w-100 bg-white border rounded-bottom">
                        @foreach($suggestions as $suggestion)
                        <div class="suggestion-item p-2 cursor-pointer hover:bg-light" 
                             wire:click="selectSuggestion('{{ $suggestion['name'] }}')"
                             wire:key="suggestion-{{ $suggestion['id'] }}">
                            {{ $suggestion['name'] }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="selected-tags">
                @foreach($tags as $tag)
                    <span class="badge text-white bg-primary me-1 mb-1 p-2">
                        {{ $tag->name }}
                        <a href="#" wire:click.prevent="removeTag({{ $tag->id }})" class="text-white ms-1">×</a>
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    @push('styles')
    <style>
    .tag-input-wrapper {
        position: relative;
    }
    .tag-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 9999;
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        background: #fff;
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 0 0 4px 4px;
    }
    .suggestion-item {
        padding: 8px 12px;
        border-bottom: 1px solid #f0f0f0;
    }
    .suggestion-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .suggestion-item:last-child {
        border-bottom: none;
    }
    </style>
    @endpush 