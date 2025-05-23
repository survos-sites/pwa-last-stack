# Last Stack PWA

SymfonyCasts LAST stack app, as a PWA.

Also, random planets doesn't make sense, as it can create duplicates.  Instead, use [real planet data](https://raw.githubusercontent.com/Lazzaro83/Solar-System/master/planets.json)

@todo: add some authentication so that edit/delete buttons aren't public.

## Survos Tools

The images are resized using SAIS.  They are resized in AppFixtures, since there are so few images and we don't have a workflow for any other reason.  See pokemon or dummy for a more sophisticated approach to thumbnails.

# 30 Days with LAST Stack

Well hi there! This repository holds the code and script for the
[30 Days with LAST Stack](https://symfonycasts.com/screencast/30-days-last)
course on SymfonyCasts.

## Setup

If you've just downloaded the code, congratulations!!

To get it working, follow these steps:

### Download Composer dependencies

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

### Database Setup

![Database Diagram](assets/db.svg)


The code comes with a `compose.yaml` file (for Docker) and we recommend using
Docker to boot a database container. You will still have PHP installed
locally, but you'll connect to a database inside Docker. This is optional,
but I think you'll love it!

First, make sure you have [Docker installed](https://docs.docker.com/get-docker/)
and running. To start the container, run:

```
docker compose up -d
```

Next, build the database and the schema with:

```
# "symfony console" is equivalent to "bin/console"
# but its aware of your database container
symfony console doctrine:database:create --if-not-exists
symfony console doctrine:schema:create
symfony console doctrine:fixtures:load
```

If you do *not* want to use Docker, just make sure to start your own
database server and update the `DATABASE_URL` environment variable in
`.env` or `.env.local` before running the commands above. A simple way
to get the code running is to uncomment the `DATABASE_URL="sqlite...`
line in `.env` to use SQLite.

### Start the Symfony web server

You can use Nginx or Apache, but Symfony's local web server
works even better.

To install the Symfony local web server, follow
"Downloading the Symfony client" instructions found
here: https://symfony.com/download - you only need to do this
once on your system.

Then, to start the web server, open a terminal, move into the
project, and run:

```
symfony serve -d
```

(If this is your first time using this command, you may see an
error that you need to run `symfony server:ca:install` first).

Now check out the site at `https://localhost:8000`

Have fun!

## Have Ideas, Feedback or an Issue?

If you have suggestions or questions, please feel free to open an issue
on this repository or comment on the course itself. We're watching both :).

## Thanks!

And as always, thanks so much for your support and letting us do what we love!

<3 Your friends at SymfonyCasts
