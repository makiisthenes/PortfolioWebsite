<?php
    # Class is in charge of making HTML content.
    class Comment{
        public $commentID;
        public $commentText;
		public $commentDate;
		public $username;
		public $isAuthor;
        
        function __construct($commentID, $commentText, $commentDate, $username, $isAuthor){
            $this -> commentID = $commentID;
            $this -> commentText = $commentText;
            $this -> commentDate = $commentDate;
            $this -> username  = $username;
			$this -> isAuthor = $isAuthor;
        }
		
		function __toString(){
			# Generate HTML Code here with information.
			$string = '
			<!-- Gen Comment Here. -->
			<div class="comment_wrapper" id="comment-'.$this->commentID.'">';
			if ($this->isAuthor){
				$string .= '
				<div class="option_comment_wrapper">
						<a>
							<button class="option_btn" id="'.$this->commentID.'">
								Delete
							</button>
						</a>
					</div>';	
			};
			$string .= '<div class="username_comment">
					<a href="#">
						'.$this->username.'
					</a>
				</div>
				<div class="message_comment">
					<span>
						'.$this->commentText.'
					</span>
				</div>
				<div class="date_comment">
					'.(new DateTime($this->commentDate))->format('d-m-Y').'
				</div>
			</div>
			<!-- End of Gen Comment -->	';
			return $string;
		}
	};