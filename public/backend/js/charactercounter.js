$(document).ready(function() {
    $('input[maxlength]').each(function() {
    const input = $(this);
    const maxLength = input.attr('maxlength');
    const charCountElem = input.next('.charCount');
    
    if (!charCountElem.length) return; // Eğer sayaç elementi yoksa atla

    function updateCounter() {
        const currentLength = input.val().length;
        const remaining = maxLength - currentLength;
        charCountElem.text(`${maxLength}/${remaining} karakter kaldı`);

        // Limit aşımı kontrolü
        if (currentLength > maxLength - 1) {
            charCountElem.addClass('over-limit');
        } else {
            charCountElem.removeClass('over-limit');
        }
    }

    // Başlangıç değerini ayarla
    updateCounter();

    // Input değiştiğinde sayacı güncelle
    input.on('input', updateCounter);
});
    
    $('input[type="checkbox"]').on('change', function(){
        this.value ^= 1;
    });
});