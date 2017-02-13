# Space Idler
Multiplayer iterative / idling game. In space.

## Configs 
Do these things

    CREATE USER game WITH ENCRYPTED  PASSWORD 'a password of wonder';
    GRANT ALL PRIVILEGES ON DATABASE game TO PUBLIC;

Apache vhost template - the Rewrite rules are the key here

    <VirtualHost *:443>
      ServerName chi.godless-internets.org
      ServerAdmin owlmanatt@gmail.com
      DocumentRoot /var/www/space_idle/public

      ErrorLog ${APACHE_LOG_DIR}/error.log
      CustomLog ${APACHE_LOG_DIR}/access.log combined

      SSLCertificateFile /etc/letsencrypt/path
      SSLCertificateKeyFile /etc/letsencrypt/path
      Include /etc/letsencrypt/options-ssl-apache.conf

      # ZF2's rewrite rules
      <Directory /var/www/space_idle/public>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} -s [OR]
        RewriteCond %{REQUEST_FILENAME} -l [OR]
        RewriteCond %{REQUEST_FILENAME} -d
        RewriteRule ^.*$ - [L]
        RewriteCond %{REQUEST_URI}::$1 ^(/.+)/(.*)::\2$
        RewriteRule ^(.*) - [E=BASE:%1]
        RewriteRule ^(.*)$ %{ENV:BASE}/index.php [L]
      </Directory>
    </VirtualHost>

