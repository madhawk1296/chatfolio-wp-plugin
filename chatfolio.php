<?php
/**
 * Plugin Name: Chatfolio
 * Description: ChatGPT for your portfolio website.
 * Version: 1.0
 * Author: Chatfolio.org
 */

function chatfolio_script_insert() {
    $chatfolio_id = get_option('chatfolio_script_id');
    if ($chatfolio_id) {
        echo "<script src='https://chatfolio.org/chatbot?id={$chatfolio_id}' async defer></script>";
    }
}

add_action('wp_head', 'chatfolio_script_insert');

// Add settings page
function chatfolio_add_settings_page() {
    add_options_page('Chatfolio Script Settings', 'Chatfolio Script', 'manage_options', 'chatfolio-script', 'chatfolio_render_settings_page');
}
add_action('admin_menu', 'chatfolio_add_settings_page');

// Render the settings page
function chatfolio_render_settings_page() {
    ?>
    <div class="wrap">
        <h2>Chatfolio Script Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('chatfolio-script-settings');
            do_settings_sections('chatfolio-script-settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                <th scope="row">Chatfolio ID</th>
                <td><input type="text" name="chatfolio_script_id" value="<?php echo esc_attr(get_option('chatfolio_script_id')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Initialize settings
function chatfolio_settings_init() {
    register_setting('chatfolio-script-settings', 'chatfolio_script_id');
}
add_action('admin_init', 'chatfolio_settings_init');