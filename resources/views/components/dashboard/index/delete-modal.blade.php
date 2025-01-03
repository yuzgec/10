@props(['route', 'model'])
<div class="modal modal-blur fade" id="silmeonayi{{ $model->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silme Onayı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Silmek üzeresiniz. Bu işlem geri alınmamaktadır.
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    <x-dashboard.icon.back/>
                    İptal Et
                </a>
                <form action="{{ route($route.'.destroy', $model->id) }}" method="POST" data-action="deleting">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm ms-auto">
                       <x-dashboard.icon.delete/>
                        Silmek İstiyorum
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>