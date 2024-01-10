@props(['size' => 6, 'color' => 'none'])

<svg xmlns="http://www.w3.org/2000/svg" fill={{ $color }} viewBox="0 0 24 24" stroke-width="1.5"
    stroke="currentColor" class='w-{{ $size }} h-{{ $size }}'>
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
