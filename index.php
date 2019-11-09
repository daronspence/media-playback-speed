<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Audio Player, Video Player & PLaylist shortcodes. Based on original by Daron Spence.
 * Author: LewisCowles
 * Version: 1.1.1
 */

add_action( 'wp_footer', function(){
	$defaults = array(
		array('rate'=>0.5,'title'=>__('Playback Speed 0.5x','media-playback-speed'),'label'=>__('.5x','media-playback-speed')),
		array('rate'=>1.0,'title'=>__('Playback Speed 1x','media-playback-speed'),'label'=>__('1x','media-playback-speed')),
		array('rate'=>1.5,'title'=>__('Playback Speed 1.5x','media-playback-speed'),'label'=>__('1.5x','media-playback-speed')),
		array('rate'=>2.0,'title'=>__('Playback Speed 2x','media-playback-speed'),'label'=>__('2x','media-playback-speed')),
	);
?>
  <style>
	.mejs-button.blank-button>button {
		background: transparent;
		color: #ccc;
		font-size: 1em;
		width: auto;
	}
	</style>
	<script type="text/template" id="playback-buttons-template">
		<?php if(apply_filters('media-playback-speed-generate-controls', true)): ?>
			<?php foreach(apply_filters('media-playback-speed-data', $defaults) as $item): ?>
			<div class="mejs-button blank-button">
				<button type="button" class="playback-rate-button<?php echo (($item['rate'] == 1) ? ' mejs-active' : ''); ?>" data-value="<?php echo esc_attr($item['rate']); ?>" title="<?php echo esc_attr($item['title']); ?>" aria-label="<?php echo esc_attr($item['title']); ?>" tabindex="0"><?php echo esc_html($item['label']); ?></button>
			</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</script>
	<script type="text/javascript">
		// contain all JS effects of this plugin so we don't break sites
		(function() {
			// window.load is unfortunately the best handler to attach to for allowing media-element-js to initialize
			window.addEventListener("load", function() {
				var buttons = document.createRange().createContextualFragment(
					document.querySelector("#playback-buttons-template").innerHTML
				);
				var els = [].slice.call( document.querySelectorAll( '.mejs-container' ) );

				els.forEach(function(elem, i) {
					var mediaTag = elem.querySelector('audio,video');

					// buttons for me-js element
					[].slice.call(
						buttons.querySelectorAll('.playback-rate-button')
					).forEach(function(elem) {
						elem.setAttribute('aria-controls', mediaTag.id );
					});

					// parent for controls
					var controls = elem.querySelector('.mejs-controls');
					if(controls) {
						var container = controls.querySelector('.mejs-duration-container'),
							hasSpeedControls = controls.querySelector('.playback-rate-button');

						// Guard to ensure that this only affects as-yet unaffected elements
						if (!hasSpeedControls) {
							// insertAfter container
							container.parentNode.insertBefore(buttons.cloneNode(true), container.nextSibling);

							// when media is loaded persist the playback speed currently selected
							mediaTag.addEventListener('loadedmetadata', function(e) {
								var playlist = e.target.closest('.wp-playlist');
								if(playlist) {
									var activeSpeed = playlist.querySelector('.mejs-container .playback-rate-button.mejs-active'),
										rate = activeSpeed.dataset.value;

									// Guard against failing matchers. The DOM must be fulfilled, but this also means this part maybe doesn't need media-element-js
									if(!rate) { return; }

									// This is actually the magic. It's basically a more complex document.querySelector('video, audio').setPlaybackRate
									e.target.setPlaybackRate(rate);
								}
							});
						}
					}
				});
			});

			// AJAX / SPA supporting click bind handler
			// Uses data attribute and aria attribute as well as class-names from media-element-js & this plugin
			// because this binds to body it should always be available in a valid HTML page
			document.body.addEventListener('click', function(e) {
				// Because we're bound to body, we need to guard and only act on HTML elements with the right class
				if(!e.target || !e.target.classList.contains('playback-rate-button')) { return; }

				// We set aria attributes informing which DOMElement to control
				var mediaTag = document.querySelector(`#${e.target.getAttribute('aria-controls')}`),
					rate = e.target.dataset.value;

				// Guard against failing matchers. The DOM must be fulfilled, but this also means this part maybe doesn't need media-element-js
				if(!mediaTag || !rate) { return; }

				// This is actually the magic. It's basically a more complex document.querySelector('video, audio').setPlaybackRate
				mediaTag.setPlaybackRate(rate);

				var mediaPlaybackContainer = mediaTag.closest('.mejs-container');

				// This allows use outside of WordPress for this
				if(!mediaPlaybackContainer) { mediaPlaybackContainer = document.body; }

				// Clear all active playback rate buttons for this element of the active class
				[].slice.call(
					mediaPlaybackContainer.querySelectorAll('.playback-rate-button')
				).map(function(elem) {
					elem.classList.remove('mejs-active', 'active-playback-rate');
				});

				// Set the clicked element, or the matching to active rate to be active
				[].slice.call(
					mediaPlaybackContainer.querySelectorAll('.playback-rate-button')
				).forEach(function(elem) {
					if(rate && elem.dataset.value == rate) {
						elem.classList.add('mejs-active', 'active-playback-rate');
					}
				});
			});
		})();
	</script>
<?php
}, 1, 100 );
