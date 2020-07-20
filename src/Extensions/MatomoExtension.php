<?php

namespace Zazama\Matomo\Extensions;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Extension;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

class MatomoExtension extends Extension
{
    use Configurable;

    /**
     * @config
     */
    private static $server_url;
    /**
     * @config
     */
    private static $site_id;
    /**
     * @config
     */
    private static $tracker_path = 'matomo.php';
    /**
     * @config
     */
    private static $script_path = 'matomo.js';
    /**
     * @config
     */
    private static $show_on_dev = false;
    /**
     * @config
     */
    private static $insert_tracking_code = true;
    /**
     * @config
     */
    private static $enable_link_tracking = false;
    /**
     * @config
     */
    private static $track_all_content_impressions = false;
    /**
     * @config
     */
    private static $track_visible_content_impressions = false;
    /**
     * @config
     */
    private static $disable_cookies = false;
    /**
     * @config
     */
    private static $document_title_js = 'document.title';

    public function onAfterInit() {
        if (!$this->config()->get('insert_tracking_code') || (!Director::isLive() && !$this->config()->get('show_on_dev'))) {
            return;
        }

        $trackingScript = $this->getTrackingCode();

        if (!$trackingScript) {
            return;
        }

        Requirements::customScript($trackingScript);
    }

    public function getTrackingCode() {
        $server_url = $this->config()->get('server_url');
        $site_id = $this->config()->get('site_id');

        if (!$server_url || !$site_id) {
            return null;
        }

        // make sure last character is /
        $server_url = rtrim($server_url, '/') . '/';

        return ArrayData::create([
            'ServerUrl' => $server_url,
            'SiteId' => $site_id,
            'TrackerPath' => $this->config()->get('tracker_path'),
            'ScriptPath' => $this->config()->get('script_path'),
            'DocumentTitleJs' => $this->config()->get('document_title_js'),
            'EnableLinkTracking' => $this->config()->get('enable_link_tracking'),
            'TrackAllContentImpressions' => $this->config()->get('track_all_content_impressions'),
            'TrackVisibleContentImpressions' => $this->config()->get('track_visible_content_impressions'),
            'DisableCookies' => $this->config()->get('disable_cookies')
        ])->renderWith(['Zazama\\Matomo\\MatomoScript']);
    }
}
