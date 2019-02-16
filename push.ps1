git add .
git commit -m "working on team activity"
git push heroku master
heroku open '/teamActivities/addScripture.php'
heroku logs --tail