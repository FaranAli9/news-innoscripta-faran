# Use the official node image as the base image
FROM node:18-alpine

# Set the working directory inside the container
WORKDIR /app

# Copy package.json and package-lock.json files
COPY package.json package-lock.json ./

# Install dependencies
RUN npm install

# Copy the rest of the application code
COPY . .

# Build the application
RUN npm run build

# Expose port 4173 (Vite's default port for preview mode)
EXPOSE 8080

# Start the application using Vite's preview mode
CMD ["npm", "run", "preview"]