# instagram-api

This project is just a quick script I put together to utilise the Instagram API in PHP in a fairly simple way. It needs more work to store the token in a .env file (or similar) but it does the job it was built for at the minute. Once you get your Instagram API token, add it to an `instagram.dat` file in the root of your project, then take a look at the example in `index.php`. There's also a `renewToken` method to renew the token (obviously) once the endpoit is hit, so setting a cron to access this endpoint every 28 days should keep your instagram feed alive.

You can follow this tutorial on how to generate an access token for your API - https://docs.oceanwp.org/article/487-how-to-get-instagram-access-token