<?php

/**
 * Created by Kevin Phillips
 */

/*
 * @TODO add methods to grab the comment count etc.
 */
class WpPostGrabber {

    public $url;

    public $post_number;

    private $featured_image;

    private $author_array;


    /**
     * @return mixed
     * @internal param $url
     */
    function wpApiCurl(){

        $url = $this->url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);

        $data = curl_exec($ch);

        $json_data = json_decode( $data );

        return $json_data;
    }




    /**
     * @return mixed
     * @internal param $json_data
     */
    function getFeaturedImage(){

        $json_data = $this->wpApiCurl();

        $url_save = $this->url;

        foreach( $json_data as $vals ){
            foreach( $vals->_links as $key => $val ){
                if( $key == 'wp:featuredmedia') {
                    $img_api_address[] = $val[0]->href;
                }
            }
        }

        if( ! empty( $img_api_address ) ) {

            foreach ($img_api_address as $img_address) {
                // get image info
                $this->url = $img_address;

                // curl to get the correct url for the image
                $img_obj = $this->wpApiCurl();

                $this->featured_image[] = $img_obj->media_details->sizes->fp_blogdisplay->source_url;
            }

        }

        $this->url = $url_save;

        return $this->featured_image;
    }


    /**
     * @return mixed
     */
    function getAuthor(){

        $data = $this->wpApiCurl();

        $url_save = $this->url;

        foreach( $data as $vals_d ){
            foreach( $vals_d->_links as $key_d => $val_d ){
                if( $key_d == 'author'){
                    $auth_api_address[]= $val_d[0]->href;
                }
            }
        }

        if( ! empty( $auth_api_address ) ):
            $i = 0;
            foreach( $auth_api_address as $auth_address ){
                // set address
                $this->url = $auth_address;

                // curl to get the author info
                $auth_obj = $this->wpApiCurl();

                $this->author_array[$i]["name"] = $auth_obj->name;
                $this->author_array[$i]["link"] = $auth_obj->link;

                $i++;
            }

        endif;

        $this->url = $url_save;

        return $this->author_array;
    }

    /**
     * @return array
     */
    function postObject(){

        $raw_data = $this->wpApiCurl();

        $img_urls = $this->getFeaturedImage();

        $authors = $this->getAuthor();

        // add $img = $this->get_featured_image();
        $i = 0;
        foreach( $raw_data as $key => $val ){

            if( $key = 'link' ){
                $post_item[$i][$key] = $val->link;
            }
            if( $key = 'guid' ){
                $post_item[$i][$key] = $val->guid->rendered;
            }

            if( $key = 'date' ){
                // convert the date to requested format
                $d=strtotime( $val->date );
                $post_item[$i][$key] = date("d M Y ", $d);
            }
            if( $key = 'title' ){
                $post_item[$i][$key] = $val->title->rendered;
            }
            if( $key = 'excerpt' ){
                $post_item[$i][$key] = $val->excerpt->rendered;
            }
                $post_item[$i]["featured_image"] = $img_urls[$i];

                $post_item[$i]["author_name"] = $authors[$i]["name"];

                $post_item[$i]["author_link"] = $authors[$i]["link"];

            $i++;

        }

        return $post_item;

    }

}