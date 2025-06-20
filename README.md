# Orbuculum Website

This repository contains the source code for the Orbuculum website. The project is built using PHP and is containerized with Docker for easy development and deployment.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- Git

## Getting Started

Follow these steps to set up and run the project locally:

### 1. Clone the Repository

```bash
git clone <repository-url> website
cd website
```

### 2. Configure the Environment

1. Create a configuration file by copying the sample:

```bash
cp config/config.sample.php config/config.php
```

2. Modify the configuration files as needed:
   - Update `config/config.php` with your local settings
   - **IMPORTANT**: For development, set `'no_cache_static' => true` in your `config/config.php`

### 3. Start the Docker Containers

Launch the application using Docker Compose:

```bash
docker-compose up -d
```

This will start the following services:
- NGINX with PageSpeed (accessible at http://localhost:8090)
- PHP-FPM service

### 4. Access the Website

Once the containers are running, you can access the website at:

```
http://localhost:8090
```

## Development

### CSS Compilation

The project uses an automated CSS compilation system with hash-based versioning:

- CSS files will be automatically compiled when changes are detected
- The system relies on the `'no_cache_static' => true` setting that you should have set during configuration

### Project Structure

- `/config` - Configuration files
- `/content` - Website content
- `/partials` - Reusable PHP components
- `/public` - Publicly accessible files (JS, CSS, images)
- `/resources` - Source files for assets
- `/tools` - Development utilities

## Troubleshooting

### Common Issues

1. **Port conflicts**: If port 8090 is already in use, modify the port mapping in `docker-compose.yml`
2. **Permission issues**: Ensure proper file permissions for mounted volumes

## Additional Resources

For more information about the project, refer to the project documentation or contact the development team.
