<?php

function adn_settings_page() {
    // Save Notification settings
    if (isset($_POST['adn_save'])) {
        $notifications = get_option('adn_notifications', []);
        $new_notification = [
            'message' => sanitize_text_field($_POST['adn_message']),
            'type' => sanitize_text_field($_POST['adn_type']),
            'start_date' => sanitize_text_field($_POST['adn_start_date']),
            'end_date' => sanitize_text_field($_POST['adn_end_date']),
            'roles' => $_POST['adn_roles'],
            'user_id' => get_current_user_id() // Store the current user ID to enable delete notifcation later
        ];
        $notifications[] = $new_notification;
        update_option('adn_notifications', $notifications);

        // Optionally send the notification to an external API (if apllicable)
        adn_send_notification_to_api($new_notification);
    }

    // API settings and actions remain the same
    if (isset($_POST['adn_api_action'])) {
        $api_endpoint = sanitize_text_field($_POST['adn_api_endpoint']);
        $api_key = sanitize_text_field($_POST['adn_api_key']);
        update_option('adn_api_endpoint', $api_endpoint);
        update_option('adn_api_key', $api_key);
        adn_fetch_api_notifications($api_endpoint, $api_key);
    }

    $saved_api_endpoint = esc_attr(get_option('adn_api_endpoint'));
    $saved_api_key = esc_attr(get_option('adn_api_key'));

    ?>
    <div class="wrap">
        <h1>Admin Dashboard Notifications</h1>

        <!-- Notification Settings Section from frontend -->
        <h2>Notification Settings</h2>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Notification Message</th>
                    <td><input type="text" name="adn_message" required /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Notification Type</th>
                    <td>
                        <select name="adn_type">
                            <option value="notice-info">Info</option>
                            <option value="notice-warning">Warning</option>
                            <option value="notice-error">Error</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Start Date</th>
                    <td><input type="date" name="adn_start_date" required /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">End Date</th>
                    <td><input type="date" name="adn_end_date" required /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">User Roles</th>
                    <td>
                        <input type="checkbox" name="adn_roles[]" value="administrator" checked /> Administrator
                        <input type="checkbox" name="adn_roles[]" value="editor" /> Editor
                        <input type="checkbox" name="adn_roles[]" value="author" /> Author
                    </td>
                </tr>
            </table>
            <input type="submit" name="adn_save" class="button-primary" value="Save Notification" />
        </form>

        <!-- API Settings Section from frontened -->
        <h2>API Settings and Action</h2>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API Endpoint</th>
                    <td><input type="text" name="adn_api_endpoint" value="<?php echo esc_attr($saved_api_endpoint); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">API Key (if applicable)</th>
                    <td><input type="text" name="adn_api_key" value="<?php echo esc_attr($saved_api_key); ?>" /></td>
                </tr>
            </table>
            <input type="submit" name="adn_api_action" class="button-primary" value="Save and Run API Action" />
        </form>
    </div>
    <?php
}
