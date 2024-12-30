@extends('backend.layout.app')
@section('content')
    <div class="card">
        <div class="card-status-top bg-blue"></div>

        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.redirect/> Yönlendirme Yönetimi</h3>
            <div class="card-actions d-flex">
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-icon">
                        <x-dashboard.icon.back/>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('redirects.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="from_url" class="form-control" placeholder="Eski URL" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_url" class="form-control" placeholder="Yeni URL" required>
                    </div>
                    <div class="col-md-2">
                        <select name="status_code" class="form-control" required>
                            <option value="301">301 - Kalıcı</option>
                            <option value="302">302 - Geçici</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><x-dashboard.icon.add/> Ekle</button>
                    </div>
                </div>
            </form>

            <hr>
            
            <table class="table table-vcenter card-table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Eski URL</th>
                        <th>Yeni URL</th>
                        <th>Durum Kodu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($redirects as $redirect)
                        <tr>
                            <td>{{ $redirect->id }}</td>
                            <td>{{ $redirect->from_url }}</td>
                            <td>{{ $redirect->to_url }}</td>
                            <td>{{ $redirect->status_code }}</td>
                            <td>
                                <form action="{{ route('redirects.destroy', $redirect) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-icon"><x-dashboard.icon.delete/></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {{ $redirects->links() }}
</div>
@endsection 