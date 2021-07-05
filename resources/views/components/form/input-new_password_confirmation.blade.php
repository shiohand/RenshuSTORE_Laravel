<div>
    <input id="new_password_confirmation" type="password" name="new_password_confirmation">
    @error('new_password_confirmation') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
