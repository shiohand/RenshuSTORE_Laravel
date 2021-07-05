<p class="sort-link">
    @php
        $sorts = [
            'date-desc' => '発売日の近い順',
            'price-asc' => '価格の安い順',
            'price-desc' => '価格の高い順',
            'rating' => '評価の高い順',
        ];
    @endphp
    @foreach ($sorts as $sort => $text)
        @if ($sort === $current)
            {{ $text }}
            @continue
        @endif
        <a href="{{ route('products', ['sort' => $sort]) }}">{{ $text }}</a>
    @endforeach
</p>
