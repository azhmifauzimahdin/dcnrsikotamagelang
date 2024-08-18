@props([
    'class' => '',
])

<div class="w-full p-2.5 text-[#8a6d3b] bg-[#fcf8e3] border border-[#faebcc] rounded-lg mb-3 {{ $class }}"
    role="alert">
    {{ $slot }}
</div>
