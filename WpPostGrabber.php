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

    /**
     * @param $url
     * @return mixed
     */
    function wp_api_curl(){

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
    function get_featured_image(){

        $json_data = $this->wp_api_curl();

        foreach( $json_data as $vals ){
            foreach( $vals->_links as $key => $val ){
                if( $key == 'wp:featuredmedia'):
                    $img_api_address[]= $val[0]->href;
                endif;
            }
        }

        if( ! empty( $img_api_address ) ):

            foreach( $img_api_address as $img_address ){
                // get image info
                $this->url = $img_address;

                // curl to get the correct url for the image
                $img_obj = $this->wp_api_curl();

                $this->featured_image[] = $img_obj->media_details->sizes->fp_blogdisplay->source_url;
            }

        endif;

        return $this->featured_image;
    }

    /**
     * @return array
     */
    function postObject(){

        $raw_data = $this->wp_api_curl();

        $img_urls = $this->get_featured_image();

        // add $img = $this->get_featured_image();
        $i = 0;
        foreach ( $raw_data as $key => $val ){

            if( $key = 'link' ){
                $post[$i][$key] = $val->link;
            }
            if( $key = 'guid' ){
                $post_item[$i][$key] = $val->guid->rendered;
            }
            if( $key = 'date' ){
                //convert the date to requested format
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

            $i++;

        }


        return $post_item;

    }

}