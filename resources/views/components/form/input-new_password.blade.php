<div>
    <input id="new_password" type="password" name="new_password">
    @error('new_password') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
