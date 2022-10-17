# Light-it Third Challenge Joaquin Segovia

- [Introduction](#introduction)
- [Built with](#built-with)
- [Getting Started](#getting-started)
  - [Installation](#installation)
  - [Running](#running)

## Introduction

This project is about PopCornTime! app - Joaquin Segovia's Third Challenge.

## Built With

- PHP
- Symfony
- Docker

## Getting Started

### Installation

1. Clone the repository
   ```sh
   git clone git@github.com:jsegovialightit/thirdchallenge.git
   ```
2. Update API_KEY env var (docker-compose.yml)
    If you don't have one, request it on https://www.omdbapi.com/apikey.aspx
3. Run docker
   ```sh
   docker compose up -d
   ```
4. Connect to docker console
   ```sh
   docker compose exec php bash
   ```
### Running

A. Normal
   ```sh
   ./moviepedia show [movieName]
   ```
B. With fullPlot
   ```sh
   ./moviepedia show [movieName] --fullPlot
   ```

Try with this movie's name:: scarface


## About Light-it

Light-it is a digital product agency that helps founders and companies ideate, build, and launch web and mobile applications people love to use. We have ample experience working with diverse products from different industries and company sizes. So, no matter whether you’re a startup or a Fortune 500 launching a new product, we’re here to help!
