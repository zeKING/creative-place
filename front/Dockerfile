FROM node:lts-alpine

RUN mkdir /app
WORKDIR /app

COPY package*.json ./
COPY yarn.lock ./

COPY . ./

RUN yarn install

EXPOSE 3000

RUN yarn generate

ENV NODE_ENV=production
ENV HOST=0.0.0.0
ENV BASE_URL=https://admin.5ss.uz
CMD [ "yarn", "start" ]
