

<script src="/backend/js/tabler.js"></script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.1/Sortable.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="/backend/libs/tom-select/dist/js/tom-select.base.min.js" defer></script>
<script src="/backend/libs/fslightbox/index.js"></script>
<script>


    $(document).ready(function() {
        $('input').each(function() {
            var maxLength = $(this).attr('maxlength');
            var charCountElem = $(this).next('.charCount');
            var initialLength = $(this).val().length;
            var remaining = maxLength - initialLength;

            // Kalan karakter sayısını başlangıçta ayarla
            charCountElem.text(remaining + ' karakter kaldı');
            if (initialLength > maxLength) {
                charCountElem.addClass('over-limit');
            }

            // Input olayında kalan karakter sayısını güncelle
            $(this).on('input', function() {
                var textLength = $(this).val().length;
                var remaining = maxLength - textLength;
                charCountElem.text(maxLength+'/'+remaining + ' karakter kaldı');

                if (textLength > maxLength -1) {
                    charCountElem.addClass('over-limit');
                } else {
                    charCountElem.removeClass('over-limit');
                }
            });
        });
        
        $('input[type="checkbox"]').on('change', function(){
            this.value ^= 1;
        });
    });

</script>
 