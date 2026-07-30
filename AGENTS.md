# AGENTS.md

## Project

Laravel Resume Builder that converts LaTeX (.tex) files into PDF using pdflatex inside Docker.

## Stack

- Laravel
- PHP 8.4
- MySQL 8.4
- Docker
- TeX Live

## Run

```bash
docker compose up --build
```

App: http://localhost:8001

## AI Instructions

- Keep Docker configuration unchanged.
- Use pdflatex for PDF generation.
- Follow Laravel best practices.
- Do not commit generated PDFs or temporary files.
