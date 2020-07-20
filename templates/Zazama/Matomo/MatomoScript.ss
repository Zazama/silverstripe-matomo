var _paq = window._paq || [];
_paq.push(['setDocumentTitle', $DocumentTitleJs]);
_paq.push(['trackPageView']);
<% if $EnableLinkTracking %>
    _paq.push(['enableLinkTracking']);
<% end_if %>
<% if $TrackAllContentImpressions %>
    _paq.push(['trackAllContentImpressions']);
<% end_if %>
<% if $TrackVisibleContentImpressions %>
    _paq.push(['trackVisibleContentImpressions']);
<% end_if %>
(function() {
    var u="$ServerUrl";
    _paq.push(['setTrackerUrl', u+'$TrackerPath']);
    _paq.push(['setSiteId', '$SiteId']);
    <% if $DisableCookies %>
        _paq.push(['disableCookies']);
    <% end_if %>
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'$ScriptPath'; s.parentNode.insertBefore(g,s);
})();
