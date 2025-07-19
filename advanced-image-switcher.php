<?php
/**
 * Plugin Name: Elementor Advanced Image Switcher
 * Plugin URI: https://github.com/YOUR_USERNAME/elementor-advanced-image-switcher
 * Description: یک ابزارک سفارشی برای Elementor جهت نمایش لیست آیتم‌ها با تغییر تصویر به‌صورت واکنش‌گرا.
 * Version: 1.0.0
 * Author: Saeed Alimadadi
 * Author URI: https://your-site.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: elementor-advanced-image-switcher
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// بررسی وجود Elementor
function eis_check_elementor_loaded() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-error"><p>افزونه <strong>Elementor</strong> باید نصب و فعال باشد تا "Elementor Advanced Image Switcher" کار کند.</p></div>';
		});
		return;
	}

	// بارگذاری فایل ابزارک
	require_once __DIR__ . '/widget-advanced-image-switcher.php';

	// ثبت ابزارک
	add_action('elementor/widgets/widgets_registered', function () {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Advanced_Image_Switcher());
	});
}
add_action('plugins_loaded', 'eis_check_elementor_loaded');
