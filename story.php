<?php

require_once('functions.php');

$input = array(
	'name'=>FILTER_SANITIZE_STRING
);

$input=filter_var_array($_REQUEST, $input);
$shortname=$input['name'];

$index = get_index(INDEX_FILE_DEFAULT);
$story = null;
foreach($index as $index_story) {
  if($index_story[STORY_SHORT_NAME] == $shortname) {
    $story = $index_story;
    break;
  }
}

if(!$story) {
  die('No story selected.');
}

$story_url = 'http://www.gnpcb.org/esv/search/?q='.$story[STORY_REF];

?>
<HTML>
<HEAD>
  <TITLE><?php echo $story[STORY_NAME]; ?></TITLE>
  <meta name="viewport" content="width=device-width" />
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
</HEAD>
<BODY>

<div id="header">
  <h1><?php echo TITLE_DEFAULT; ?></h1>
</div>

<div id="navigationtop">
  <a href="/"><?php echo RETURN_TO_INDEX_DEFAULT; ?></a>
</div>
  
<div id="passage_heading">
  <h2><?php echo $story[STORY_NAME]; ?> (<?php echo $story[STORY_REF]; ?>)</h2>
</div>
<div id="passage">
  <?php echo get_passage($story[STORY_REF]); ?>
</div>

<div id="navigationbottom">
  <a href="<?php echo $story_url; ?>">Read the surrounding text of <?php echo $story[STORY_REF]; ?></a><br/>
  <a href="/"><?php echo RETURN_TO_INDEX_DEFAULT; ?></a>
</div>
  
<div id="footer">
  <?php include 'copyright.php'; ?>
</div>

</BODY>
</HTML>
