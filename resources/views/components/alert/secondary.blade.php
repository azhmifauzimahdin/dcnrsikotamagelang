@props([
    'fontWeight' => '',
])

<div class="w-full p-2.5 bg-gray-100 border border-gray-300 rounded-lg mb-3" role="alert">
    <div class="flex items-center justify-between">
        <h3 class="font-{{ $fontWeight }}">{{ $slot }}</h3>
    </div>
</div>
