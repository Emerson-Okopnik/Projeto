#!/bin/bash
apt-get update -y
apt-get install -y python3
cat <<'EOT' > /home/ubuntu/index.html
Backend API online
EOT
nohup python3 -m http.server 8000 --directory /home/ubuntu &