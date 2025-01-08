<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class CustomerTagManager extends Component
{
    public $selectedTags = [];
    public $tags = [];
    public $type = 'customer';
    public $model;
    public $jobTypes;

    public function mount($model = null)
    {
        $this->model = $model;
        $this->jobTypes = Tag::where('type', 'job')->orderBy('name')->get();

        if ($model) {
            $this->selectedTags = $model->tags()->pluck('id')->toArray();
            $this->tags = Tag::whereIn('id', $this->selectedTags)->get()->keyBy('id');
        }
    }

    public function toggleTag($tagId)
    {
        try {
            $tag = Tag::findOrFail($tagId);
            
            if (!is_array($this->selectedTags)) {
                $this->selectedTags = [];
            }
            
            if (in_array($tagId, $this->selectedTags)) {
                $this->selectedTags = array_values(array_diff($this->selectedTags, [$tagId]));
                unset($this->tags[$tagId]);
            } else {
                $this->selectedTags[] = (int)$tagId;
                $this->tags[$tagId] = $tag;
            }

            if ($this->model) {
                $this->model->tags()->sync($this->selectedTags);
            }
            
        } catch (\Exception $e) {
            \Log::error('Tag toggle hatası: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.customer-tag-manager');
    }
} 