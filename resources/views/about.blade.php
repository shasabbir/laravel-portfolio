@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="container mx-auto max-w-5xl px-4 py-12 md:px-6 md:py-20">
  <header class="text-center">
    <h1 class="font-headline text-4xl font-bold tracking-tight md:text-5xl">About GAZI SALAH UDDIN NUHASH</h1>
    <p class="mt-4 text-lg text-muted-foreground">A journey through life sciences, discovery, and innovation.</p>
  </header>

  <div class="mt-12 grid grid-cols-1 gap-12 md:grid-cols-3">
    <div>
      <img src="https://i.postimg.cc/50FkXX3x/nuhash.jpg" alt="GAZI SALAH UDDIN NUHASH" class="rounded-lg object-cover shadow-lg w-full" />
      <a href="/cv.pdf" download class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded bg-primary px-5 py-3 text-primary-foreground">
        {!! file_get_contents(resource_path('svg/download.svg')) !!}
        <span>Download CV</span>
      </a>
    </div>
    <div class="md:col-span-2">
      <div class="rounded-lg border bg-card/50">
        <div class="p-6">
          <h2 class="font-headline text-2xl text-primary">Biography</h2>
        </div>
        <div class="p-6 pt-0 space-y-4 text-base leading-relaxed text-muted-foreground">
          <p>Driven, ambitious and self-motivated researcher with a strong background in Alzheimer's Disease, drug design and discovery, cell culture, next-generation sequencing (NGS) and data analysis.</p>
          <p>Academically distinguished life sciences graduate with exceptional leadership abilities, adept at public speaking, teamwork, and effective communication.</p>
          <p>Looking to pursue further opportunities and make a difference within my field and harness my potential.</p>
        </div>
      </div>

      <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-3">
        <div class="rounded-lg border">
          <div class="flex items-center justify-between p-4 pb-2">
            <h3 class="text-sm font-medium">Research Skills</h3>
            {!! file_get_contents(resource_path('svg/flask.svg')) !!}
          </div>
          <div class="p-4 pt-0">
            <ul class="list-disc list-inside text-sm text-muted-foreground">
              <li>Alzheimer's Disease</li>
              <li>Drug Design</li>
              <li>Cell Culture</li>
              <li>NGS</li>
            </ul>
          </div>
        </div>
        <div class="rounded-lg border">
          <div class="flex items-center justify-between p-4 pb-2">
            <h3 class="text-sm font-medium">Core Competencies</h3>
            {!! file_get_contents(resource_path('svg/users.svg')) !!}
          </div>
          <div class="p-4 pt-0">
            <ul class="list-disc list-inside text-sm text-muted-foreground">
              <li>Leadership</li>
              <li>Teamwork</li>
              <li>Communication</li>
            </ul>
          </div>
        </div>
        <div class="rounded-lg border">
          <div class="flex items-center justify-between p-4 pb-2">
            <h3 class="text-sm font-medium">Public Speaking</h3>
            {!! file_get_contents(resource_path('svg/presentation.svg')) !!}
          </div>
          <div class="p-4 pt-0">
            <div class="text-sm font-medium">Adept Presenter</div>
            <p class="text-xs text-muted-foreground">Engaging and effective communicator.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2">
    <div class="rounded-lg border bg-accent/20">
      <div class="p-6">
        <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
          {!! file_get_contents(resource_path('svg/lightbulb.svg')) !!}
          <span>Research Philosophy</span>
        </h3>
      </div>
      <div class="p-6 pt-0 space-y-4 text-base text-muted-foreground">
        <p>"I am driven by a curiosity to unravel the complexities of neurodegenerative diseases and a passion for developing innovative therapeutic strategies. I believe in a collaborative, multi-disciplinary approach to solve the most pressing challenges in medical science."</p>
        <p>"My goal is to contribute to a research environment that fosters intellectual freedom, rigorous scientific inquiry, and a shared commitment to making a tangible impact on patient lives."</p>
      </div>
    </div>
    <div class="rounded-lg border bg-accent/20">
      <div class="p-6">
        <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
          {!! file_get_contents(resource_path('svg/graduation-cap.svg')) !!}
          <span>Academic Background</span>
        </h3>
      </div>
      <div class="p-6 pt-0 space-y-4 text-base text-muted-foreground">
        <p>As a distinguished graduate in the life sciences, I have built a strong academic foundation that equips me to tackle complex biological questions. My training has provided me with hands-on experience in cutting-edge laboratory techniques and data analysis methods.</p>
        <p>I am committed to lifelong learning and mentorship, aiming to inspire and collaborate with the next generation of scientists to collectively advance our understanding of human health and disease.</p>
      </div>
    </div>
  </div>

  <div class="mt-16 rounded-lg border bg-card/50">
   <div class="p-6">
  <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
    <img
      src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGvY5s6TtmCRniS3Fi793twnKkFC-DtxFQyFcoTn52m2y6DuC1_sG45n4BZENyb9JjALI&usqp=CAU"
      alt="Career Icon"
      class="h-8 w-8 object-contain"
    />
    <div class="flex flex-col gap-2">
      <span>Career Aspirations</span>
      <p class="text-sm text-muted-foreground">
    A timeline of key milestones and achievements.
  </p>
    </div>
  </h3>

  
</div>

    <div class="p-6 pt-0">
      <div class="relative border-l-2 border-primary pl-6 ml-5">
        <div class="mb-8 ml-4">
          <div class="absolute -left-[11px] mt-1.5 h-5 w-5 rounded-full border-4 border-[#D4AF37] ring-4 ring-[#D4AF37]/30 bg-white"></div>

          <p class="text-sm font-semibold text-primary">Present</p>
          <h4 class="text-lg font-semibold">Seeking New Opportunities</h4>
          <p class="text-muted-foreground">Looking to apply my skills in a challenging research role to make a significant impact in the field of life sciences.</p>
        </div>
        <div class="mb-8 ml-4">
          <div class="absolute -left-[11px] mt-1.5 h-5 w-5 rounded-full border-4 border-amber-400 ring-4 ring-amber-400/30 bg-white"></div>

          <p class="text-sm font-semibold text-primary">Graduate Studies</p>
          <h4 class="text-lg font-semibold">Distinguished Life Sciences Graduate</h4>
          <p class="text-muted-foreground">Completed rigorous academic and practical training, graduating with distinction.</p>
        </div>
        <div class="ml-4">
          <div class="absolute -left-[11px] mt-1.5 h-5 w-5 rounded-full border-4 border-amber-400 ring-4 ring-amber-400/30 bg-white"></div>

          <p class="text-sm font-semibold text-primary">Foundation</p>
          <h4 class="text-lg font-semibold">Developed Strong Research Background</h4>
          <p class="text-muted-foreground">Built a solid foundation in Alzheimer's Disease, drug design, cell culture, and NGS.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
