<div>
    <input id="tel" type="text" name="tel" maxlength="15" 
        value="{{ old('tel', ($user->tel ?? '')) }}"
        >
    <x-form.announce>※半角数字・ハイフン区切り</x-form.announce>
    @error('tel') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
