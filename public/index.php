<?php

$_hash = null;
if( array_key_exists('hash',$_GET) && $_GET['hash'] ) {
    $paste = (include 'retrieve.php');
}

if( array_key_exists('hash',$_GET) && !$_GET['hash'] )
    $_hash = $_GET['hash'];
$_editmode = (!array_key_exists('hash',$_GET) || !$_GET['hash'] || (array_key_exists('mode',$_GET) && $_GET['mode']=='edit')); 

?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>pastebee</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Another pastebin app">
    <meta name="keywords" content="pastebee, pastebin">
    <meta name="author" content="Ikaros Kappler">
    <meta name="date" content="2018-07-06">

    <link rel="stylesheet" href="css/fontawesome-3.2.1/css/font-awesome.css">
    <link rel="stylesheet" href="css/highlightjs-default.min.css">
    <Link rel="stylesheet" href="css/pastebee.css">
    <link rel="stylesheet" href="css/theme.default.css">
    <script src="js/pastebee.js"></script>
    <script src="js/highlight.min.js"></script>
    <script src="js/highlightjs-line-numbers.min.js"></script>
  </head>

  <body class="pastebee">
    <header>
      <div class="center-v">
         pastebee
	 | <button type="button" id="btn-new">New</button>
	 <?php if( $paste ) { ?>
	 | <button type="button" id="btn-edit" data-action="<?php echo $_editmode?'close':'edit'; ?>"><?php echo $_editmode?'Close':'Edit'; ?></button>
	 <?php } ?>
	 | <button type="button" id="btn-save">Save</button>
      </div>
    </header>
    <form id="pastebee-form">
       <div class="info">
          <input type="text" name="username" placeholder="Username" value="<?php echo $paste ? $paste['username'] : ''; ?>">
          <input type="text" name="title" placeholder="Title" value="<?php echo $paste ? $paste['title'] : ''; ?>">
	  <br>
          <input type="text" name="filename" placeholder="Filename" value="<?php echo $paste ? $paste['filename'] : ''; ?>">
          <select name="mime">
             <option value="text/plain" <?php echo $paste&&$paste['mime']=='text/plain'?'selected':''; ?>>Text (text/plain)</option>
	     <option value="text/markdown" <?php echo $paste&&$paste['mime']=='text/markdown'?'selected':''; ?>>Markdown (text/markdown)</option>
             <option value="text/javascript" <?php echo $paste&&$paste['mime']=='text/javascript'?'selected':''; ?>>Javascript (text/javascript)</option>
             <option value="application/json" <?php echo $paste&&$paste['mime']=='application/json'?'selected':''; ?>>JSON (application/json)</option>
	     <option value="text/css" <?php echo $paste&&$paste['mime']=='text/javascript'?'selected':''; ?>>CSS Stylesheet (text/css)</option>
	     <option value="text/x-javasource" <?php echo $paste&&$paste['mime']=='text/x-javasource'?'selected':''; ?>>Java Code (text/x-javasource)</option>
	     <option value="text/x-script.python" <?php echo $paste&&$paste['mime']=='text/x-script.python'?'selected':''; ?>>Python (text/x-script.python)</option>
	     <option value="text/x-c" <?php echo $paste&&$paste['mime']=='text/x-c'?'selected':''; ?>>C/C++ (text/x-c)</option>
	     <option value="text/x-script.sh" <?php echo $paste&&$paste['mime']=='text/x-script.sh'?'selected':''; ?>>Shell/Bash (text/x-script.sh)</option>
          </select>
          <input type="checkbox" name="public" id="public" class="d-hidden fancy-fa-togglebutton" <?php echo !$paste||$paste['public'] ? 'checked' : ''; ?>><label for="public">Public</label>
       </div>
       <?php if( $_editmode ) { ?>
       <div class="linenos font-mono"><?php
        if( $paste ) {
            // Split into lines on Windows, Mac and UNIX based systems
            $lines = preg_split ('/$\R?^/m', $paste['content']);
            for( $i = 0; $i <= count($lines); $i++ )
                echo "&gt;<br>"; // echo ($i+1) . "<br>";
        } else {
	    for( $i = 0; $i < 16; $i++ )
               echo "&gt;<br>";
        }
       ?>
       </div>
       <?php } ?>
       
       <?php if( !$_editmode ) {?>
       <pre id="content" class="font-mono"><?php if( $paste ) echo htmlentities($paste['content']); ?></pre>
       <?php } else { ?>
       <textarea name="content" id="content" class="font-mono" placeholder="This is a pastebin implementation
=================================

If you want to fork this go to https://github.com/IkarosKappler/pastebee

Type any code you want here and share it with your collegues, friends, and/or family.

Once you hit the 'save' button in the menu bar you can just share the generated link to show your work to others.

No file transfer required.

Have fun and do good
 (~￣▽￣)~
"><?php
        if( $paste )
            echo htmlentities($paste['content']);
        else 
            ; // include 'demo-conent.js';
       ?></textarea>
       <?php } ?>
    </form>
  </body>
</html>
