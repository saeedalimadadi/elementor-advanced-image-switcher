<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Advanced_Image_Switcher extends \Elementor\Widget_Base {

    public function get_name() {
        return 'advanced_image_switcher';
    }

    public function get_title() {
        return esc_html__('تغییر تصویر واکنش‌گرا (پیشرفته)', 'elementor-advanced-image-switcher');
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {

        $this->start_controls_section('content_section', [
            'label' => esc_html__('آیتم‌ها', 'elementor-advanced-image-switcher'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('title', [
            'label'   => esc_html__('عنوان', 'elementor-advanced-image-switcher'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => 'Podcasting',
        ]);

        $repeater->add_control('description', [
            'label'   => esc_html__('توضیح', 'elementor-advanced-image-switcher'),
            'type'    => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'توضیح کوتاه این آیتم...',
        ]);

        $repeater->add_control('link', [
            'label'       => esc_html__('لینک اختیاری', 'elementor-advanced-image-switcher'),
            'type'        => \Elementor\Controls_Manager::URL,
            'placeholder' => 'https://your-link.com',
            'default'     => ['url' => ''],
        ]);

        $repeater->add_control('image', [
            'label'   => esc_html__('تصویر', 'elementor-advanced-image-switcher'),
            'type'    => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => 'https://via.placeholder.com/600x400',
            ],
        ]);

        $this->add_control('items', [
            'label'       => esc_html__('لیست آیتم‌ها', 'elementor-advanced-image-switcher'),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
        ]);

        $this->add_control('reverse_desktop', [
            'label'        => esc_html__('جابجایی تصویر و متن در دسکتاپ', 'elementor-advanced-image-switcher'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => 'فعال',
            'label_off'    => 'غیرفعال',
            'return_value' => 'yes',
            'default'      => 'no',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('استایل', 'elementor-advanced-image-switcher'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('title_color', [
            'label'     => esc_html__('رنگ عنوان', 'elementor-advanced-image-switcher'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#222222',
            'selectors' => [
                '{{WRAPPER}} .text-item h3, .mobile-item h3' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('desc_color', [
            'label'     => esc_html__('رنگ توضیح', 'elementor-advanced-image-switcher'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#666666',
            'selectors' => [
                '{{WRAPPER}} .text-item p, .mobile-item p' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('img_radius', [
            'label'     => esc_html__('گردی گوشه تصویر', 'elementor-advanced-image-switcher'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => ['px' => ['min' => 0, 'max' => 100]],
            'default'   => ['size' => 12],
            'selectors' => [
                '{{WRAPPER}} img' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $items      = $settings['items'];
        $widget_id  = 'ais-' . $this->get_id();

        if (empty($items)) return;

        // خروجی HTML + CSS + JS
        include __DIR__ . '/widget-advanced-image-switcher-view.php';
    }
}
