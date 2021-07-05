@php
    $eachSide = 2;
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    $previews = $current - 1;
    $nexts = $last - $current;
@endphp
{{-- previewSide --}}
{{-- 前のページが 1以上あれば出力 --}}
@if ($previews >= 1) 
    {{-- $eachSideより大きければ 1 --}}
    @if ($previews > $eachSide)
        <a href="{{ $paginator->url(1) }}">1</a>
    @endif
    {{-- $eachSide + 1 より大きければ ... --}}
    @if ($previews > ($eachSide + 1))
        ...
    @endif
    {{-- 前にあるページ数と$eachSideの小さい方の数だけ ページ数 --}}
    @for ($i = min($previews, $eachSide); $i >= 1; $i--)
        <a href="{{ $paginator->url($current - $i) }}">{{ $current - $i }}</a>
    @endfor
@endif

{{-- current --}}
{{-- オーバーしていたら最終ページへのリンク --}}
@if ($current <= $last)
    <span>{{ $current }}</span>
@else
    <a href="{{ $paginator->url($last) }}">{{ $last }}</a>
@endif

{{-- nextSide --}}
@if ($nexts >= 1)
    {{-- @for ($i = 1; $i <= min($nexts, $eachSide); $i--) --}}
    @for ($i = 1; $i <= min($nexts, $eachSide); $i++)
        <a href="{{ $paginator->url($current + $i) }}">{{ $current + $i }}</a>
    @endfor
    @if ($nexts > ($eachSide + 1))
        ...
    @endif
    @if ($nexts > $eachSide)
        <a href="{{ $paginator->url($last) }}">{{ $last }}</a>
    @endif
@endif