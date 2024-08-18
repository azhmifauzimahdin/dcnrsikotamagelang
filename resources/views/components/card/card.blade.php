@props([
    'class' => '',
    'bg' => 'white',
])

<div class="bg-{{ $bg }} border border-gray-300 shadow-sm rounded-lg p-4 {{ $class }}">
    {{ $slot }}
</div>
