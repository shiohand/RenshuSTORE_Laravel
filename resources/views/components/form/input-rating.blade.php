<div class="rating-input">
    評価(★1～5): <br class="sp-br">
    <label for="rat1"><input id="rat1" type="radio" name="rating" value="1" {{ old('rating') == '1' ? 'checked' : '' }}>1</label>
    <label for="rat2"><input id="rat2" type="radio" name="rating" value="2" {{ old('rating') == '2' ? 'checked' : '' }}>2</label>
    <label for="rat3"><input id="rat3" type="radio" name="rating" value="3" {{ (old('rating', 'checked') == '3' || 'checked') ? 'checked' : '' }}>3</label>
    <label for="rat4"><input id="rat4" type="radio" name="rating" value="4" {{ old('rating') == '4' ? 'checked' : '' }}>4</label>
    <label for="rat5"><input id="rat5" type="radio" name="rating" value="5" {{ old('rating') == '5' ? 'checked' : '' }}>5</label>
</div>