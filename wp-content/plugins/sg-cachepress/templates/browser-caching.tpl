# Leverage Browser Caching by SG-Optimizer
<IfModule mod_expires.c>
    ExpiresActive on
    ExpiresDefault                                      "access plus 2 months"
  # CSS
    ExpiresByType text/css                              "access plus 1 year"
  # Data interchange
    ExpiresByType application/json                      "access plus 0 seconds"
    ExpiresByType application/xml                       "access plus 0 seconds"
    ExpiresByType text/xml                              "access plus 0 seconds"
  # Favicon (cannot be renamed!)
    ExpiresByType image/x-icon                          "access plus 1 week"
  # HTML components (HTCs)
    ExpiresByType text/x-component                      "access plus 2 months"
  # HTML
    ExpiresByType text/html                             "access plus 0 seconds"
  # JavaScript
    ExpiresByType application/javascript                "access plus 1 year"
  # Manifest files
    ExpiresByType application/x-web-app-manifest+json   "access plus 0 seconds"
    ExpiresByType text/cache-manifest                   "access plus 0 seconds"
  # Media
    ExpiresByType audio/ogg                             "access plus 2 months"
    ExpiresByType image/gif                             "access plus 2 months"
    ExpiresByType image/jpeg                            "access plus 2 months"
    ExpiresByType image/png                             "access plus 2 months"
    ExpiresByType video/mp4                             "access plus 2 months"
    ExpiresByType video/ogg                             "access plus 2 months"
    ExpiresByType video/webm                            "access plus 2 months"
  # Web feeds
    ExpiresByType application/atom+xml                  "access plus 1 hour"
    ExpiresByType application/rss+xml                   "access plus 1 hour"
  # Web fonts
    ExpiresByType application/font-woff                 "access plus 2 months"
    ExpiresByType application/font-woff2                "access plus 2 months"
    ExpiresByType application/vnd.ms-fontobject         "access plus 2 months"
    ExpiresByType application/x-font-ttf                "access plus 2 months"
    ExpiresByType font/opentype                         "access plus 2 months"
    ExpiresByType image/svg+xml                         "access plus 2 months"
</IfModule>
# END LBC