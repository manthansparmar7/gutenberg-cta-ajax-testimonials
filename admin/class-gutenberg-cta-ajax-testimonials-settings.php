<?php
/**
 * Class Gutenberg_CTA_Ajax_Testimonials_Settings
 * 
 * Handles the admin settings page and displays testimonials.
 */
class Gutenberg_CTA_Ajax_Testimonials_Settings {
    /**
     * Constructor to initialize admin menu actions.
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    /**
     * Adds an options page under the Settings menu in the WordPress admin.
     */
    public function add_admin_menu() {
        add_options_page(
            __('Plugin Settings', 'gutenberg-cta-ajax-testimonials'),
            __('Plugin Settings', 'gutenberg-cta-ajax-testimonials'),
            'manage_options',
            'gcta-testimonials-settings',
            array($this, 'render_settings_page')
        );
    }

    /**
     * Renders the admin settings page where testimonials are displayed.
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Testimonials Management', 'gutenberg-cta-ajax-testimonials'); ?></h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e('ID', 'gutenberg-cta-ajax-testimonials'); ?></th>
                        <th><?php esc_html_e('Author Name', 'gutenberg-cta-ajax-testimonials'); ?></th>
                        <th><?php esc_html_e('Testimonial Text', 'gutenberg-cta-ajax-testimonials'); ?></th>
                        <th><?php esc_html_e('Thumbnail', 'gutenberg-cta-ajax-testimonials'); ?></th>
                        <th><?php esc_html_e('Status', 'gutenberg-cta-ajax-testimonials'); ?></th>
                        <th><?php esc_html_e('Action', 'gutenberg-cta-ajax-testimonials'); ?></th>

                    </tr>
                </thead>
                <tbody id="testimonial-list">
                    <?php $this->load_testimonials(1); ?>
                </tbody>
            </table>
            <div id="ajax-loader" style="display: none;">
                <p><?php esc_html_e('Loading...', 'gutenberg-cta-ajax-testimonials'); ?></p>
            </div>
        </div>
        <?php
    }

    /**
     * Loads and displays testimonials from the custom post type 'user_testimonials'.
     * 
     * @param int $page The page number for pagination.
     */
    public function load_testimonials($page = 1) {
        $args = [
            'post_type'      => 'user_testimonials',
            'post_status'    => ['draft', 'publish'],
            'posts_per_page' => -1,
            'paged'          => $page,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $id = get_the_ID();
                $title = get_the_title();
                $desc = wp_trim_words(get_the_content(), 20, '...');
                $thumb = get_the_post_thumbnail($id, [50, 50]) ?: __('No image', 'gutenberg-cta-ajax-testimonials');
                $status = (get_post_status() === 'publish') ? __('Approved', 'gutenberg-cta-ajax-testimonials') : __('Pending', 'gutenberg-cta-ajax-testimonials');
                $status_class = ($status === __('Approved', 'gutenberg-cta-ajax-testimonials')) ? 'green-text' : 'orange-text';
                ?>
                <tr id="testimonial-<?php echo esc_attr($id); ?>" class="testimonial-row">
                        <td><?php echo esc_html($id); ?></td>
                        <td><a href="<?php echo esc_url($permalink); ?>" target="_blank"><?php echo esc_html($title); ?></a></td>
                        <td><?php echo esc_html($desc); ?></td>
                        <td><?php echo $thumb; ?></td>
                        <td id="status-<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($status_class); ?>"><?php echo esc_html($status); ?></td>
                        <td id="action-<?php echo esc_attr($id); ?>">
                            <?php if ($status === __('Pending', 'gutenberg-cta-ajax-testimonials')) : ?>
                                <button class="approve-btn" data-id="<?php echo esc_attr($id); ?>"><?php esc_html_e('Approve', 'gutenberg-cta-ajax-testimonials'); ?></button>
                            <?php else : ?>
                                <button class="delete-btn" data-id="<?php echo esc_attr($id); ?>"><?php esc_html_e('Delete', 'gutenberg-cta-ajax-testimonials'); ?></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
            }
            wp_reset_postdata();
        } else {
            echo '<tr><td colspan="5">' . esc_html__('No testimonials found.', 'gutenberg-cta-ajax-testimonials') . '</td></tr>';
        }
    }
}

// Initialize the testimonials admin class.
new Gutenberg_CTA_Ajax_Testimonials_Settings();