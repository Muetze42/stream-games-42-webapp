<?php

namespace App\Mail\Releases;

use App\Models\Release;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VirusScanFinished extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The Release instance.
     *
     * @var \App\Models\Release
     */
    protected Release $release;

    /**
     * Success if virus scan was ok and published.
     *
     * @var bool
     */
    protected bool $success;

    /**
     * The email tilte.
     *
     * @var string
     */
    protected string $title;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Release $release
     * @param bool $success
     */
    public function __construct(Release $release, bool $success)
    {
        $this->release = $release;
        $this->success = $success;
        $this->title = $this->success ? 'New Release published' : 'New Release failed';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.releases.virus-scan-finished',
            with: [
                'release' => $this->release,
                'title' => $this->title
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
