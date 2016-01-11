## Writing a module ##

**Note**: this is just the text from an older email I've sent, so it might be a bit out of date, but I'll fix it in the morning


the dashboard controllers are in `/application/controllers/dashboard/` (`admin` and `client` .php)

right now, there's only one method in both, which is `index()` and it only displays the views - just the static HTML

you could try and make a method for each page that would be in the dashboard.
I think the easiest would be the ones in the admin panel regarding jobs: pending quotes, pending jobs, etc
since they mainly work with the jobs table - although the jobs model doesn't exist yet.

so the steps would be:
  1. copy the `getAllUsers()` method from the 'testing' controller to the dashboard controller. this is a sample of a controller method that gets some data out through the model and just dumps it on the page. having no HTML/views should be fine for now, since the purpose is just to get it working.
  1. then, copy the `customer_model class` into a new model for the jobs table, called `jobs_model`. in there, there are two methods: one for pulling data out and one for adding a new row.

an example would be a pending\_quotes() method in the admin panel. this would call the - say - `get_all_jobs_pending_quote()`
method of `jobs_model` and you would check the results in alasdaircampbell.com/dashboard/admin/pendingquotes -
this should redirect you to ... .com/en/dashboard/... it will return the same result for /fr/dashboard/etc, but leave that for
when the views would be added.

once these/this work(s), you could have only one method that takes a string argument naming the [status](http://code.google.com/p/teamo-webtranslator/wiki/Process#Job_statuses) of the jobs required, since the methods would do pretty much the same thing, and only the status changes from one query to another.