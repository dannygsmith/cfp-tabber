# CampFirePixels Responsive Tabber Plugin

CampFirePixels Responsive Tabber is a WordPress Plugin that shows and hides hidden content.  Click the icon to open and reveal the content. Click again to close and hide it. Below 767px it is an accordion, and above it is a tabber.

## Features

This plugin includes the following features:

- Tabber    Shortcode: 
```
[tabber tab="First Tab" ]Four score and seven years ...[/tabber]
[tabber tab="Second Tab"]Of mice and men ...[/tabber]
[tabber tab="Third Tab" ]You can't handle the truth![/tabber]
[tabber tab="Fourth Tab"]Frankly Scarlet, I just don't give a damn![/tabber]
```
- NOTICE: you do not have to put a div around the shortcode, the plugin takes care of that for you.
- Font icon visual indicator
- jQuery sliding animation

## Installation

To install this plugin, you can download it by clicking on the GitHub download button or clone the repository.

1. Navigate to the `wp-content/plugins` folder of your project
2. Then type in terminal: `git clone git@github.com:dannygsmith/cfp-tabber.git`
3. Log into your WordPress website
4. Go to Plugins and activate CampFirePixels Responsive Tabber plugin

## Continue Development
If you want to continue development, you will need to have Composer, Gulp, Node.js, and npm installed on your machine.  

1. Navigate to the `wp-content/plugins/cfp-tabber` folder.  
2. Type `npm install` to install all of the `node_modules` for Gulp.
3. Type `composer install` to install the Composer PHP packages.
