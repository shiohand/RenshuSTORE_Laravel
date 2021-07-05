<div>
    <div class="radio-wrap clearfix">
        <label class="radio-label"><input class="disabled-toggle" type="radio" name="gender" value="1" 
            {{ (old('gender', ($user->gender ?? 'checked')) == ('1' || 'checked')) ? 'checked' : '' }}
            >
            男性
        </label>
        <label class="radio-label"><input class="disabled-toggle" type="radio" name="gender" value="2" 
            {{ (old('gender', ($user->gender ?? '')) == '2') ? 'checked' : '' }}
            >
            女性
        </label>
    </div>
</div>
