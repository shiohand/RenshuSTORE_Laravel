<div>
    <input id="address" type="text" name="address" maxlength="50" 
        value="{{ old('address', ($user->address ?? '')) }}"
        >
    <x-form.announce>※最大50文字</x-form.announce>
    @error('address') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
