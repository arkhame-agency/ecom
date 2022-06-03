<div class="thumbnail-holder pop">
    @if ($file->isImage())
        <img src="{{ $file->path }}" alt="thumbnail">
    @else
        <i class="file-icon fa {{ $file->icon() }}"></i>
    @endif
</div>
