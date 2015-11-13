<?php header("Content-type: text/css"); ?>
/* Typography HTML
----------------------------------------------------------------------------------------------------*/
body {
	color:#000;
	font-family: 'Arial', arial, serif;
	font-size: 13px;
	line-height: 22px;
	font-style: normal;
	font-weight: 400;
	font-variant: normal;
	background-color:#f5f5f5;
	white-space:normal;
	overflow-x:hidden;
}
a:focus {
	outline:none;
}
a:active {
	outline:none;
}
:focus {
	-moz-outline-style:none;
}
a {
	text-decoration:none;
}
.hr {
	border:0;
	clear: both;
	height: 0px;
	border-top:1px solid #dedede;
	border-bottom:1px solid #fff;
	margin-top:35px;
	margin-bottom:35px;
}
hr {
	border:0;
	clear: both;
	height: 0px;
	border-top:1px solid #dedede;
	border-bottom:1px solid #fff;
	margin-top:35px;
	margin-bottom:35px;
}
a:link, a:active, a:visited {
	text-decoration:none;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-ms-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}
h1, h2, h3, h4, h5, h6 {
	
	line-height:100%;
	margin-bottom:10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	letter-spacing:1px;
}
h1 {
	font-size: 30px;
	line-height:34px;
}
h2 {
	font-size: 24px;
	line-height:28px;
}
h3.big {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
	font-size: 24px;
	line-height: 28px;
}
h3 {
	font-size: 20px;
	line-height:24px;
}
#project h3 {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
}
h4 {
	font-size: 16px;
	line-height:20px;
}
h5 {
	font-size: 12px;
	line-height:16px;
}
h6 {
	font-size: 10px;
	line-height:14px;
}
p {
	margin-top: 10px;
}
p:first-child {
margin-top:0;
}
#navi {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
	font-size:12px;
}
.caption-content span {
	font-size: 34px;
	line-height:38px;
	text-transform:uppercase;
	font-weight:600;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
}
.caption-content strong {
	font-size: 18px;
	line-height:23px;
	text-transform:uppercase;
	font-weight:600;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
}
ul.social li {
	text-transform:uppercase;
	font-size:10px;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
}
ul.tabs {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	letter-spacing:1px;
	font-size:11px;
}
h3.blog_title {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
}
h4.blog_title {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
}
.theme_color {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
}
ul.entry_details {
	text-transform:uppercase;
	font-size:10px;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
}
ul.blog_tags {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:10px;
}
.toggle_info {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:10px;
}
.older_post span {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:10px;
}
#project span {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:10px;
	font-weight:400;
}
#project ul li span {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:10px;
	font-weight:400;
}
ul.cform li label {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:11px;
}
.valmsg {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:11px;
}
input.button, #submit {
	font-size:11px;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
}
a.button {
	text-align: center;
	font-size:11px;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
}
#searchform input[type=text] {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	font-size:11px;
}
#sub_footer {
	font-size:10px;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
}
.testim-author  {
	text-transform:uppercase;
	font-size:11px;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	letter-spacing:1px;
	font-weight: 400;
}
strong {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
	font-size:11px;
	letter-spacing:1px;
}
table th {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	letter-spacing:1px;
	font-size:11px;
}
.fancycaption span {
	font-size:11px;
	text-transform:uppercase;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	letter-spacing:1px;
}
.blackTip .content {
	text-align: center;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:11px;
}
ul.contact li span.contact-title {
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-size:12px;
	font-weight:400;
}
blockquote.style1 {
	font-style: normal;
	font-size:14px;
}
blockquote.style2 {
	font-style: italic;
	font-size:14px;
}
blockquote.style3 {
	font-size:14px;
	letter-spacing:0.08em;
	line-height:1.5em;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
}
blockquote {
	font-size:14px;
	letter-spacing:0.08em;
	line-height:1.5em;
	font-family: '<?php echo $_GET['name']; ?>', <?php echo $_GET['alt']; ?>;
	text-transform:uppercase;
	font-weight: 400;
}
blockquote.style4 {
	font-style: italic;
	line-height:26px;
	font-size:14px;
	font-weight:lighter;
	letter-spacing:0.08em;
	line-height:1.5em;
}
blockquote.style5 {
	font-style: normal;
	font-size:14px;
}
blockquote.style6 {
	font-style: normal;
	font-size:14px;
}
ul.contact span.contact-content {
	    font-family: 'Arial', arial, serif;
  text-transform:none;

}