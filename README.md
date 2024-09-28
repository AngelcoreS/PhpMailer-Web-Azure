<h1>Contact Form Email Automation with PHPMailer</h1>

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
