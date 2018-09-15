AWStats for DreamHost
=====================

An easy to setup packaging of AWStats and AWStats-Totals for use on
DreamHost web-hosting services (shared or managed VPS).

Setup via Git
-------------

AWStats-DH can be installed anywhere on a web site, and it will generate
stats for all sites hosted under the same shell user.

For example, to install AWStats-DH on the site `example.com`, SSH login to
the shell user (`ssh user@host.dreamhost.com`), and then clone and update
awstats-dh in `example.com`'s web directory.

```
cd example.com
git clone --recurse-submodules https://github.com/chuckhoupt/awstats-dh.git
awstats-dh/update all
```

Now visit `example.com/awstats-dh/` to see the stats for all sites hosted
under that shell user.
