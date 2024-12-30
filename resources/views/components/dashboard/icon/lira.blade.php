@props(['width' =>24, 'height' => 24, 'color' => 'currentColor'])
<svg
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    viewBox="0 0 24 24"
    fill="none"
    style="width: {{ $width}}px;height: {{ $height}}px;"
    stroke="{{ $color}}"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    class="icon icon-tabler icons-tabler-outline icon-tabler-currency-lira">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
    <path d="M10 5v15a7 7 0 0 0 7 -7"/>
    <path d="M6 15l8 -4"/>
    <path d="M14 7l-8 4"/>
</svg>