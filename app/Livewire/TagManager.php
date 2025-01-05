<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class TagManager extends Component
{
    public $tagInput = '';
    public $suggestions = [];
    public $selectedTags = [];
    public $type;
    public $model;

    protected $messages = [
        'tag.exists' => 'Bu etiket zaten eklenmiş.',
        'tag.created' => 'Yeni etiket oluşturuldu.',
    ];

    public function mount($type = 'product', $selectedTags = [], $model = null)
    {
        $this->type = $type;
        $this->model = $model;
        $this->selectedTags = $selectedTags;
    }

    public function updatedTagInput()
    {
        if (strlen($this->tagInput) >= 2) {
            $this->suggestions = Tag::withType($this->type)
                ->where('name->tr', 'like', '%' . $this->tagInput . '%')
                ->orWhere('name->en', 'like', '%' . $this->tagInput . '%')
                ->get()
                ->pluck('name')
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function addTag($tagName)
    {
        $tagName = trim($tagName);
        if (!empty($tagName)) {
            if (in_array($tagName, $this->selectedTags)) {
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Bu etiket zaten eklenmiş.'
                ]);
                return;
            }

            // Etiket var mı kontrol et
            $tag = Tag::withType($this->type)
                ->where('name->tr', $tagName)
                ->orWhere('name->en', $tagName)
                ->first();

            // Etiket yoksa oluştur
            if (!$tag) {
                $tag = Tag::create([
                    'type' => $this->type,
                    'name' => [
                        'tr' => $tagName,
                        'en' => $tagName
                    ],
                    'slug' => [
                        'tr' => Str::slug($tagName),
                        'en' => Str::slug($tagName)
                    ]
                ]);

                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Yeni etiket oluşturuldu.'
                ]);
            }

            $this->selectedTags[] = $tagName;
        }
        
        $this->tagInput = '';
        $this->suggestions = [];
    }

    public function removeTag($index)
    {
        unset($this->selectedTags[$index]);
        $this->selectedTags = array_values($this->selectedTags);
    }

    public function selectFirstSuggestion()
    {
        if (!empty($this->suggestions)) {
            $this->addTag($this->suggestions[0]);
        }
    }

    public function render()
    {
        return view('livewire.tag-manager');
    }
} 