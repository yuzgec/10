<div class="card mt-3">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <h4 class="card-title"><x-dashboard.icon.google/>Seo Bilgileri</h4>
        <div class="card-actions">
            <div class="p-1">
                <x-dashboard.icon.info color="rgb(60, 62, 78)" width="16"/>
                <small class="ml-3" style="color:rgb(60, 62, 78)">
                    Verilen sınırlar içirinde yazmanız sitenizin google <br>performansında önemli rol almaktadır.
                </small>
         
            </div>
        </div>
    </div>
    <div class="card-body">
        <x-dashboard.form.input label="Seo Başlık" name="seoTitle:{{ $lang->lang }}" id="seoTitle" maxlength="65" placeholder="Sayfa Başlığı Giriniz"/>
        <x-dashboard.form.input label="Seo Açıklama" name="seoDesc:{{ $lang->lang }}" id="seoDesc" maxlength="160" placeholder="Sayfa Açıklamsı Giriniz"/>
        <x-dashboard.form.input label="Seo Anahtar Kelime " name="seoKey:{{ $lang->lang }}" id="seoKey" maxlength="250" placeholder="Anahtar kelime Giriniz"/>
    </div>
</div>