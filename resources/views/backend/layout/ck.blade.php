@foreach($language as $lang)
<script type="text/javascript">
    CKEDITOR.replace( 'desc:{{ $lang->lang }}', {
     
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserUploadMethod: 'form',
        allowedContent: true,
        height : 400,
    });
</script>
@endforeach