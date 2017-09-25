CI-WP
------

CI-WP is an enterprise software platform that brings MVC ( Model-View-Controller ) architecture to WordPress, CI-WP are based on CodeIgniter web framework and WordPress CMS with presetting configurations, including a group of MVC base layers and brand new themes for quick developing, testing and producing MVC websites and web applications.

Version
-------

1.0.1


CI-WP environment
-----------------

PHP, MySql, Apache, CodeIgniter 3.x, CodeIgnit libraries, WordPress 4.8.x, WordPress plugins, CI-WP MVC Base Layers, Fuseki Theme and Fuseki Child Theme.


CI-WP code installation
-----------------------

CI-WP initial installation package includes all code and data to run CI-WP as an enterprise platform, you should use CI-WP initial installation package as first time installation, if your development or production server is using CI-WP, you should not install this package again.

At first download CI-WP initial installation, release it, copy application and system directories to same parent directory of website root directory, copy all contents in htdocs directory to website root directory, if website root directory includes a WordPress instance, delete it before copying from CI-WP installation package.


CI-WP database installation
---------------------------

If domain of your development environment is not dev.ci-wp.com, open ciwp.sql file in released CI-WP directory with a text editor, replace dev.ci-wp.com with the domain of development environment and mail.example.com with your mail server,  save it. Import  ciwp.sql from MySQL command line or MySQL tools like MySQL Workbench, assign true to constant WP_USE_EXT_MYSQL in [website_root_dir]/wp-config.php, set database connections(host name, database name, user, password, etc.) in [website_root_dir]/wp-config.php and [CI-WP_install_dir]/application/database.php

CodeIgniter should use PDO driver and WordPress should use MySQLi extensions in normal CI-WP setup.


Production environment set up
----------------------------

Uncomment line: SetEnv CIWP_ENV production in [website_root_dir]/.htaccess file, umcommant line: define(‘WP_CACHE’, true); in [website_root_dir]/wp-config.php, if your server environment does not support SetEnv in .htaccess, uncomment following code in [website_root_dir]/index.php
if ( empty($_SERVER[‘CIWP_ENV’]) ) {
  $_SERVER[‘CIWP_ENV’] = ‘production’;
}

Inactive plugins that are used by development environment, for exaplem,  Theme Check and  Loco Translate, active W3 Total Cache, Wordfence Security and Wordfence Assistant, configure them to work for production environment.

Delete following Theme Unit Test data:

All pages except Log In, Log Out, Lost Password, Register, Reset Password, WPForms Preview — Private
All posts
All Events
All Categories and Event Categories
All Tags and Event Tags
All Media images
Delete ciwp_admion consumer to registered OAuth application or regenerate secret of OAuth credential to ciwp_admion consumer.

Set production environment’s scheme and domain to constant WP_SITEURL, WP_HOME and NOBLOGREDIRECT in [website_root_dir]/wp-config.php

Update passwords of 5 default WordPress users at last.


Documentation and help
----------------------

CI-WP project documents: http://ci-wp.com
General contacts and feedback: http://ci-wp.com/contact-us


Copyright
---------

License: GNU General Public License v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
