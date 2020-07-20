<?php

class MatomoExtension extends Extension
{
    private static $server_url;
    private static $site_id;
    private static $tracker_path = 'matomo.php';
    private static $script_path = 'matomo.js';
    private static $show_on_dev = false;
    private static $insert_tracking_code = true;
    private static $enable_link_tracking = false;
    private static $track_all_content_impressions = false;
    private static $track_visible_content_impressions = false;
    private static $disable_cookies = false;
    private static $document_title_js = 'document.title';

    public function onAfterInit() {
        $config = Config::inst();
        if (!$config->get('MatomoExtension', 'insert_tracking_code') || (!Director::isLive() && !$config->get('MatomoExtension', 'show_on_dev'))) {
            return;
        }

        $trackingScript = $this->getTrackingCode();

        if (!$trackingScript) {
            return;
        }

        Requirements::customScript($trackingScript);
    }

    public function getTrackingCode() {
        $config = Config::inst();
        $server_url = $config->get('MatomoExtension', 'server_url');
        $site_id = $config->get('MatomoExtension', 'site_id');

        if (!$server_url || !$site_id) {
            return null;
        }

        // make sure last character is /
        $server_url = rtrim($server_url, '/') . '/';

        return ArrayData::create(array(
            'ServerUrl' => $server_url,
            'SiteId' => $site_id,
            'TrackerPath' => $config->get('MatomoExtension', 'tracker_path'),
            'ScriptPath' => $config->get('MatomoExtension', 'script_path'),
            'DocumentTitleJs' => $config->get('MatomoExtension', 'document_title_js'),
            'EnableLinkTracking' => $config->get('MatomoExtension', 'enable_link_tracking'),
            'TrackAllContentImpressions' => $config->get('MatomoExtension', 'track_all_content_impressions'),
            'TrackVisibleContentImpressions' => $config->get('MatomoExtension', 'track_visible_content_impressions'),
            'DisableCookies' => $config->get('MatomoExtension', 'disable_cookies')
        ))->renderWith(array('MatomoScript'));
    }
}
