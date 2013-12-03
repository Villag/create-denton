# CreateDenton

The goal of CreateDenton is to forge real connections among Denton, Texas' creative industry to help CREATE work in Denton, CREATE beauty in Denton, CREATE tools to solve problems in Denton... to CREATE a better Denton. The site is merely a directory.

## How this WordPress installation is setup

* WordPress as a Git submodule in `/wp/`
* Custom content directory in `/content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)
* All writable directories are symlinked to similarly named locations under `/shared/`.

## Questions & Answers

**Q:** Will you accept pull requests?  
**A:** Yes! This is a community project and everyone is Denton is encouraged to participate.

**Q:** Why the `/shared/` symlink stuff for uploads?  
**A:** For local development, create `/shared/` (it is ignored by Git), and have the files live there. This gives a separation between Git-managed code and uploaded files.

**Q:** What's the deal with `local-config.php`?  
**A:** It is for local development, which might have different MySQL credentials or do things like enable query saving or debug mode. This file is ignored by Git, so it doesn't accidentally get checked in. If the file does not exist (which it shouldn't, in production), then WordPress will used the DB credentials defined in `wp-config.php`.
