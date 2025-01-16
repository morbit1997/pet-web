job "webapp" {
  group "webapp" {
    count = 1

    network {
        port "http" {to = 80}
    }

    task "nginx" {
      driver = "docker"
      template {
        destination = "local/myapp.conf"
        data        = <<EOF
server {
  listen 80;
  server_name myapp.local;
  root /var/www/myapp;
  location / {
    try_files $uri $uri/index.php;
  }

  location ~ \.php$ {
      try_files $uri =404;
      fastcgi_split_path_info ^(.+\.php)(/.+)$;
      fastcgi_pass php.service.consul:{{ env "NOMAD_PORT_php" }};
      fastcgi_index index.php;
      include fastcgi_params;
      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
      fastcgi_param PATH_INFO $fastcgi_path_info;
  }
}
EOF
      }
      config {
        image = "morbit1997/nginx:$BUILD_ID"
        ports = ["http"]
        volumes = [
          "local/myapp.conf:/etc/nginx/conf.d/default.conf"
        ]
      }
      service {
        name = "nginx"
        port = "http"

        check {
          type     = "tcp"
          interval = "10s"
          timeout  = "2s"
          path = "/index.php"
        }
      }
    }

    task "php" {
      driver = "docker"
      
      config {
        image = "morbit1997/php:$BUILD_ID"
      }
    }
  }
}