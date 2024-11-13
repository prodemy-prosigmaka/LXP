FROM node:22

COPY . /usr/src/app
WORKDIR /usr/src/app

CMD ["/bin/bash", "-c", "npm install && npm run build"]
