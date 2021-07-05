<div>{{-- 年代のselectを出力 1910から10刻み --}}
    <div class="select-wrap">
        <select class="disabled-toggle" name="birth">
            @php
                $selected = old('birth', ($user->birth ?? '1980'));
                $now = round(intval(date('Y')), -1);
            @endphp
            @for ($i = 1920; $i <= $now; $i += 10)
                <option value="{{ $i }}"
                    @if ($i == $selected) selected @endif >
                    {{ $i }}年代
                </option>
            @endfor
        </select>
    </div>
</div>
