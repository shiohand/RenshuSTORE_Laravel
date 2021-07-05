<div>
    <input id="password_confirmation" class="disabled-toggle" type="password" name="password_confirmation">
    @error('password_confirmation') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
