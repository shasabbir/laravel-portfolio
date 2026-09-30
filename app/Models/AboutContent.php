<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $table = 'about_content';

    protected $fillable = ['experiences', 'educations', 'additional_experience', 'page_text', 'methods', 'manuscripts', 'highlights'];

    public const PAGE_TEXT = [
        'page_title' => 'About | Gazi Salah Uddin Nuhash',
        'hero_label' => 'Researcher · Biotechnology & Genomics',
        'hero_title' => 'From molecular clues to meaningful discovery.',
        'hero_subtitle' => 'Exploring the molecular signatures of Alzheimer’s disease.',
        'hero_description' => 'I work across genomics, neuroscience and bioinformatics to study neurodegeneration. My experience spans omics analysis, computational drug discovery and laboratory research.',
        'research_button' => 'Explore the research',
        'location' => 'Based in Lubbock, Texas · Texas Tech University',
        'profile_label' => 'Behind the research',
        'profile_name' => 'Gazi Salah Uddin Nuhash',
        'profile_role' => 'Biotechnology & genomics researcher',
        'identity_question_label' => 'Question',
        'identity_question' => 'What drives neurodegeneration?',
        'identity_lens_label' => 'Lens',
        'identity_lens' => 'Genomics & bioinformatics',
        'identity_approach_label' => 'Approach',
        'identity_approach' => 'From data to discovery',
        'focus_label' => '01 / Focus',
        'focus_heading' => 'Inside the research',
        'focus_first_title' => 'Neurodegeneration',
        'focus_first_description' => 'Alzheimer’s disease, amyloid-β pathology, tau dysregulation and neuroinflammation.',
        'focus_second_title' => 'Omics & bioinformatics',
        'focus_second_description' => 'Gene expression, protein abundance, molecular biomarkers and reproducible data analysis.',
        'focus_third_title' => 'Drug discovery',
        'focus_third_description' => 'Virtual screening, cheminformatics and molecular dynamics for therapeutic research.',
        'experience_label' => '02 / Experience',
        'experience_heading' => 'Research & work',
        'resume_button' => 'Download résumé',
        'education_label' => '03 / Education',
        'education_heading' => 'Academic path',
        'methods_label' => '04 / Capabilities',
        'methods_heading' => 'Methods & tools',
        'manuscripts_label' => '05 / Scientific work',
        'manuscripts' => 'Manuscripts',
        'highlights_label' => '06 / Recognition',
        'highlights_heading' => 'Selected highlights',
        'resume_heading' => 'Explore the full résumé',
        'resume_description' => 'Experience, technical skills, scientific work and references in one document.',
        'resume_footer_button' => 'Download PDF',
        'portrait_alt' => 'Gazi Salah Uddin Nuhash',
        'research_alt' => 'Illustration of a brain with connected neural pathways',
    ];

    public const TEXT_GROUPS = [
        'intro' => ['label' => 'Introduction', 'fields' => ['page_title', 'hero_label', 'hero_title', 'hero_subtitle', 'hero_description', 'research_button', 'resume_button', 'location']],
        'profile' => ['label' => 'Profile text', 'fields' => ['profile_label', 'profile_name', 'profile_role', 'portrait_alt']],
        'identity' => ['label' => 'Research identity', 'fields' => ['identity_question_label', 'identity_question', 'identity_lens_label', 'identity_lens', 'identity_approach_label', 'identity_approach']],
        'focus-heading' => ['label' => 'Focus heading', 'fields' => ['focus_label', 'focus_heading']],
        'focus-first' => ['label' => 'Neurodegeneration', 'fields' => ['focus_first_title', 'focus_first_description', 'research_alt']],
        'focus-second' => ['label' => 'Omics & bioinformatics', 'fields' => ['focus_second_title', 'focus_second_description']],
        'focus-third' => ['label' => 'Drug discovery', 'fields' => ['focus_third_title', 'focus_third_description']],
        'experience-heading' => ['label' => 'Experience heading', 'fields' => ['experience_label', 'experience_heading']],
        'education-heading' => ['label' => 'Education heading', 'fields' => ['education_label', 'education_heading']],
        'methods-heading' => ['label' => 'Methods heading', 'fields' => ['methods_label', 'methods_heading']],
        'manuscripts-heading' => ['label' => 'Manuscripts heading', 'fields' => ['manuscripts_label', 'manuscripts']],
        'highlights-heading' => ['label' => 'Highlights heading', 'fields' => ['highlights_label', 'highlights_heading']],
        'resume-text' => ['label' => 'Resume text', 'fields' => ['resume_heading', 'resume_description', 'resume_footer_button']],
    ];

    public const SECTIONS = [
        'experiences' => 'Research & work', 'educations' => 'Academic path',
        'methods' => 'Methods & tools', 'manuscripts' => 'Manuscripts', 'highlights' => 'Selected highlights',
    ];

    public function pageText(string $key): string
    {
        return ($this->page_text ?? [])[$key] ?? self::PAGE_TEXT[$key] ?? '';
    }

    protected function casts(): array
    {
        return array_fill_keys([...array_keys(self::SECTIONS), 'page_text'], 'array');
    }
}
