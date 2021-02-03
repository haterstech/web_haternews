# HTTPS forced by SG-Optimizer
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{HTTPS} off
	RewriteRule ^(.*)$ https://%{SERVER_NAME}%{REQUEST_URI} [R=301,L]
</IfModule>
# END HTTPS