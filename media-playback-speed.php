<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Media Player.
 * Author: Daron Spence
 * Version: 0.1
 */

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery' );
});

add_action( 'wp_footer', function(){
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
		<div class="mejs-button blank-button">
			<button type="button" class="playback-rate-button" data-value="0.5" title="Playback Speed 0.5x" aria-label="Playback Speed 0.5x" tabindex="0">.5x</button>
		</div>
		<div class="mejs-button blank-button">
			<button type="button" class="playback-rate-button" data-value="1" title="Playback Speed 1x" aria-label="Playback Speed 1x" tabindex="0">1x</button>
		</div>
		<div class="mejs-button blank-button">
			<button type="button" class="playback-rate-button" data-value="1.5" title="Playback Speed 1.5x" aria-label="Playback Speed 1.5x" tabindex="0">1.5x</button>
		</div>
		<div class="mejs-button blank-button">
			<button type="button" class="playback-rate-button" data-value="2" title="Playback Speed 2x" aria-label="Playback Speed 2x" tabindex="0">2x</button>
		</div>
	</script>
	<script type="text/javascript">
		(function($){
			$(window).load( function(){

				var $buttons = $( $("#playback-buttons-template").html() );
				var $els = $( '.mejs-container' );

				for ( i = 0; i < $els.length; i++ ){
					var audioTag = $( $els[i] ).find('audio,video')[0];
					$buttons.find('.playback-rate-button').attr('aria-controls', audioTag.id );
					var $controls = $( $els[i] ).find('.mejs-controls');
					if($controls.length > 0) {
						$controls.find('.mejs-duration-container').after( $buttons.clone() );
					}
				}
				$('body').on('click', '.playback-rate-button', function() {
					var btnEl = $(this),
							mediaTag = $('#'+btnEl.attr('aria-controls'))[0],
							rate = btnEl.attr('data-value');
					mediaTag.setPlaybackRate(rate);
				});

			});
		})(jQuery);
	</script>
<?php
}, 1, 100 );
