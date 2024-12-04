@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Yeni Etkinlik Ekle</h1>
    <form action="{{ route('calendar.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Etkinlik Adı</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Başlangıç Tarihi</label>
            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Bitiş Tarihi</label>
            <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
</div>
@endsection