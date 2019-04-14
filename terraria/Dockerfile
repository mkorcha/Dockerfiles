FROM debian:9.4-slim

ARG TERRARIA_VERSION=1353

ENV MAX_PLAYERS=8
ENV SERVER_PASSWORD=""
ENV WORLD_SIZE=1
ENV WORLD_NAME="default"
ENV MOTD=""

WORKDIR /opt

# install dependencies
RUN apt update \
 && apt install wget unzip mono-complete -y

# set up Terraria server files
RUN wget http://terraria.org/server/terraria-server-$TERRARIA_VERSION.zip \
 && unzip terraria-server-$TERRARIA_VERSION.zip \
 && mv $TERRARIA_VERSION/Linux terraria \
 && rm -r terraria-server-$TERRARIA_VERSION.zip $TERRARIA_VERSION/ \
 && ls terraria \
 && chmod +x terraria/TerrariaServer* \
 && ln -s /root/.local/share/Terraria/Worlds /opt/terraria/worlds

VOLUME /opt/terraria/worlds

EXPOSE 7777

WORKDIR /opt/terraria
CMD mono --server --gc=sgen -O=all TerrariaServer.exe -secure -players $MAX_PLAYERS -password "$SERVER_PASSWORD" -world worlds/default.wld -autocreate $WORLD_SIZE -worldname "$WORLD_NAME" -motd "$MOTD"
