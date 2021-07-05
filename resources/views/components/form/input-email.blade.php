<div>
    <input id="email" type="email" name="email" maxlength="50" 
        value="{{ old('email', ($user->email ?? '')) }}"
        >
    <x-form.announce>※最大50文字</x-form.announce>
    @error('email') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
