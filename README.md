# Media Playback Speed

### Requirements
- PHP 5.3+ for closures
- jQuery (enqueued by the plugin)

This short handy plugin will add playback buttons to your audio elements added via the audio shortcode in WordPress. Each set of buttons is configured for it's corresponding audio element on the page, so you can adjust the speed of multiple files independantly. 

**CSS WILL NEED TO BE ADJUSTED.** I apply some very simple inline styles but I recommend you edit that out and create your own if you are using a beta version.

Note: with my short round of testing, it seems only one audio file can play at a time via the default WordPress audio player, so keep that in mind. Clicking play on a second audio instance will pause the first. Your playback speed will be retained per audio tag.