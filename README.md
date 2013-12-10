# CreateDenton

The goal of CreateDenton is to forge real connections among Denton, Texas' creative industry to help CREATE work in Denton, CREATE beauty in Denton, CREATE tools to solve problems in Denton... to CREATE a better Denton. The site is merely a directory.

## How to Contribute

CreateDenton.com was created by [Patrick Daly](http://developdaly.com), Darren Smitherman, and Andrew Lewis. We've open-sourced the project in order to allow the creative community of Denton, TX to build upon this framework and enhance collaboration.

As a Villag project, CreateDenton is just one of other open-source tools to improve communities. When citizens of Denton participate in Villag projects they prove the value of the creative class in our city.

This is an open-source project which means the code is available for viewing and reusing. Darren and Patrick will continue to lead CreateDenton by casting its vision, approving enhancements, and managing the database.

We'd love your participation in any way you'd like to help! Be it code contributions, new ideas, road mapping, integrations, or any other way you think up we want to hear from you.

**This repository is specific to createdenton.com, but the "Create" framework can be put together by combining the WordPress theme and plugins from each of their respective repositories.**

### The "Create" Theme

The theme that powers this WordPress site can be found in its own repository over at https://github.com/Villag/create-theme

### The "Create" Plugin

The plugin that adds specific functionality can be found at https://github.com/Villag/create-plugin

## How this WordPress installation is setup

* WordPress as a Git submodule in `/wp/`
* Custom content directory in `/content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)
* All writable directories are symlinked to similarly named locations under `/shared/`.

## Questions & Answers

**Q:** Will you accept pull requests?  
**A:** Yes! This is a community project and everyone is is encouraged to participate.

**Q:** Why the `/shared/` symlink stuff for uploads?  
**A:** For local development, create `/shared/` (it is ignored by Git), and have the files live there. This gives a separation between Git-managed code and uploaded files.

**Q:** What's the deal with `local-config.php`?  
**A:** It is for local development, which might have different MySQL credentials or do things like enable query saving or debug mode. This file is ignored by Git, so it doesn't accidentally get checked in. If the file does not exist (which it shouldn't, in production), then WordPress will used the DB credentials defined in `wp-config.php`.
