<div>
    <div class="card mb-3">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Etiketler</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="tag-input-wrapper position-relative">
                    <input 
                        type="text" 
                        wire:model.live="tagInput"
                        wire:keydown.enter.prevent="addTag($event.target.value)"
                        wire:keydown.tab.prevent="selectFirstSuggestion"
                        class="form-control"
                        placeholder="Etiket eklemek için yazın..."
                    >
                    
                    @if(!empty($suggestions))
                    <div class="tag-suggestions position-absolute w-100 bg-white border rounded-bottom">
                        @foreach($suggestions as $tag)
                        <div class="suggestion-item p-2 cursor-pointer hover:bg-light" 
                             wire:click="addTag('{{ $tag }}')"
                             @if($loop->first) id="first-suggestion" @endif>
                            {{ $tag }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="selected-tags">
                @foreach($selectedTags as $index => $tag)
                <span class="badge text-white bg-primary me-1 mb-1">
                    {{ $tag }}
                    <a href="#" wire:click.prevent="removeTag({{ $index }})" class="text-white ms-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                    </a>
                </span>
                @endforeach
            </div>

            @foreach($selectedTags as $tag)
            <input type="hidden" name="tags[]" value="{{ $tag }}">
            @endforeach
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
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .suggestion-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
    </style>
    @endpush
</div> 

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('notify', (data) => {
            toastr[data.type](data.message);
        });
    });
</script> 