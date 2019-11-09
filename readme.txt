=== Media Playback Speed ===
Contributors: LewisCowles,daronspence
Tags: frontend,media,streaming,aria,mediaelementjs,html5,video,audio,playback,speed,cd2,lewiscowles,codesign2,shortcode,playlist
Requires at least: 4.0
Tested up to: 5.2.4
Requires PHP: 5.6
Stable tag: 1.1.4
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Add speed controls to audio and video hosted from your WordPress blog.

== Description ==
This short, handy plugin will add playback buttons to your audio, video & playlist elements added via the built-in WordPress shortcodes for media using mediaelement.js.

Each set of buttons is configured for it's corresponding element on the page, so you can adjust the speed of multiple files independently.

There is currently no persistence implemented in this plugin. It just scratches an itch to be able to broadly adjust media playback speeds using the HTML api.

NOTE: This uses the HTML5 media Element API. Any browser not supporting these or using the Flash Player fallback will miss out on this functionality.

#### Developers

Two hooks are provided within this plugin.  

* `media-playback-speed-generate-controls` provides a single argument which is a boolean. If you return this as false, this will stop buttons being added to a media player. This is intended for advanced setups where markup for controls might be placed manually elsewhere on the page such as a sticky footer. So long as controls follow the built-in markup (being within the body tag and have a playback-rate-button class (no default styling, used for enabling DOM access only).

* 'media-playback-speed-data' provides the default array containing arrays as items with `rate`, `title` and `label` entries, which set the playback rate, the title and aria-title for the buttons as well as adjust the button text.

#### Theme & Front-end

The `.playback-rate-button.mejs-active` and/or `.playback-rate-button.active-playback-rate` CSS-selectors allow you to style the active speed (per-player).

Initially mejs-active class was added in order to create media-playback-js compatible / familiar class names.

Now that Gutenberg does not add these, it makes sense to for-now add two sets of classes.

The `.playback-rate-button.mejs-active` selector will be deprecated in version 2.

#### Troubleshooting

This works with the traditional `audio`, `video` and `playlist` shortcodes so long as WordPress uses the JavaScript player.

With the latest 1.1.1 release this also works for HTML5 audio and video too, however you will need to implement your own controls which have the `playback-rate-button` class and follow the patterns of this.

HTML5 raw controls do not have a playlist the author is aware of, and they use global state, so playback rate is per-page.

There is currently no history as part of this plugin, however a sister plugin could be authored and hooks added to it to store playback rate.

Please ensure that you have no broken javascript, or wrap all functions in `(function() { // do things })()` blocks to ensure nothing interferes with this plugin. This plugin does this so that it should not interfere with your site, even in browsers and pages which do not support this plugin.

#### Feedback

Please feel free to [suggest](https://github.com/CODESIGN2/media-playback-speed/issues) improvements, report conflicts, and/or make suggestions for integration hooks etc.

== Installation ==
Download and extract the zip file or clone this repo to your WordPress plugins directory. Alternatively use the plugin directory to find and install this plugin.

== Changelog ==
= 1.1.4 =
* Non-mediaelement JS fixes

= 1.1.3 =
* IE 11 fixes.

= 1.1.2 =
* Re-factor inline JS that does not require PHP to it's own JS file

= 1.1.1 =
* minor rewrite adding comments and building on the Vanilla JS 1.0.7 works

= 1.0.7 =
* guard to prevent errors

= 1.0.6 =
* change of DOM event

= 1.0.5 =
* using DOM events in the absence of jQuery

= 1.0.4 =
* No more jQuery

= 1.0.3 =
* Addition of playlist support (still requires old WP shortcode embedding)

= 1.0.2 =
* Verified working with 5.2.2 (requires old-style shortcode media embedding)

= 1.0.1 =
* Modified to enable showing active speed (requires JS to function)

= 1.0.0 =
* Initial submission to plugin-directory after button integration works, and re-factoring by Lewis Cowles
