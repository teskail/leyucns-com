<?php

/**
 * Render a link card for a given URL with title, description, and formatted display.
 * This implementation uses static sample data for demonstration.
 */
class LinkCardRenderer
{
    /**
     * @var string The URL to display in the card.
     */
    private string $url;

    /**
     * @var string The title text for the card.
     */
    private string $title;

    /**
     * @var string A short description for the card.
     */
    private string $description;

    /**
     * @var array<string, string> Optional metadata key-value pairs (e.g., 'keywords').
     */
    private array $metadata;

    /**
     * Constructor.
     *
     * @param string $url
     * @param string $title
     * @param string $description
     * @param array<string, string> $metadata
     */
    public function __construct(
        string $url,
        string $title,
        string $description,
        array $metadata = []
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->metadata = $metadata;
    }

    /**
     * Escape HTML special characters in a string.
     *
     * @param string $value
     * @return string
     */
    private function escapeHtml(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Build the HTML structure for the link card.
     *
     * @return string Escaped HTML string.
     */
    public function render(): string
    {
        $escapedUrl = $this->escapeHtml($this->url);
        $escapedTitle = $this->escapeHtml($this->title);
        $escapedDescription = $this->escapeHtml($this->description);

        $metadataHtml = '';
        foreach ($this->metadata as $key => $value) {
            $escapedKey = $this->escapeHtml($key);
            $escapedValue = $this->escapeHtml($value);
            $metadataHtml .= '<span class="meta-item">';
            $metadataHtml .= '<strong>' . $escapedKey . ':</strong> ' . $escapedValue;
            $metadataHtml .= '</span>';
        }

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<h3 class="card-title">' . $escapedTitle . '</h3>';
        $html .= '</a>';
        $html .= '<p class="card-description">' . $escapedDescription . '</p>';
        if ($metadataHtml !== '') {
            $html .= '<div class="card-metadata">' . $metadataHtml . '</div>';
        }
        $html .= '</div>';

        return $html;
    }

    /**
     * Create a pre-configured instance with sample data.
     *
     * @return self
     */
    public static function createSample(): self
    {
        $url = 'https://leyucns.com';
        $title = 'Leyu Entertainment Platform';
        $description = 'Discover exciting games and interactive experiences at leyu.';
        $metadata = [
            'keywords' => 'leyu, entertainment, gaming',
            'category' => 'Online Platform',
        ];

        return new self($url, $title, $description, $metadata);
    }
}

// --- Example usage (uncomment to test) ---
/*
$renderer = LinkCardRenderer::createSample();
echo $renderer->render();
*/