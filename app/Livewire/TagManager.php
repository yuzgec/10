<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class TagManager extends Component
{
    public $tagInput = '';
    public $selectedTags = [];
    public $suggestions = [];
    public $tags = [];
    public $type;
    public $model;

    public function mount($type = 'product', $model = null)
    {
        $this->type = $type;
        $this->model = $model;

        if ($model) {
            $this->selectedTags = $model->tags()->pluck('id')->toArray();
            $this->tags = Tag::whereIn('id', $this->selectedTags)->get()->keyBy('id');
        }
    }

    public function updatedTagInput($value)
    {
        if (strlen($value) >= 3) {
            $this->suggestions = Tag::where('name', 'like', "%{$value}%")
                ->where('type', $this->type)
                ->limit(5)
                ->get()
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function selectSuggestion($name)
    {
        $this->tagInput = $name;
        $this->addTag();
    }

    public function addTag()
    {
        if (empty($this->tagInput)) return;

        try {
            $tag = Tag::firstOrCreate(
                ['name' => trim($this->tagInput)],
                ['type' => $this->type]
            );

            if (!in_array($tag->id, $this->selectedTags)) {
                $this->selectedTags[] = $tag->id;
                $this->tags[$tag->id] = $tag;
            }

            $this->tagInput = '';
            $this->suggestions = [];
        } catch (\Exception $e) {
            \Log::error('Product Tag oluşturma hatası: ' . $e->getMessage());
        }
    }

    public function removeTag($tagId)
    {
        $this->selectedTags = array_values(array_diff($this->selectedTags, [$tagId]));
        unset($this->tags[$tagId]);
    }

    public function render()
    {
        return view('livewire.tag-manager');
    }
}