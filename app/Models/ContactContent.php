<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactContent extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['values' => 'array', 'images' => 'array'];
    }

    public const DEFAULTS = [
        'page_title' => 'Contact',
        'intro' => "Whether you have a question, a proposal, or just want to say hi — drop a message. Let me know what you're building or researching.",
        'location_title' => 'Center for Biotechnology & Genomics',
        'address' => "Texas Tech University, Canton & Main Experimental Sciences Building,\nLubbock, TX 79409",
        'email_label' => 'Email:', 'email' => 'gazi.nuhash@ttu.edu',
        'hours' => 'Mon – Fri: 09:00 – 17:00',
        'weekend_hours' => 'Weekends: Flexible for urgent requests',
        'map_query' => 'Center for Biotechnology and Genomics Texas Tech University Lubbock TX 79409',
        'map_url' => '',
        'map_caption' => 'Center for Biotechnology & Genomics, Texas Tech University',
        'map_title' => 'Location map',
        'form_heading' => 'Send a Message',
        'name_label' => 'Name', 'name_placeholder' => 'Your name',
        'email_field_label' => 'Email', 'email_placeholder' => 'your@email.com',
        'message_label' => 'Message', 'message_placeholder' => 'Write your message...',
        'submit_label' => 'Send Message',
        'consent' => 'By submitting, you agree to be contacted back regarding your inquiry.',
        'success_message' => 'Message sent!',
    ];

    public const GROUPS = [
        'contact-info' => ['label' => 'Contact details', 'fields' => ['page_title', 'intro', 'location_title', 'address', 'email_label', 'email', 'hours', 'weekend_hours'], 'images' => ['location', 'email', 'hours']],
        'contact-map' => ['label' => 'Map', 'fields' => ['map_url', 'map_query', 'map_caption', 'map_title'], 'images' => []],
        'contact-form' => ['label' => 'Contact form', 'fields' => ['form_heading', 'name_label', 'name_placeholder', 'email_field_label', 'email_placeholder', 'message_label', 'message_placeholder', 'submit_label', 'consent', 'success_message'], 'images' => []],
    ];

    public function value(string $key): string
    {
        return ($this->values ?? [])[$key] ?? self::DEFAULTS[$key] ?? '';
    }

    public function mapEmbedUrl(): string
    {
        return ($this->values ?? [])['map_embed_url'] ?? 'https://maps.google.com/maps?q='.rawurlencode($this->value('map_query')).'&z=15&output=embed';
    }
}
