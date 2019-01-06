AWStats for DreamHost
=====================

An easy to setup packaging of AWStats and AWStats-Totals for use on
DreamHost web-hosting services (shared or managed VPS).

Installation
------------

AWStats-DH can be installed anywhere on a web site, and it will generate
stats for all sites hosted under the same shell user. To install AWStats-DH on the site `example.com`, SSH login to
the shell user (`ssh user@example.com`), and then perform the following setup.

- **Download**

  Clone AWStats-DH into `example.com`'s web directory:

  ```
  git clone --recurse-submodules https://github.com/chuckhoupt/awstats-dh.git example.com/awstats-dh
  ```

- **Build Initial Statistics**

   Run the update script to generate the initial reports:

   ```
   ~/example.com/awstats-dh/update-awstats
   ```

Now visit `example.com/awstats-dh/` to see the stats for all sites hosted
under that shell user.

Further Configuration
---------------------

- **Install Cron Job**

  To update the reports daily, install a cron job:

   ```
   @daily example.com/awstats-dh/cronic example.com/awstats-dh/update-awstats day
   ```

- **Secure Reports**

   Setup password protection for the `awstats-dh` directory via [DH's Htaccess Panel](https://panel.dreamhost.com/index.cgi?tree=advanced.webdav&).

Troubleshooting
---------------

- **`update-awstats` fails or only partially updates stats**

  By default, the `update-awstats` script process all available active logs (typically 3-30 days per site). If your shell user has a large number of sites, or very large logs, the script may be killed for excessive resource usage (on shared hosting). To avoid this problem, run the script with the `day` argument:
  
  ```
  ~/example.com/awstats-dh/update-awstats day
  ```
  
  In this mode, the script only looks at uncompressed log files for the last 24-48 hours (`access.log` and `access.log.0`), so it is faster and users fewer resources.
