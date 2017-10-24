# workpapers

<h3>The app is creating using Laravel 5.5</h3>
<h3>This app is for test only.</h3>

<h5>Steps on how to install</h5>
 
<ul style="list-style-type: none;">
	<li>Step 1. Install Laravel on your machine it may require <b> PHP7 above </b> See more Server Requirement in <a href="https://laravel.com/docs/5.5">Laravel Documentation</a></li>
	<li>Step 2. Open the terminal ang go to your project folder and run <b>composer update</b>. It make take minute.</li>
	<li>Step 3. In the project folder Copy the <b>.env.example</b> and create a new file <b>.env</b></li>
	<li>Step 4. Open <b>.env</b> and change the setting of the database</li>
	<li>Step 5. Run in the terminal <b>php artisan key:generate</b></li>
	<li>Step 6. Run in the terminal <b>php artisan migrate</b> this command will automatically create all table that the app needs.</li>
	<li>Step 7. To check the routes and the methods run <b>php artisan route:list</b></li>
	<li>Step 8. To make TEST run <b>phpunit</b> will display "No Test Executed" run <b>vendor\bin\phpunit.bat</b> </li>
	<li>Step 9. To run the app you can run the command <b>php artisan serve</b> or you can use <b>valet</b> or <b>vagrant</b> you can see it in <a href="https://laravel.com/docs/5.5">Laravel Documentation</a></li>
</ul>



<h5>To populate the database</h5>

<ul>
<li>Step 1. Run the command <b>php artisan tinker</b></li>
<li>Step 2. Run <b>factory('App\Folders',15)->create()</b> //this will create 15 folder dummy data</li>
<li>Step 3. Run <b>factory('App\Papers',15)->create()</b> //this will create 15 working papers dummy data</li>
</ul>