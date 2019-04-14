# [Terraria](http://terraria.org/)

>The very world is at your fingertips as you fight for survival, fortune, and glory. Delve deep into cavernous expanses, seek out ever-greater foes to test your mettle in combat, or construct your own city - In the World of Terraria, the choice is yours!

## Building

```bash
docker build -t mkorcha/terraria .
```

## Usage

After building with the included Dockerfile, you can run with a variety of environment variables to configure your Terraria server:

| Variable | Setting |
|----------|---------|
|MAX_PLAYERS | Set the maximum number of players |
|SERVER_PASSWORD | The password needed to connect to the server |
| WORLD_SIZE | The world size to generate, where 1 = small, 2 = medium, and 3 = large |
WORLD_NAME | The name of the world |
MOTD | Server message of the day |

Port **7777** (default Terraria port) is exposed for connections.

You can mount the folder `/opt/terraria/worlds` to have access to world data on the host and for persistence.

## Example

```bash
docker run -d -it \
  -e MAX_PLAYERS="8" \
  -e SERVER_PASSWORD="password123" \
  -e WORLD_SIZE="1" \
  -e WORLD_NAME="default" \
  -e MOTD="Welcome to my Terraria server!" \
  -v worlds:/opt/terraria/worlds \
  --name "terraria-server-1" \
  mkorcha/terraria
```
