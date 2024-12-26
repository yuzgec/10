@php
    $periods = [
        'day' => 'Gün',
        'week' => 'Hafta',
        'month' => 'Ay',
        'year' => 'Yıl',
        'all' => 'Hepsi'
    ];
@endphp

@foreach($periods as $period => $label)
    <a href="{{ request()->fullUrlWithQuery(['period' => $period]) }}" 
       class="btn {{ $currentPeriod === $period ? 'btn-primary' : '' }}">
        {{ $label }}
    </a>
@endforeach