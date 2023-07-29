@if ($paginator->hasPages())
  <ul>
        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><a class="active" href="#">{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li ><a class="active" href="#">{{ $page }}</a></li>
                    @else
                        <li><a  href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
  </ul>
@endif