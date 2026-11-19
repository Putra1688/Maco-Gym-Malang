@props([
    'paginator',
    'id' => 'pagination-per-page',
    'itemLabel' => 'data',
])

@if(isset($paginator) && $paginator->total() > 0)
    {{ $paginator->links('vendor.pagination.jump', ['id' => $id, 'itemLabel' => $itemLabel]) }}
@endif
