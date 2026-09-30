<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_content', function (Blueprint $table) {
            $table->json('methods')->nullable();
            $table->json('manuscripts')->nullable();
            $table->json('highlights')->nullable();
        });
        $defaults = json_decode(<<<'JSON'
{
  "methods": [
    {
      "icon": "flask",
      "title": "Laboratory",
      "description": "NGS, PCR, RT-qPCR, ELISA, Western blot, DNA/RNA extraction, mammalian and bacterial cell culture, CRISPR-Cas9 systems, immunofluorescence, mouse handling and aseptic surgery."
    },
    {
      "icon": "code",
      "title": "Computational",
      "description": "Python, R, C/C++, GROMACS, NAMD, VMD, AutoDock Vina, PyMOL, Gaussian, genome annotation and data mining."
    }
  ],
  "manuscripts": [
    {
      "status": "In preparation",
      "title": "Molecular Fingerprints in Natural Products to Address Alzheimer’s Disease – A Computational Approach",
      "authors": "Nuhash GSU, Crasto CJ"
    },
    {
      "status": "Submitted",
      "title": "Lamellarins – An Updated Review of Sources, Synthesis, Pharmacology, Pharmacokinetics and Toxicity",
      "authors": "Nuhash GSU, Junaid M"
    },
    {
      "status": "In review",
      "title": "Revivify studies on inflammatory stress and immune cell activation",
      "authors": "Co-author on two manuscripts"
    }
  ],
  "highlights": [
    {
      "title": "Honors",
      "description": "Graduate School Competitive Tuition Scholarship · Texas Tech University, 2025–2026\nFull tuition scholarship · North South University, 2018\nKL-YES Exchange Scholar · U.S. Department of State, 2013–2014"
    },
    {
      "title": "Conferences & training",
      "description": "Alzheimer’s Association International Conference · 2024 & 2025\nNext-Generation Pathogen Sequencing · CHRF, 2025\nAseptic Surgery and Working with Mice in Research · CITI Program, 2026"
    }
  ]
}
JSON, true, 512, JSON_THROW_ON_ERROR);
        DB::table('about_content')->where('id', 1)->update(array_map(
            fn ($entries) => json_encode($entries, JSON_THROW_ON_ERROR), $defaults
        ));
    }

    public function down(): void
    {
        Schema::table('about_content', function (Blueprint $table) {
            $table->dropColumn(['methods', 'manuscripts', 'highlights']);
        });
    }
};
