<?php

namespace App\Http\Livewire;

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

    public function addTag($name)
    {
        if (empty($name)) return;

        try {
            $tag = Tag::firstOrCreate(
                ['name' => trim($name)],
                [
                    'type' => $this->type,
                    'slug' => Str::slug(trim($name))
                ]
            );

            if (!in_array($tag->id, $this->selectedTags)) {
                $this->selectedTags[] = $tag->id;
                $this->tags[$tag->id] = $tag;
            }

            $this->tagInput = '';
            $this->suggestions = [];
        } catch (\Exception $e) {
            \Log::error('Tag oluşturma hatası: ' . $e->getMessage());
        }
    }

    // Diğer metodlar aynı kalacak
} 