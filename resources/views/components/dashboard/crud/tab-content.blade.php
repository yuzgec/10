@foreach($language as $lang)
<div class="tab-content">
    <div class="tab-pane @if ($loop->first) active show @endif" id="{{$lang->lang}}" role="tabpanel">

        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-body">
                <x-dashboard.form.input label='Başlık' name='name:{{ $lang->lang }}' placeholder="Sayfa Adı Giriniz ({{ $lang->native }})" maxlength="40"/>
                <x-dashboard.form.text-area label='Kısa Açıklama' name='short:{{ $lang->lang }}'/>
                <x-dashboard.form.text-area label='Açıklama' name='desc:{{ $lang->lang }}' id='desc'/>
            </div>
        </div>

        <x-dashboard.site.seo :lang="$lang" />

    </div>       
</div>
@endforeach