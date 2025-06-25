#!/bin/bash
apt-get update -y
apt-get install -y python3
cat <<'EOT' > /home/ubuntu/index.html
Frontend app online
EOT
nohup python3 -m http.server 3000 --directory /home/ubuntu &