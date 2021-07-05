<div>
    <input id="postal1" type="text" name="postal1" maxlength="3" 
        value="{{ old('postal1', ($user->postal1 ?? '')) }}"
        >
    -
    <input id="postal2" type="text" name="postal2" maxlength="4" 
        value="{{ old('postal2', ($user->postal2 ?? '')) }}"
        >
    @error('postal1')
        <x-form.danger>{{ $message }}</x-form.danger>
    @else
        @error('postal2') <x-form.danger>{{ $message }}</x-form.danger> @enderror
    @enderror
</div>
