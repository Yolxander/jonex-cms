@php
    // Extract Video ID from Vimeo URL
    preg_match('/\/(\d+)$/', $videoUrl, $matches);
    $videoId = $matches[1] ?? null;
    $thumbnailUrl = $videoId ? "https://vumbnail.com/{$videoId}.jpg" : null;
@endphp

<div class="relative w-48 h-28">
    @if($thumbnailUrl)
        <img src="{{ $thumbnailUrl }}" alt="Video Thumbnail" class="w-full h-full rounded-md">
        <a href="{{ $videoUrl }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black/50 text-white text-lg font-bold opacity-80 hover:opacity-100 transition">
            ▶
        </a>
    @else
        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-600">No Preview</div>
    @endif
</div>
