<div class="mb-3">
    <label class="block mb-2 font-medium" for="{{ $name }}">{{ $slot }}</label>
    <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-1"
        id="{{ $id }}" name="{{ $name }}" type="{{ $type }}">
    @error($name)
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
