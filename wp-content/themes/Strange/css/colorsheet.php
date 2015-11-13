<?php header("Content-type: text/css"); ?>

a:link, a:active, a:visited {
	color : #666;
}
a:hover {
	text-decoration:none;
	color:#<?php echo $_GET['color']; ?>;
}
#strangemenu>ul>li.current-menu-item>a,
#strangemenu>ul>li.current-menu-parent>a{
	color:#<?php echo $_GET['color']; ?>;
}
#strangemenu ul li ul li .current-menu-item a,
#strangemenu ul li ul li .current-menu-parent a{
	color:#f5f5f5;
}
#strangemenu ul li a:hover {
	color: #<?php echo $_GET['color']; ?>;
}
#strangemenu ul li ul li a:hover { /*sub menus hover style*/
	color: #f5f5f5;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
#strangemenu ul li ul {
	border:1px solid #000;

}
#strangemenu ul li ul li ul {
	border:1px solid #000;
	border-top:1px solid #<?php echo $_GET['color']; ?>;
}
:hover#toTop {
	color:#<?php echo $_GET['color']; ?>;
}
#top {
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
#teaser {
	border-top:1px solid #<?php echo $_GET['color']; ?>;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
	background-color: #000;
}
#slider-wrapper {
	border-top:1px solid #<?php echo $_GET['color']; ?>;
	border-bottom:1px solid #000;
}
.caption-content strong {
	color:#f5f5f5;
	background:#<?php echo $_GET['color']; ?>;
}
.blog_title a:hover {
	color:#<?php echo $_GET['color']; ?>;
}
ul.entry_details {
	border-left:1px solid #<?php echo $_GET['color']; ?>;
}
ul.category_list a:hover {
	color:#<?php echo $_GET['color']; ?>;
}
ul.social li a:hover {
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
	color:#ccc;
}
h4.active a {
	color: #000;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
a.button, input.button, #respond input[type="submit"] {
	color:#f5f5f5;
	border-right:2px solid #<?php echo $_GET['color']; ?>;
}
input.button, #respond input[type="submit"] {
	border-right:2px solid #<?php echo $_GET['color']; ?>;
}
input.button:hover, .button:hover, #respond input[type="submit"]:hover {
	color:#<?php echo $_GET['color']; ?>;
	border-right:2px solid #000;
}
input.fancyinput:focus, textarea.fancyinput:focus {
	border: 1px solid #<?php echo $_GET['color']; ?>;
}
.highlight1 {
	background-color:#<?php echo $_GET['color']; ?>;
}
.dropcap1 {
	color:#<?php echo $_GET['color']; ?>;
}
.dropcap2 {
	background-color:#<?php echo $_GET['color']; ?>;
}
blockquote.style6 {
	border-left: 6px solid #<?php echo $_GET['color']; ?>;
}
blockquote.style5 {
border-left: 6px solid #<?php echo $_GET['color']; ?>;
border-right: 6px solid #<?php echo $_GET['color']; ?>;
    }
.fancycaption .slide-top {
	border-bottom:2px solid #<?php echo $_GET['color']; ?>;
}
.entry_hover a {
	border-right:2px solid #<?php echo $_GET['color']; ?>;
}
#container .entry_hover a:hover {
	color:#<?php echo $_GET['color']; ?> !important;
}
.theme_color {
	color:#<?php echo $_GET['color']; ?>;
}
::selection {
 background: #<?php echo $_GET['color']; ?>;
}
::-moz-selection {
 background: #<?php echo $_GET['color']; ?>;
}
ul.tags li a {
	color:#<?php echo $_GET['color']; ?>;
}
#footer li.cat-item a,
#footer li a,
#footer a {
	color:#999;
}
#footer li.cat-item a:hover,
.sub-footer a:hover,
#footer li a:hover,
#footer .tagcloud a:hover,
#footer a:hover {
	border-bottom:1px solid #<?php echo $_GET['color']; ?> !important;
	color:#<?php echo $_GET['color']; ?>;
}
#footer {
	border-top:1px solid #<?php echo $_GET['color']; ?>;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
#sub_footer a:hover {
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
	color:#ccc;
}

.entry_hover a {
	color: #f5f5f5;
}
.fancycaption .caption a h4 {
	color:#f5f5f5;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-ms-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}
.fancycaption .caption a:hover h4 {
	color:#<?php echo $_GET['color']; ?>;
}
.blog_title a {
	color:#000;
}
.portfolio h4 a:hover {
	text-decoration:none;
	color:#<?php echo $_GET['color']; ?>;
}
#project span {
	background:#<?php echo $_GET['color']; ?>;
}
.fancycaption span {
	color:#<?php echo $_GET['color']; ?>;
}
ul.team li a:hover {
	color:#000;
}
span.tweet_text a:hover {
	color:#000;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
span.tweet_time a:hover {
	color:#000;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
a.fancy_link:hover {
	color:#000;
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}

ul.blog_tags {
	border-bottom:1px solid #<?php echo $_GET['color']; ?>;
}
div.anythingSlider .thumbNav a.cur, div.anythingSlider .thumbNav a {
	background: #777;
	color: #FFF;
}

div.anythingSlider .thumbNav a {
	color: #FFF;
	background-color: #<?php echo $_GET['color']; ?>;
}

.comment .comments-number{ 
    color:#<?php echo $_GET['color']; ?>;
}
.tweet_join {
	color:#<?php echo $_GET['color']; ?>;
}
#footer .searchform input:focus {
	 border: 1px solid #<?php echo $_GET['color']; ?>;
    
}
#footer ul.cform input.fancyinput:focus, 
#footer ul.cform textarea.fancyinput:focus {
	border: 1px solid #<?php echo $_GET['color']; ?>;

}