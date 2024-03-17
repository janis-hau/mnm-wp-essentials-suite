# MNM Base Plugin for WordPress

## Description
MNM Base Plugin is a foundational WordPress plugin designed to streamline the development process of future WordPress projects. It adopts a modular approach, incorporating helper functions, utilities, script and style management, database configuration, admin page setup, and template customization.

## Features
- **Dynamic Constants**: Easily Define and retrieve constants dynamically throughout the plugin.
- **Utility Functions**: Utilize functions like `mnm_get_excerpt` for enhanced functionality.
- **Admin Page Framework**: Create and manage admin pages more efficiently.
- **Script and Style Management**: Easily manage scripts and styles for both admin and frontend.
- **Database Configuration**: Setup and manage database tables with ease.
- **Template Customization**: Handle custom templates effectively.

## Installation
1. Download the zip file from the GitHub repository.
2. Unzip the file and upload the `wp-base-plugin` folder to your WordPress `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage
Each functionality of the plugin is modularized in the `includes` directory. For specific usage, refer to the comments within each file. Some examples include:

### Defining and Using Dynamic Constants
- Define a constant: `mnm_define_dynamic_constant('CONST_NAME', 'CONST_VAL');`
- Retrieve a constant: `$value = mnm_get_dynamic_constant('CONST_NAME');`

### Database Configuration
Set up and manage database tables for the plugin. Refer to `includes/database/_config.php` for table definitions and database-related settings.

### Creating Admin Pages
Admin page configurations are located in `includes/pages/_config.php`. This file allows you to define the structure and capabilities of your admin pages.

### Templates
Manage and register custom templates. Template configurations are set in `includes/template/_config.php`.

### Scripts and Styles
- **Frontend**: Configure frontend scripts and styles in `includes/scripts_and_styles/_config-frontend.php`.
- **Admin**: Admin-specific scripts and styles are configured in `includes/scripts_and_styles/_config-admin.php`.

### Helper Functions
- **Debugging Helpers**: Use `mnm_pre_r($arr)` for a readable array/object output and `mnm_pre_v($arr)` for variable dumping.
- **Partials Loader**: Load partial template files dynamically using `mnm_load_plugin_partial('partial_name', $data)`. `$data` is an optional array passed to the partial.

## Contributing
Contributions are welcome. Please fork the repository and submit a pull request with your proposed changes.

## License
This plugin is licensed under the GPL-3.0+ license. See the LICENSE file for more details.

## Author
[my-new.me](https://my-new.me)

For more detailed documentation, refer to the inline comments within the codebase.