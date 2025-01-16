<?php

namespace App\Livewire;

use App\Models\Faq;
use App\Models\Service;
use App\Models\Language;
use App\Enums\StatusEnum;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;

class ServiceFaq extends Component
{
    public Service $service;
    public $languages;
    public $faqs = [];
    
    #[Url]
    public $currentTab;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->languages = Language::active()->get();
        $this->currentTab = request()->get('tab', $this->languages->first()->lang);
        $this->loadFaqs();
    }

    protected function loadFaqs()
    {
        $this->faqs = [];

        // Sadece aktif tab'deki FAQ'ları getir
        $faqs = $this->service->faqs()
            ->with(['translations' => function($query) {
                $query->where('locale', $this->currentTab);
            }])
            ->get();

        foreach($faqs as $faq) {
            $translation = $faq->translations
                ->where('locale', $this->currentTab)
                ->first();

            if($translation) {
                $this->faqs[] = [
                    'id' => $faq->id,
                    'name' => $translation->name,
                    'desc' => $translation->desc ?? ''
                ];
            }
        }
    }

    public function addFaq()
    {
        $this->faqs[] = [
            'id' => null,
            'name' => '',
            'desc' => ''
        ];
    }

    public function removeFaq($index)
    {
        if(isset($this->faqs[$index]['id'])) {
            $faq = Faq::find($this->faqs[$index]['id']);
            $faq->translations()
                ->where('locale', $this->currentTab)
                ->delete();
            
            if($faq->translations->isEmpty()) {
                $faq->delete();
            }
        }

        unset($this->faqs[$index]);
        $this->faqs = array_values($this->faqs);
    }

    public function save()
    {
        $updatedFaqs = [];

        foreach($this->faqs as $faqData) {
            if(empty($faqData['name'])) continue;

            $faq = isset($faqData['id']) ? Faq::find($faqData['id']) : new Faq([
                'status' => StatusEnum::PUBLISHED,
                'category_id' => $this->service->category_id
            ]);

            if(!$faq->exists) {
                $faq->save();
                $this->service->faqs()->attach($faq->id);
            }

            $faq->translateOrNew($this->currentTab)->fill([
                'name' => $faqData['name'],
                'desc' => $faqData['desc'] ?? null
            ]);
            
            $faq->save();
            $updatedFaqs[] = $faq->id;
        }

        if(!empty($updatedFaqs)) {
            $this->dispatch('swal:success', [
                'type' => 'success',
                'message' => 'FAQ başarıyla kaydedildi.',
                'text' => $this->currentTab . ' dili için güncellendi'
            ]);
        }
        
        $this->loadFaqs();
    }

    public function render()
    {
        return view('livewire.service-faq', [
            'currentTab' => $this->currentTab
        ]);
    }
} 