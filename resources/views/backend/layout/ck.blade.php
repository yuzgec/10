@foreach($language as $lang)
<script type="text/javascript">
    CKEDITOR.replace( 'desc:{{ $lang->lang }}', {
     
        filebrowserBrowseUrl: '/filemanager?type=Files',
        filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{ csrf_token() }}',
        filebrowserImageBrowseUrl: '/filemanager?type=Images',
        filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserUploadMethod: 'form',
        allowedContent: true,
        height : 350,
    });
    
    CKEDITOR.replace('short:{{ $lang->lang }}', {!! json_encode(config('ckeditor.short')) !!});
  
</script>
@endforeach