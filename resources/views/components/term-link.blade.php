<p class="sort-link">
    @php
        $terms = [
            'all' => '累計',
            'day' => '24時間',
            'week' => '週間',
            'month' => '月間',
            'year' => '年間',
        ];
    @endphp
    @foreach ($terms as $term => $text)
        @if ($term === $currentTerm)
            {{ $text }}
            @continue
        @endif
        <a href="{{ route($currentRoute, ['term' => $term]) }}">{{ $text }}</a>
    @endforeach
</p>
