<?php

if( array_key_exists('hash',$_GET) && $_GET['hash'] ) {
    $paste = (include 'retrieve.php');
}

?><!DOCTYPE html>
<html>
  <head>
    <title>pastebee</title>
    <meta charset="UTF-8">
    <meta name="description" content="Another pastebin app">
    <meta name="keywords" content="pastebee, pastebin">
    <meta name="author" content="Ikaros Kappler">
    <meta name="date" content="2018-07-06">

    <link rel="stylesheet" type="text/css" media="screen" href="css/pastebee.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/theme.default.css">
    <script src="js/pastebee.js"></script>
  </head>

  <body class="pastebee">
    <header>
      <div class="center-v">
         pastebee | <button type="button" id="btn-new">New</button> | <button type="button" id="btn-save">Save</button>
      </div>
    </header>
    <form id="pastebee-form">
       <div class="info">
          <input type="text" name="title" placeholder="Title" value="<?php echo $paste ? $paste['title'] : ''; ?>">
          <input type="text" name="filename" placeholder="Filename" value="<?php echo $paste ? $paste['filename'] : ''; ?>">
          <input type="checkbox" name="public" <?php echo $paste && $paste['public'] ? 'checked' : ''; ?>><label for="public">Public</label>
          <br>
          <select name="mime">
             <option value="text/plain" <?php echo $paste&&$paste['mime']=='text/plain'?'selected':''; ?>>Text (text/plain)</option>
             <option value="text/javascript" <?php echo $paste&&$paste['mime']=='text/javascript'?'selected':''; ?>>Javascript (text/javascript)</option>
             <option value="application/json" <?php echo $paste&&$paste['mime']=='application/json'?'selected':''; ?>>JSON (application/json)</option>
          </select>
          <input type="text" name="username" placeholder="Username" value="<?php echo $paste ? $paste['username'] : ''; ?>">
       </div>
       <div class="linenos font-mono"><?php
        if( $paste ) {
            // Split into lines on Windows, Mac and UNIX based systems
            $lines = preg_split ('/$\R?^/m', $paste['content']);
            for( $i = 0; $i <= count($lines); $i++ )
                echo ($i+1) . "<br>";
        } else {
            echo "&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;<br>&gt;";
        }
       ?></div>
   
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
    </form>
  </body>
</html>
