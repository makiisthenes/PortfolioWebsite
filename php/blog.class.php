<?php
    # Class is in charge of making HTML content.
    class blog{
        public $blogTitle;
        public $blogImageSrc;
        public $blogImageCaption;
        public $blogText;
        public $topContent;
        public $blogDate;
        public $blogURL;
        public $blogID;
        const BASE_URL = "viewBlog.php?id=";
        
        function __construct($blogTitle, $blogImageSrc, $blogImageCaption, $blogText, $topcontent, $blogDate, $blogID){
            $this -> blogTitle = $blogTitle;
            $this -> blogImageSrc = $blogImageSrc;
            $this -> blogImageCaption = $blogImageCaption;
            $this -> blogText  = $blogText;
            $this -> topContent = $topcontent;
            $this -> blogDate = $blogDate;
            $this-> blogID = $blogID;
            $this -> blogURL = $this->generateURL();
            
        }
        
        private function generateURL(){
            return self::BASE_URL . $this->blogID;
        }
        
        
        public function __toString(){
            if ($this->topContent == true){
                # Generate div content for top row here.
                $html = '
                    <div class="top_blog_container">
                    <div class="top_blog_container_top_wrapper">
                    <figure class="top_blog_container_top_wrapper_figure">
                    <img src="'. $this->blogImageSrc .'" rel="nofollow">
                    <div class="top_blog_container_top_wrapper_caption_wrapper">
                    <figcaption>'. $this->blogImageSrc .'</figcaption>
                    </div>
                    </figure>
                    </div>
                    <div class="top_blog_container_bottom_wrapper">
                    
                    <hgroup class="top_blog_container_bottom_wrapper_header">
                    <a href="'.$this->blogURL.'"><h3>'. $this->blogTitle .'</h3></a>
                    </hgroup>
                    <!-- Article Content [Send 300 words].-->
                    <div class="blur_effect_box">
                    <blockquote>
                    '.
                    $this->blogText
                    .'
                    </blockquote>
                    </div>
                    <div class="top_blog_container_bottom_wrapper_status_bar">
                    <span>'. htmlspecialchars($this->blogDate) .'</span>
                    <button class="read_futher blue_btn" onclick="'. $this->blogURL .'">Read More...</button>
                    </div>
                    </div>
                    </div>
                ';
                return $html;
            }else{
                # Generate bottom options div.
                $html = '
                <div class="full_width_narrow_blog_post">
                    <!-- Same contents but different format without image -->
                    <div class="full_width_narrow_blog_post_header">
                        <hgroup>
                            <a href="'.$this->blogURL.'"><h4>'. $this->blogTitle .'</h4></a>
                        </hgroup>
                        <button class="blue_btn" onclick=\'window.location.href="'.$this->blogURL.'";\'>Read More...</button>
                    </div>
                    <p>'. (new DateTime($this->blogDate))->format('D jS F Y H:i').'</p>
                </div>';
                return $html;
            }
            
        }
    }

    
    # Example generated using object method.
    #$blogTitle, $blogImageSrc, $blogImageCaption, $blogText, $topcontent, $blogDate, $blogID
    # $myBlog = new blog.class("Blog Title 1", "ImageSrc", "Blog Image Caption", "Blog Text", true, "12/01/2020", 8217);
    # echo $myBlog;
    
?>
    
    
    
    
    