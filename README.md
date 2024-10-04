

This is the second chapter of how to build a website. To see how to set up the website, you can check out [<b>Web App Azure</b>](https://github.com/AngelcoreS/Web-App-Azure).

In this tutorial, I’ll walk you through the steps I took to create a fully functional contact form email using PHPMailer. Throughout this process, I sharpened my skills in PHP and JavaScript, and gained hands-on experience with web servers, specifically NGINX. One of the most significant challenges I faced was programming the PHP integration in a way that prevents errors or redirects in the case of invalid inputs, using input sanitization for security purposes.

I also set up the structure on the website in a way that keeps the main PHP file outside the web server's wwwroot directory and hides the .php extension in the URL.

/site </br>
├── /wwwroot </br>
│   ├── /assets  </br>
│   │   ├── /css </br>
│   │   │   └── styles.css </br>
│   │   ├── /images </br>
│   │   │   └── logo.png </br>
│   │   └── /js </br>
│   │       └── script.js </br>
│   ├── about.html </br>
│   ├── contact.html </br>
│   ├── services.html </br>
│   └── index.html  </br>
├── /includes  </br>
	│   └── sendemail.php          # Sensitive form handling (not publicly accessible) </br>
	│   ├── PHPMailer.php         # PHPMailer library files </br>
	│ </br>
	└── /cofig </br>
 	   └── config.php           # Database config, environment variables </br>


This tutorial combines both the technical setup and problem-solving skills that helped me overcome various challenges, ensuring a smooth deployment process from code to live website.

While manual deployment may not always be practical due to the availability of frameworks that streamline the process, it was invaluable in strengthening my foundational understanding of how web apps are built and secured.

Once you finish step 1, 2 and 3 of [<b>Web App Azure</b>](https://github.com/AngelcoreS/Web-App-Azure). We are going to deploy this repository instead of the other, following similar Instructions. 

<h2>Deploy Web Blog Sample From Github</h2>

Once connected via SSH in the Azure portal, you’ll be inside the Azure App Service container. First, install Git by running the following command:

`apt update && apt install git`

![git](assets/Img/4git.png)

I recommend removing the entire wwwroot directory and cloning this repository, renaming it to wwwroot inside the same site folder.

![clone](assets/Img/5clone.png)

![wwwroot](assets/Img/6changename.png)

At this point, we need to create an includes folder at the same level as the wwwroot folder:

`cd /home/site && mkdir includes`

Next, move the following files: README.md, default, sendemail.php, sendemail.php.bk, and startup.sh to the includes folder.

Now, we need to edit the startup.sh file. Use nano to cut the last command, save the changes, and execute that command directly in the terminal.

![cut](assets/Img/7cut.png)

This step is necessary because the file was cloned from GitHub and contains hidden carriage return characters (\r) at the end of each line, which causes errors when executed.

![err](assets/Img/8edit.png)

In the Azure portal, navigate to Configuration under Settings. In the Startup Command box, enter the absolute path of the startup.sh file to ensure that it runs every time the app starts. This will apply the necessary configuration changes automatically, even after Azure scales or makes adjustments to the environment.

![start](assets/Img/9startup.png)

Finally, open a browser and navigate to your App Service URL:

![page](assets/Img/10contact.png)

<h2>The NGINX configuration file</h2>

You will notice that the URL ends with the .html extension. Omitting file extensions from your URLs improves security, usability, flexibility, and search engine performance, while also giving your website a cleaner and more professional appearance.

To achieve this, we need to modify the Nginx configuration file located at /etc/nginx/sites-available/default.

Since we already have this file inside the includes folder, execute the startup.sh script to automatically update the default configuration file:

`sh /home/includes/startup.sh`

![default](assets/Img/12default.png)

In this update, I made some changes compared to the previous tutorial. Instead of using the rewrite directive, I opted for return,[<b>based on this Stack Overflow discussion</b>](https://stackoverflow.com/questions/38228393/nginx-remove-html-extension)  . Start with a 302 temporary redirect, and once everything works as expected, switch to a 301 redirect, which indicates a permanent change and will be cached.

<h2>PHP file configuration</h2>

Here, we need to ensure that the fastcgi_pass directive (commonly found in the Nginx configuration files when you're configuring Nginx to work with a backend FastCGI process like PHP-FPM) is set to listen in the same pool configuration file.

To find where PHP-FPM is running, execute the following command:

`ps aux | grep php-fpm`

This will show you the location where php-fpm is running (/usr/local/etc/php-fpm.conf)

Next, use the following command to easily find the listen directive in the PHP-FPM pool configuration:

`grep -R "listen =" /usr/local/etc/php-fpm.d/www.conf`

The result of this command is what you will set in the fastcgi_pass directive in your Nginx configuration.

![default](assets/Img/12default.png)

Now, to test it out, try submitting a contact form. The PHP script should redirect you back to Contact.html because we haven't configured the Gmail SMTP server yet. Additionally, if you enter an invalid email (e.g., usuario@correo), it will redirect you to invalid_email.html, which is a separate page.

![default](assets/Img/14.1contacthtml.png)

Next, I'll explain how this PHP script works in detail.

<h2>PHP Script</h2>
