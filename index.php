<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Media Player. Updated original by Daron Spence.
 * Author: LewisCowles
 * Version: 1.0.3
 */

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery' );
});

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
		(function($){
			$(window).load( function(){

				var $buttons = $( $("#playback-buttons-template").html() );
				var $els = $( '.mejs-container' );

				for ( i = 0; i < $els.length; i++ ){
					var mediaTag = $( $els[i] ).find('audio,video')[0];
					$buttons.find('.playback-rate-button').attr('aria-controls', mediaTag.id );
					var $controls = $( $els[i] ).find('.mejs-controls');
					if($controls.length > 0) {
						$controls.find('.mejs-duration-container').after( $buttons.clone() );
						$(mediaTag).on('loadedmetadata', function() {
							var activeSpeed = $(this).closest('.wp-playlist').find('.mejs-container .playback-rate-button.mejs-active');
								rate = activeSpeed.attr('data-value');
							$(this)[0].setPlaybackRate(rate);
						});
					}
				}
				$('body').on('click', '.playback-rate-button', function() {
					var btnEl = $(this),
							mediaTag = $('#'+btnEl.attr('aria-controls'))[0],
							rate = btnEl.attr('data-value');
					mediaTag.setPlaybackRate(rate);

					$(this).closest('.mejs-container').find('.playback-rate-button').removeClass('mejs-active');
					$(this).addClass('mejs-active');
				});
			});
		})(jQuery);
	</script>
<?php
}, 1, 100 );
