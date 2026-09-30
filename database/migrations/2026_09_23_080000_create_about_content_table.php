<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_content', function (Blueprint $table) {
            $table->id();
            $table->json('experiences');
            $table->json('educations');
            $table->text('additional_experience')->nullable();
            $table->timestamps();
        });
        $defaults = json_decode(<<<'JSON'
{
  "experiences": [
    {
      "period": "Sep 2026 – Present",
      "title": "Graduate Research Assistant",
      "organization": "Center for Biotechnology and Genomics · Texas Tech University",
      "description": "Investigating molecular fingerprints of Alzheimer’s disease through genomic and biological datasets. Preparing quality-controlled analyses, pathway visualizations and figures for research presentations and manuscripts."
    },
    {
      "period": "Jul 2024 – Feb 2026",
      "title": "Research Assistant & Assistant Lab Manager",
      "organization": "ABCD Laboratory · Bangladesh",
      "description": "Led computational drug discovery projects focused on neurodegenerative pathways. Studied tau kinase targets using virtual screening and molecular dynamics with GROMACS and VMD, while mentoring junior researchers and supporting laboratory operations."
    },
    {
      "period": "Aug 2023 – Jun 2024",
      "title": "Junior Research Collaborator",
      "organization": "ABCD Laboratory · Bangladesh",
      "description": "Explored natural products, therapeutic protein targets and computer-aided drug design methods."
    },
    {
      "period": "Feb 2020 – Jun 2022",
      "title": "Research Intern",
      "organization": "NSU Genome Research Institute · North South University",
      "description": "Worked on bacterial culture, antibiotic resistance and next-generation sequencing projects, including an analysis of SARS-CoV-2 genomes from Nepal."
    }
  ],
  "educations": [
    {
      "period": "2025 – Present",
      "title": "M.S. in Biotechnology",
      "organization": "Texas Tech University · Lubbock, Texas",
      "description": "Life sciences research concentration · Current GPA 4.00 / 4.00",
      "badge": "TTU",
      "color": "#a6192e"
    },
    {
      "period": "2018 – 2022",
      "title": "B.S. in Biochemistry & Biotechnology",
      "organization": "North South University · Dhaka, Bangladesh",
      "description": "Graduated cum laude, top 5% of class · CGPA 3.51 / 4.00",
      "badge": "NSU",
      "color": "#123f7a"
    }
  ],
  "additional_experience": "Additional experience: Project Manager at Wholesome Alive (2022–2023), Laboratory Assistant at North South University (2019–2020), and Student Assistant at Texas Tech University (2026)."
}
JSON, true, 512, JSON_THROW_ON_ERROR);
        DB::table('about_content')->insert([
            'id' => 1,
            'experiences' => json_encode($defaults['experiences'], JSON_THROW_ON_ERROR),
            'educations' => json_encode($defaults['educations'], JSON_THROW_ON_ERROR),
            'additional_experience' => $defaults['additional_experience'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('about_content');
    }
};
