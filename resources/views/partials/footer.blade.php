<footer class="border-t">
@if(request()->routeIs('home'))
    @include('home.inline-editor', ['section' => 'footer'])
@endif
  <div class="home-edit-content">
  <div class="container mx-auto flex flex-col items-center justify-between gap-4 py-6 md:flex-row">
    <p class="text-sm text-muted-foreground">© {{ date('Y') }} <span data-home-text="footer_copyright">{!! $siteContent->formatted('footer_copyright') !!}</span></p>
    <nav class="flex gap-4">
      <a href="{{ $siteContent->value('privacy_url') }}" class="text-sm text-muted-foreground transition-colors hover:text-primary"><span data-home-text="footer_1">{!! $siteContent->formatted('footer_1') !!}</span></a>
      <a href="{{ $siteContent->value('terms_url') }}" class="text-sm text-muted-foreground transition-colors hover:text-primary"><span data-home-text="footer_2">{!! $siteContent->formatted('footer_2') !!}</span></a>
    </nav>
  </div>
  </div>
</footer>
