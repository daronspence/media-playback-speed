=== Media Playback Speed ===
Contributors: LewisCowles,daronspence
Tags: frontend,media,streaming,aria,mediaelementjs,html5,video,audio,playback,speed,cd2,lewiscowles
Requires at least: 4.0
Tested up to: 5.2.2
Requires PHP: 5.6
Stable tag: 1.0.3
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Add speed controls to audio and video hosted from your WordPress blog.

== Description ==
This short handy plugin will add playback buttons to your audio and video elements added via the built-in wordpress shortcodes for media using mediaelement.js. Each set of buttons is configured for it's corresponding element on the page, so you can adjust the speed of multiple files independantly.

There is currently no persistence implemented in this plugin. It just scratches an itch to be able to broadly adjust media playback speeds using the HTML api.

NOTE: This uses the HTML5 media Element API. Any browser not supporting these or using the Flash Player fallback will miss out on this functionality.

#### Developers

Two hooks are provided within this plugin.  

* `media-playback-speed-generate-controls` provides a single argument which is a boolean. If you return this as false, this will stop buttons being added to a media player. This is intended for advanced setups where markup for controls might be placed manually elsewhere on the page such as a sticky footer. So long as controls follow the built-in markup (being within the body tag and have a playback-rate-button class (no default styling, used for enabling DOM access only).

* 'media-playback-speed-data' provides the default array containing arrays as items with `rate`, `title` and `label` entries, which set the playback rate, the title and aria-title for the buttons as well as adjust the button text.

#### Theme & Front-end

`.playback-rate-button.mejs-active` CSS-selector allows you to style the active speed (per-player)

#### Feedback

Please feel free to [suggest](https://github.com/CODESIGN2/media-playback-speed/issues) improvements, report conflicts, and/or make suggestions for integration hooks etc.

== Installation ==
Download and extract the zip file or clone this repo to your WordPress plugins directory. Alternatively use the plugin directory to find and install this plugin.

== Changelog ==
= 1.0.2 =
* Verified working with 5.2.2 (requires old-style shortcode media embedding)

= 1.0.1 =
* Modified to enable showing active speed (requires JS to function)

= 1.0.0 =
* Initial submission to plugin-directory after button integration works, and re-factoring by Lewis Cowles
