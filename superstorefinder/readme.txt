** Please visit http://superstorefinder.net/products/superstorefinder/docs/ for the most updated guide **

Introduction
-------------

Super Store Finder is a full featured PHP Application integrated with Google Maps that displays nearby stores based on client user location using Geo IP. The responsive user interface for both frontend and backend are using Bootstrap which are user friendly for any platform including mobile devices.

Administrators will have a secure area to create new and manage stores. The admin supports multiple admins where super admin can manage them.


User Guide
----------

1. Database Setup

Run the SQL below to create the tables structure and sample data. A sample admin user is also created and all passwords are hashed using md5 encryption with salt is used. You can modify the salt which is located at '/admin/includes/config.inc.php' file.


/* Stores table */
CREATE TABLE `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `address` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `telephone` varchar(25) NOT NULL DEFAULT '',
  `fax` varchar(25) NOT NULL DEFAULT '',
  `mobile` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) NOT NULL DEFAULT '',
  `description` text character set utf8 collate utf8_bin NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `latitude` float NOT NULL DEFAULT '0',
  `longitude` float NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cat_id` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

/* Users table */
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL, 
  `firstname` varchar(255) NOT NULL, 
  `lastname` varchar(255) NOT NULL, 
  `facebook_id` varchar(255) NOT NULL, 
  `address` varchar(255) NOT NULL, 
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

/* Store categories table */
CREATE TABLE `categories` (
`id` int(11) NOT NULL auto_increment,
`cat_name` varchar(100) character set utf8 collate utf8_bin default NULL,
`cat_icon` varchar(255) default NULL,
`cat_parent_id` int(11) default NULL,
`cat_free_flag` int(1) default NULL,
PRIMARY KEY (id)
);

/* insert admin user */
/* Username: admin, Password: password */
insert  into `users`(`username`,`password`) values ('admin','e64a4f78be2256a38de080744dd5b117');

2. Setting up the Frontend Database Info and Path
You must enter your database information at /includes/config.inc.php file. You also need to enter the directory of the frontend folder and the address of your frontend page. This will make calling other php, css and javascript files easier without having to change each file.

3. Setting up the Admin Database Info and Path

You must enter your database information at /admin/includes/config.inc.php file. You also need to enter the directory of the admin folder and the address of the admin panel. This will make calling other php, css and javascript files easier without having to change each file.


// Database Settings
define('HOSTNAME','localhost');
define('DB_USERNAME','database_username');
define('DB_PASSWORD','database_password');
define('DB_NAME','store_finder');

Finally, be sure to set permission to 777 for admin/imgs and admin/uploads directory recursively

4. Administrator's Area

To view to the Administrator's Area visit the '/admin' section. You will be required to login. The premade login is username: admin, password: password


5. Adding and Managing Admin Users

You can have multiple admin users to manage your stores. Features such as Add/Edit/Delete admin users and change their password are available. To add a new admin user, login to administrator's area and click on 'Add Admin User' from the navigation bar. To view / edit / delete admin users, click on 'Admin User List'.


6. Store List

This will display all your store list from the database. You can add more store by clicking Add Store link at the top navigation. To edit or delete a specific Store use the edit icon for each store.


7. Adding Stores

To add a Store click the Add Store link from the main navigation. Here you can enter Store Name, Store Address, Upload picture, etc. Longitude and Latitude values will be auto detected upon entering an address.


8. Editing Stores

To edit a Store click the Edit icon for a store. You can make changes here and save.


9. Removing Stores

To delete a Store click the Delete icon for a particular store.

10. Approving Stores

Stores that have added by users from frontend by default will be having status of 'Not Approved', this means that they must be approved by an admin user before it's visible at frontend. Administrators can approve a store add request by clicking the Approve link near the status column.

11.How to Disable Geo IP

If you wish to disable Geo IP, edit index.php and search for:

$('#address').val(geoip_city()+", "+geoip_country_name());

Edit it to your city and country, example:

$('#address').val("Sydney, Australia");

12. How to embed your store finder?

You can embed your store finder on any website using the embed code which can be found at index page. Refer screenshot below.


13. Your store finder is ready!

1. Main Features

-Fully Integrated with Google Map
-Geo IP detect users access location and will search for nearby stores
-Sort distance from nearest to furthest from your area
-Public users can request to add store which will require admin approval
-Custom Map Markers
-Super fast search response, no page refresh required.
-Bouncing Animated Markers upon choosing a store for highlight purposes
-Display thumbnail of the stores
-Allows users to contact the store directly using email
-Search field with auto fill using Google Map API to locate nearby Stores
-Documented source code and complete easy to understand user guide
-Easy setup and ready to be used with a few steps of setup instructions
-Fully responsive dynamic layout! Tested on iPhone, iPads and other mobile devices
-Works on all major browsers
-Supports Unicode characters
-Embed your store finder anywhere on any website by pasting the embed code.
-24/7 support and troubleshooting are available

2. Administrator's Features

-Secure Login Area
-User friendly interface design powered by Bootstrap
-Add and manage your stores easily
-Upload image for each store with auto generated thumbnail
-Auto-detect Longitude and Latitude upon entering address
-Utilize jQuery and json to submit form and load Map elements without having to refresh page
-Easy to setup and easy to extend and customize
-Fully responsive and works on all major browsers
-Add new and manage multiple admin users.
-Change your own and other admin users password.