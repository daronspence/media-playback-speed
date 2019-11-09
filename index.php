<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Media Player. Updated original by Daron Spence.
 * Author: LewisCowles
 * Version: 1.0.4
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
		(function() {
			var buttons = document.createRange().createContextualFragment(
				document.querySelector("#playback-buttons-template").innerHTML
			);
			var els = [].slice.call( document.querySelectorAll( '.mejs-container' ) );

			els.forEach(function(elem, i) {
				var mediaTag = elem.querySelector('audio,video');
				[].slice.call(
					buttons.querySelectorAll('.playback-rate-button')
				).forEach(function(elem) {
					elem.setAttribute('aria-controls', mediaTag.id );
				})
				var controls = elem.querySelector('.mejs-controls');
				if(controls) {
					var container =controls.querySelector('.mejs-duration-container');
					container.parentNode.insertBefore(buttons.cloneNode(true), container.nextSibling);

					mediaTag.addEventListener('loadedmetadata', function(e) {
						var activeSpeed = e.target.closest('.wp-playlist').querySelector('.mejs-container .playback-rate-button.mejs-active');
							rate = activeSpeed.dataset.value;
						e.target.setPlaybackRate(rate);
					});
				}
			});
			document.body.addEventListener('click', function(e) {
				if(!e.target || !e.target.classList.contains('playback-rate-button')) { return; }

				var btnEl = e.target,
						mediaTag = document.querySelector(`#${e.target.getAttribute('aria-controls')}`),
						rate = e.target.dataset.value;
				mediaTag.setPlaybackRate(rate);

				[].slice.call(
					mediaTag.closest('.mejs-container').querySelectorAll('.playback-rate-button')
				).map(function(elem) {
					elem.classList.remove('mejs-active');
				});
				e.target.classList.add('mejs-active');
			});
		})();
	</script>
<?php
}, 1, 100 );
