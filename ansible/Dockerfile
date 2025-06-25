FROM debian:bullseye

# Evita prompts interativos
ENV DEBIAN_FRONTEND=noninteractive

# Instala dependências
RUN apt-get update && \
    apt-get install -y python3 python3-pip ssh git curl && \
    pip3 install ansible && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Diretório de trabalho
WORKDIR /app
