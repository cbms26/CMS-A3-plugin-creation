<?php

// ================================
// Admin Notifications Display and Delete Section
// ================================

function adn_display_admin_notice() {
    $notifications = get_option('adn_notifications', []);

    if (!empty($notifications)) {
        foreach ($notifications as $index => $notification) {
            $current_user = wp_get_current_user();
            $roles = $notification['roles'];
            $display = false;

            // Check if the current user's role is included in the notification roles
            foreach ($current_user->roles as $role) {
                if (in_array($role, $roles)) {
                    $display = true;
                    break;
                }
            }

            // Display the notification if the user has the right role and it's within the date range
            if ($display && strtotime($notification['start_date']) <= time() && strtotime($notification['end_date']) >= time()) {
                echo '<div class="' . esc_attr($notification['type']) . ' notice is-dismissible">';
                echo '<p>' . esc_html($notification['message']) . '</p>';

                // Display delete button only for the user who created it
                if ($current_user->ID == $notification['user_id']) {
                    echo '<form method="post" action="" style="display:inline;">';
                    echo '<input type="hidden" name="adn_delete" value="' . $index . '" />';
                    echo '<button type="submit" class="button-link">Delete</button>';
                    echo '</form>';
                }

                echo '</div>';
            }
        }
    }
}
add_action('admin_notices', 'adn_display_admin_notice');

//Deleting saved notifications befreo its due date
function adn_delete_notification() {
    if (isset($_POST['adn_delete'])) {
        $notifications = get_option('adn_notifications', []);
        $index = intval($_POST['adn_delete']);

        if (isset($notifications[$index])) {
            unset($notifications[$index]);
            update_option('adn_notifications', array_values($notifications));
        }
    }
}
add_action('admin_init', 'adn_delete_notification');

// ================================
// API Notification Handling Section
// ================================

// Function to fetch notifications from an external API
function adn_fetch_api_notifications($api_endpoint, $api_key) {
    if (!empty($api_endpoint)) {
        $response = wp_remote_get($api_endpoint, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key
            )
        ));

        if (is_wp_error($response)) {
            error_log('Failed to fetch notifications from API: ' . $response->get_error_message());
            return;
        }

        $body = wp_remote_retrieve_body($response);
        $notifications = json_decode($body, true);

        // Debugging: Log the raw API response and the decoded data
        error_log('Raw API response body: ' . print_r($body, true));
        error_log('Decoded notifications: ' . print_r($notifications, true));

        // Ensure that the decoded response is an array
        if (!is_array($notifications)) {
            error_log('Fetched notifications is not an array: ' . print_r($notifications, true));
            return;
        }

        // Iterate through the notifications and display them
        if (!empty($notifications)) {
            foreach ($notifications as $index => $notification) {
                // Ensure the notification is an array and has the required keys
                if (is_array($notification) && isset($notification['title']) && isset($notification['body'])) {
                    $title = $notification['title'];
                    $message = $notification['body'];
                    $type = 'notice-info'; // Use a generic type for all notifications

                    echo '<div class="' . esc_attr($type) . ' notice is-dismissible">';
                    echo '<p><strong>' . esc_html($title) . ':</strong> ' . esc_html($message) . '</p>';
                    echo '</div>';
                } else {
                    // Log unexpected structures
                    error_log('Invalid structure in notification at index ' . $index . ': ' . print_r($notification, true));
                }
            }
        }
    }
}

// Function to send notifications to an external API
function adn_send_notification_to_api($notification) {
    $api_endpoint = esc_attr(get_option('adn_api_endpoint'));
    $api_key = esc_attr(get_option('adn_api_key'));

    if (!empty($api_endpoint) && !empty($api_key)) {
        $body = json_encode($notification);
        $response = wp_remote_post($api_endpoint, array(
            'body' => $body,
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key
            )
        ));

        if (is_wp_error($response)) {
            error_log('Failed to send notification to API: ' . $response->get_error_message());
        }
    }
}
