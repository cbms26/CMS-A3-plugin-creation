# Admin Notification Manager Plugin

[![WordPress Plugin](https://img.shields.io/badge/WordPress-Plugin-blue.svg)](https://wordpress.org/plugins/)
[![License: GPL v2 or later](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net/)

## Overview

The **Admin Notification Manager Plugin** is a WordPress plugin designed to manage custom notifications within the WordPress admin dashboard. This plugin allows administrators to create, schedule, and manage notifications that are visible to specific user roles. Additionally, the plugin includes an API integration feature to fetch dynamic content for notifications.

## Features

- **Role-Specific Notifications:** Target notifications to specific user roles such as Administrator, Editor, and Author.
- **API Integration:** Fetch and display dynamic content in notifications from external APIs.
- **Customizable Notifications:** Create notifications with custom messages, types, and scheduling options.
- **User-Friendly Interface:** Simple and intuitive UI for managing notifications directly within the WordPress admin dashboard.
- **Extensible:** Designed for easy customization and future enhancements, including potential frontend display capabilities.

## Installation

1. **Download the Plugin:**
   - Clone or download the plugin from this repository.

2. **Upload to WordPress:**
   - Upload the plugin files to the `/wp-content/plugins/admin-notification-manager/` directory or install it via the WordPress plugin repository.

3. **Activate the Plugin:**
   - Activate the plugin through the 'Plugins' menu in WordPress.

4. **Configure Settings:**
   - Navigate to `Admin Dashboard > Admin Notifications` to configure the plugin settings and create notifications.

## Usage

1. **Creating Notifications:**
   - Go to `Admin Dashboard > Admin Notifications`.
   - Fill out the notification form, including the message, type, start and end dates, and targeted user roles.
   - Save the notification to display it in the admin dashboard for the specified roles.

2. **API Integration:**
   - Set up API endpoints and keys in the `API Settings` section.
   - Use the `Run API Action` to fetch and display dynamic content from the configured API.

3. **Managing Notifications:**
   - View, edit, or delete existing notifications directly from the Admin Notifications page.

## Project Structure

- **`admin-notification-manager.php`:** The main plugin file that initializes the plugin.
- **`/includes/settings.php`:** Handles the admin settings page, including creating and saving notifications, and managing API settings.
- **`/includes/notifications.php`:** Manages the display of notifications in the admin dashboard and includes the logic for fetching notifications from the API.

## Future Enhancements

- **Frontend Display:** The plugin is currently backend-focused, but future updates may include the ability to display notifications on the frontend.
- **Advanced Scheduling:** Implement recurring notifications and more complex scheduling options.
- **Extended API Integration:** Expand the ability to process and display different types of data from APIs.

## Limitations

- **Fixed User Roles:** Currently supports Administrator, Editor, and Author roles. Additional roles require hard-coded updates.
- **API Data Types:** Only specific data types (e.g., titles, messages) are supported for API integration. Adding support for other data types requires customization.
- **Manual Deletion:** Notifications must be manually deleted; there is no automatic archival of expired notifications.

## Contributing

Contributions are welcome! Please fork this repository and submit a pull request. Ensure your code follows WordPress coding standards.

### Development Notes

- **Adding New User Roles:** If you need to support additional user roles beyond Administrator, Editor, and Author, you will need to modify the `settings.php` and `notifications.php` files to include the new roles. This involves adding the role checks when displaying notifications and updating the settings page to allow targeting these new roles.

- **Extending API Integration:** To support more data types from the API, you may need to modify the `adn_fetch_api_notifications` function in `notifications.php` to parse and display additional fields. This might involve customizing the display logic to handle various data formats.

- **Frontend Notification Display:** If you plan to extend the plugin to display notifications on the frontend, consider creating a shortcode or widget. You’ll need to add hooks to enqueue styles and scripts for frontend use and modify the logic in `notifications.php` to render notifications on frontend pages.

- **Testing:** It’s recommended to use PHPUnit for testing any modifications. Ensure that any new features are covered with appropriate test cases to maintain the integrity of the plugin.

## License

This plugin is licensed under the GPL v2 or later. See the [LICENSE](LICENSE) file for details.

## Contact

For support or inquiries, please contact [Your Name] at [your-email@example.com].

---

**Note:** This plugin is developed as part of a course project. It is designed to be easily extended and customized for various use cases within WordPress.
