WELCOME TO INSPIRATIONS!

(c) 2002-2006 Darren G. Gates


****** WHAT YOU NEED ******

To install Inspirations, you MUST have PHP 4.1.2 or better, and access to a server running MySQL. If you are using RedHat Linux, then you must have at least PHP 4.3.0.

Ideally you also have access to a user-friendly database admin tool, like phpMyAdmin, although this is not necessary. As long as you have the know-how and authority to create and modify tables on your MySQL database, you should be fine, since Inspirations comes with a simple installation script. If you want to use the email notification features of Inspirations, you should confirm with your web host that you are able to use the PHP mail() function, or have an appropriate SMTP mail server to use.

In your PHP installation, the register_globals variable can be On or Off. However, it is strongly recommended that you set the magic_quotes_gpc flag to On in your PHP.INI file. If you do not know what this is, you can probably just email your web host administrator to handle it. Or, just ignore it. Inspirations should still work, but in some cases, it may not process text with quotations (' or ") correctly. If you find some place where quotes cause the system to malfunction, please email me at g8z@yahoo.com and I will send you a fix.

****** STEP 1 - UPLOAD ******

First, copy the entire public_html directory to the folder of your choice on your web server. You might choose to create a new folder for the Inspirations program files, e.g.:

http://www.yourserver.com/inspirations

Then, within the /inspirations folder, you would have the various program folders, e.g.:

   /ihtml
   /include
   /install
   /languages
   /pear
   /smarty
   /users
   /account.php
   /...etc...
   
You may also choose to make Inspirations your website's homepage. To do this, you can create a simple index.html file which redirects users to the /inspirations subdirectory, OR you can just upload all of the Inspirations program files to the root of your web server. If you're not sure what all of this means, then please contact your web hosting admin.


****** STEP 2 - INSTALL ******

Go to:

http://www.yourdomain.com/inspirations/install.php  (or the location that you uploaded to in STEP 1)

... and follow the on-screen instructions. You will need your MySQL login information to run this install wizard correctly. Remember: your MySQL login information is probably NOT the same as your FTP login information. If you are unsure what the correct login data is, you should contact your website administrator.

Installation may involve changing the permissions of some files and folders using the 'chmod' utility if you have a UNIX or LINUX server. Most FTP clients are able to do this. If you have a Windows server, you should contact your web hosting admin about setting permissions on files and folders.


****** GETTING ASSISTANCE ******

If you need specialized tools in Inspirations or need some customization that is not available with the standard Inspirations distribution, then please email me at g8z@yahoo.com. I am usually willing to do such customizations for free if I think that they will benefit all users. If they are extremely specific and not generally applicable to most users, then I will charge my standard programming rate of $25/hour.

Please email me at g8z@yahoo.com if you would like installation assistance beyond what is provided in this readme file. A small installation charge may apply.


****** LICENSE ******

The $5 puchase of Inspirations includes: Rights to use Inspirations for any purpose you wish EXCEPT reselling, on a single domain or physical server. You may not take credit for any part of the development of this system. You may make any modifications to the code that you wish, but you may not resell the *source code* under any circumstances. For example, if you are a web developer, you may put Inspirations on a website that you developed. But you may not put up a link on your own website offering to sell Inspirations by itself, and you may not distribute the code to others without purchasing additional $5 licenses.

If you know someone who is interested in purchasing Inspirations, then you should direct them to www.TUFaT.com. Distributing the source code to Inspirations without the written consent of Darren G. Gates (the copyright owner) is called piracy and it is illegal in every country of the world.

If you include a link to my website on the same page that your installation of Inspirations is located, OR if you make some improvements to the code and email me your improvements, OR if you make some helpful suggestions for bug fixes & new features, then I may give you a free upgrade to the latest version, but I cannot guarantee it. You should contact me at g8z@yahoo.com or post a message on the TUFaT.com bulletin board to enquire about this.


****** ADDENDA ******

Since you are being given all of the source code, you may of course modify Inspirations in any way that you wish, provided that you know a bit of programming. However, I cannot provide any technical support for it once modified. I am willing to answer simple e-mail questions, but if you're very lost on the installation, then you probably don't have enough experience with PHP/MySQL to handle this program.

If you liked Inspirations, then please go to whatever forum you downloaded it from (like www.hotscripts.com) and give the program a favorable rating! Thanks. :)