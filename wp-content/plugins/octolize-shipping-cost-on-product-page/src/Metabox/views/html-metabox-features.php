<?php
/**
 * @var string              $title    .
 * @var MetaboxFeaturesList $features .
 * @var MetaboxButton       $button   .
 */

use Octolize\Shipping\CostOnProductPage\Metabox\MetaboxButton;
use Octolize\Shipping\CostOnProductPage\Metabox\MetaboxFeaturesList;

?>

<div class="octolize-upsell-box-container">
	<h3 class="octolize-upsell-box-title"><?php echo wp_kses_post( $title ); ?></h3>

	<div class="octolize-upsell-box-features">
		<ul>
			<?php foreach ( $features->get_features() as $feature ) : ?>
				<li>
					<span class="dashicons dashicons-yes"></span> <?php echo wp_kses_post( $feature ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="octolize-upsell-box-button-container">
		<a class="button octolize-upsell-box-button-primary" href="<?php echo esc_url( $button->get_url() ); ?>" target="<?php echo esc_url( $button->get_target() ); ?>">
			<?php echo wp_kses_post( $button->get_label() ); ?>
		</a>
	</div>
</div>
