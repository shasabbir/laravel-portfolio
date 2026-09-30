@include('about.inline-media', ['field' => $imageKey, 'label' => 'Edit '.$imageLabel.' image'])
@if($aboutMedia?->imagePath($imageKey))
  <img src="{{ route('about.media', $imageKey) }}" alt="{{ $imageLabel }}" class="mb-4 h-16 w-16 rounded-xl object-contain" loading="lazy">
@else
  <span class="showcase-icon mb-4"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-{{ $icon }}"/></svg></span>
@endif
