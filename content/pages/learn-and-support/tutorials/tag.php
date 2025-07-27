<?php
enum TutorialTag: string {
    case GettingStarted = 'getting-started';
    case Workflows = 'workflows';
    case Users = 'users';
    case Reports = 'reports';
    case Integrations = 'integrations';
    case Automation = 'automation';

    // Optional: For displaying human-readable labels
    public function label(): string {
        return match($this) {
            self::GettingStarted => 'Getting Started',
            self::Workflows => 'Workflows',
            self::Users => 'Users',
            self::Reports => 'Reports',
            self::Integrations => 'Integrations',
            self::Automation => 'Automation',
        };
    }
}
