# WP API Posts

This is a small class that is used to grab posts from the WP API and comes in handy if you want to add a blog to a static site.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

To use this you will need to have a WordPress blog and a static web page where you want the posts from the blog to show up.

```
To use this class AS-IS the page you add this code to will  need to be PHP. 
If the page is htm/html then you can create a php script and retrieve results using Ajax.
```

### Installing

Add WpPostGrabber.php to your root directory or a folder in that directories 

```
public_html/inc/WpPostGrabber.php
```

Initiate the class

```
$get_post = new WpPostGrabber();
```

Define the API URL

```
Assuming that your installation of WP will be in a directory labeled “blog”
$get_post->url = 'http://mydomain.com/blog/wp-json/wp/v2/posts';
```

Set how many posts to retrieve

```
$get_post->post_number = 1;
```

Retrieve the data you need
```
$feature_image = $get_post->get_featured_image(); 


## Built With

* PHP

## Authors

Kevin Phillips

## License

This project is licensed under the MIT License

## Acknowledgments

* Hat tip to WordPress for almost a decade of initiating creativity in my life!


