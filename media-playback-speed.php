<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Audio Media Player.
 * Author: Daron Spence
 * Version: 0.1
 */

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery' );
});

add_action( 'wp_footer', function(){
?>
	<script type="text/template" id="playback-buttons-template">
		<div class="playback-speed-buttons-wrap" style="margin-top: 2em;">
			<button onclick="MPSchangePbRate(0.5, this )">.5x</button>
			<button onclick="MPSchangePbRate(1.0, this )">1x</button>
			<button onclick="MPSchangePbRate(2.0, this )">2x</button>
			<button onclick="MPSchangePbRate(4.0, this )">4x</button>
		</div>
	</script>
	<script type="text/javascript">
		(function($){
			$(window).load( function(){

				var $buttons = $( $("#playback-buttons-template").html() );
				var $els = $( 'audio.wp-audio-shortcode' );

				for ( i = 0; i < $els.length; i++ ){
					$buttons.find('button').attr('data-audio-el', $els[i].id );
					$( $els[i] ).after( $buttons.clone() );
				}

			});
		})(jQuery);

		function MPSchangePbRate( rate, el ){
			
			var audioTag = jQuery('#' + jQuery( el ).attr('data-audio-el') )[0];
			audioTag.playbackRate = rate;

		}
	</script>
<?php
}, 1, 100 );