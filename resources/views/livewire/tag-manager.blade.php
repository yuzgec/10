<div class="tag-manager">
    <div class="card">
        <div class="card-status-top bg-primary"></div>
        <div class="card-header">
            <h3 class="card-title">
                <x-dashboard.icon.tag class="me-2"/> Etiketler
            </h3>
        </div>
        <div class="card-body">
            <!-- Arama Input -->
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <x-dashboard.icon.search/>
                </span>
                <input type="text" 
                       class="form-control" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Etiket ara veya ekle...">
            </div>

            <!-- Öneriler -->
            @if($search && count($tags) > 0)
                <div class="list-group list-group-flush mb-3">
                    @foreach($tags as $tag)
                        <a href="#" 
                           class="list-group-item list-group-item-action d-flex align-items-center" 
                           wire:click.prevent="selectTag({{ $tag['id'] }})">
                            <x-dashboard.icon.add class="me-2"/>
                            {{ $tag['name'] }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Seçili Etiketler -->
            @if(count($selectedTags) > 0)
                <div class="tags">
                    @foreach($selectedTags as $tagId)
                        <span class="badge bg-primary-lt me-1 mb-1 p-2">
                            {{ $tagsList[$tagId] ?? '' }}
                            <a href="#" 
                               class="ms-1 text-muted" 
                               wire:click.prevent="removeTag({{ $tagId }})">
                                <x-dashboard.icon.delete width="14" height="14"/>
                            </a>
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Hidden Inputs -->
            @foreach($selectedTags as $tagId)
                <input type="hidden" name="tags[]" value="{{ $tagId }}">
            @endforeach
        </div>
    </div>

    <style>
        .input-icon-addon {
            color: #6e7582;
        }
        .badge .icon {
            vertical-align: -2px;
        }
        .list-group-item-action:hover {
            background-color: #f8fafc;
        }
        .badge a:hover {
            color: #d63939 !important;
        }
    </style>
</div> 