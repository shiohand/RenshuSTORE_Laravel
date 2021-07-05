<div>
    <input id="password" class="disabled-toggle" type="password" name="password">
    @error('password') <x-form.danger>{{ $message }}</x-form.danger> @enderror
</div>
