<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagManager extends Component
{
    public $selectedTags = [];
    public $tagsList = [];
    public $search = '';
    public $tags = [];
    public $type;
    public $model;

    public function mount($type = null, $model = null)
    {
        $this->type = $type;
        $this->model = $model;

        if ($model) {
            $this->selectedTags = $model->tags()->pluck('id')->toArray();
            $this->tagsList = $model->tags()->pluck('name', 'id')->toArray();
        }
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->tags = [];
            return;
        }

        $this->tags = Tag::query()
            ->when($this->type, function($query) {
                return $query->where('type', $this->type);
            })
            ->where('name', 'like', '%' . $this->search . '%')
            ->whereNotIn('id', $this->selectedTags)
            ->get()
            ->map(function($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name
                ];
            })
            ->toArray();
    }

    public function selectTag($tagId)
    {
        $tag = Tag::find($tagId);
        
        if ($tag && !in_array($tagId, $this->selectedTags)) {
            $this->selectedTags[] = $tagId;
            $this->tagsList[$tagId] = $tag->name;
            $this->search = '';
            $this->tags = [];
        }
    }

    public function removeTag($tagId)
    {
        $this->selectedTags = array_values(array_diff($this->selectedTags, [$tagId]));
        unset($this->tagsList[$tagId]);
    }

    public function render()
    {
        return view('livewire.tag-manager');
    }
}