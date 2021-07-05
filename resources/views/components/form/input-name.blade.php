<div>
    <input id="name" type="text" name="name" maxlength="15" 
        value="{{ old('name', ($user->name ?? '')) }}"
        >
    <x-form.announce>※最大15文字</x-form.announce>
    @error('name') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
