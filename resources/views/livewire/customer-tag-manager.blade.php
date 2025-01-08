<div>
    <h4 class="card-title mb-3">
        <x-dashboard.icon.menu-list/> İş Türleri
    </h4>
    
    @foreach($selectedTags as $tagId)
        <input type="hidden" name="selectedTags[]" value="{{ $tagId }}">
    @endforeach
    
    <div class="list-group list-group-flush mb-3">
        @foreach($jobTypes as $jobType)
            <div class="list-group-item d-flex justify-content-between align-items-center p-2">
                <label class="form-check d-flex align-items-center gap-2 mb-0">
                    <input type="checkbox" 
                           class="form-check-input"
                           wire:click="toggleTag({{ $jobType->id }})"
                           @checked(in_array($jobType->id, $selectedTags))>
                    <span>{{ $jobType->name }}</span>
                </label>
            </div>
        @endforeach
    </div>

    @if(count($tags) > 0)
        <div class="selected-tags">
            @foreach($tags as $tag)
                <span class="badge text-white p-2 bg-primary me-1 mb-1">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('customer-tags-updated', (event) => {
            const input = document.querySelector('input[name="selectedTags[]"]');
            if (input && event.tags) {
                input.value = event.tags;
            }
        });
    });
</script>
@endpush 

