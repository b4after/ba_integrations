<?php
add_action('admin_menu', 'ba_menuitem_setup');

function ba_menuitem_setup() {

    add_menu_page(
            'Integracje', 'Integracje', 'manage_options', 'ba_integracje_functions.php', 'ba_integracje_aftersetup', 'dashicons-admin-comments', 99);
}

add_action('admin_init', 'register_ba_integracje_settings');

function register_ba_integracje_settings() {
    //register our settings
    register_setting('kod_js', 'kod_analytics');
    register_setting('kod_js', 'inne_kody_javascript');
}

/**
 * Pokazuje content strony
 */
function ba_integracje_aftersetup() {
    echo '<h1>Panel integracji</h1>';
    ?>
    <form method="post" action="options.php">
        <?php settings_fields('kod_js'); ?>
        <?php do_settings_sections('kod_js'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    Kod analytics:<br/>
                    (head)
                </th>
                
                <td>
                    <textarea rows="8" cols="80" name="kod_analytics"><?php echo esc_textarea(get_option('kod_analytics')) ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Inne kody JS:<br/>
                    (footer)
                </th>
                <td>
                    <textarea rows="8" cols="80" name="inne_kody_javascript"><?php echo esc_textarea(get_option('inne_kody_javascript')) ?></textarea>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

    <?php
}

add_action('wp_footer', 'ba_add_scripts', 100);
add_action('wp_head', 'ba_add_analytics', 100);

function ba_add_analytics() {
    if (get_option('kod_analytics')) {
        echo '<!--Analytics Code-->';
        echo get_option('kod_analytics');
        echo '<!--Analytics Code-->';
    }
}

function ba_add_scripts() {

    if (get_option('inne_kody_javascript')) {
        echo '<!--Custom JS-->';
        echo get_option('inne_kody_javascript');
        echo '<!--Custom JS-->';
    }
}
