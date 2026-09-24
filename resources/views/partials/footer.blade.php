<footer class="border-t">
@if(request()->routeIs('home'))
    @include('home.inline-editor', ['section' => 'footer'])
@endif
  <div class="container mx-auto flex flex-col items-center justify-between gap-4 py-6 md:flex-row">
    <p class="text-sm text-muted-foreground">© {{ date('Y') }} {!! $siteContent->formatted('footer_copyright') !!}</p>
    <nav class="flex gap-4">
      <a href="{{ $siteContent->value('privacy_url') }}" class="text-sm text-muted-foreground transition-colors hover:text-primary">{!! $siteContent->formatted('footer_1') !!}</a>
      <a href="{{ $siteContent->value('terms_url') }}" class="text-sm text-muted-foreground transition-colors hover:text-primary">{!! $siteContent->formatted('footer_2') !!}</a>
    </nav>
  </div>
</footer>
