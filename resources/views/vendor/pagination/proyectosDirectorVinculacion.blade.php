<div class="d-flex justify-content-center">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}&elementosPorPaginaTerminados={{ request('elementosPorPaginaTerminados', 10) }}"
                   aria-label="Anterior">Anterior</a>
            </li>
        @endif

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}&elementosPorPaginaTerminados={{ request('elementosPorPaginaTerminados', 10) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}&elementosPorPaginaTerminados={{ request('elementosPorPaginaTerminados', 10) }}"
                   aria-label="Siguiente">Siguiente</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Siguiente</span>
            </li>
        @endif
    </ul>
</div>