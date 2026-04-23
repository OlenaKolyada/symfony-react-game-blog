FROM node:18

WORKDIR /app

ARG NEXT_PUBLIC_API_URL=http://localhost:8001
ENV NEXT_PUBLIC_API_URL=${NEXT_PUBLIC_API_URL}

COPY frontend/package*.json . 
RUN npm install

COPY frontend/ .

RUN npm run build

EXPOSE 3001
ENV PORT=3001

CMD ["npm", "start"]
