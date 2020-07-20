# Silverstripe Matomo Module

## Requirements
* Silverstripe 3

For Silverstripe 4, switch to branch >= 2.0

## Installation

`composer require Zazama/matomo ^1.0`

## Usage

This module provides multiple options that you can use in your _config.yml

### Basic config
```yaml
MatomoExtension:
  # Root URL of your Matomo instance
  server_url: 'https://example.com/'
  # Site ID of the page you want to track
  site_id: 1337
```

### All settings

```yaml
MatomoExtension:
  # Root URL of your Matomo instance
  server_url: 'https://example.com/'
  # Site ID of the page you want to track
  site_id: 1337
  # Path of the tracker php file, default: matomo.php
  tracker_path: 'matomo.php'
  # Path of the tracker php file, default: matomo.js
  script_path: 'matomo.js'
  # Inserted on dev mode, default: false
  show_on_dev: false
  # Automatically insert script, default: true
  insert_tracking_code: true
  # Enable link tracking (e.g. PWA), default: false
  enable_link_tracking: false
  # Track all content impressions, default: false
  track_all_content_impressions: false
  # Track visible content impressions, default: false
  track_visible_content_impressions: false
  # Disable cookies (GDPR compliance), default: false
  disable_cookies: false
  # Set document title by javascript, default: document.title
  document_title_js: 'document.title'
```
