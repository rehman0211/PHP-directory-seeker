<!DOCTYPE html>
<html lang="en">

<head>
  <title>System Task - DCKAP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="src/dist/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="src/dist/css/body.css">
  <link rel="stylesheet" href="src/dist/css/main.bundle.css">
  <script src="https://kit.fontawesome.com/4e5a72c756.js"></script>
</head>

<body>

<!-- MY PHP CODE STARTS -->

<?

  if(!isset($_SESSION)) {
    session_start();
  }
  $directoryPath = '';
  $content_array = [];
  $img = '';
  $extension = '';
  $error = '';

  function initialise(){
    $directoryPath = '';
    $content_array = [];
    $img = '';
    $extension = '';
    $error = '';
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["directoryPath"])) {
      $error = "Directory Path is required.";
    } else {
      $directoryPath = $_POST["directoryPath"];
      $content_array = getContents($directoryPath);
    }
  }

  function getImage($fileType){
    switch($fileType){
      case "Document":
        $img = "fa fa-file-text";
        break;
      case "Code":
        $img = "fa fa-file-code-o";
        break;
      case "Presentation":
        $img = "fa fa-slideshare";
        break;
      case "Excel":
        $img = "fa fa-file-excel-o";
        break;
      case "Folder":
        $img = "fa fa-folder-open";
        break;
      case "Image":
        $img = "fa fa-file-image-o";
        break;
      case "Video":
        $img = "fa fa-film";
        break;
      default : 
        $img = "fa fa-files-o";	
    }
    return $img;
  }

  function getExtension($filename){
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return $ext ? $ext : false;
  }

  function getContents($directoryPath){
    if(is_dir($directoryPath)){
      if ($handle = opendir($directoryPath))
      {
        while(($file = readdir($handle)) !== FALSE){
            if($file !=='.' and $file !=='..'){
              $contents[] = $file;
            }
        }
        closedir($handle);
      }
    }
    return $contents;
  }

  function getFileType($extension){
    $ftype='Not-known';
    if($extension==='md' || $extension==='doc' || $extension==='txt' || $extension==='docx'){
      $ftype = 'Document';
    }
    if($extension==='html' || $extension==='php' || $extension==='cpp' || $extension==='java' || $extension==='py'|| $extension==='js'){
      $ftype = 'Code';
    }
    if($extension==='pdf' || $extension==='ppt' || $extension==='pptx'){
      $ftype = 'presentation';
    }
    if($extension==='xlsx' || $extension==='xlsm' || $extension==='xlsb' || $extension==='csv' || $extension==='sql'){
      $ftype = 'Excel';
    }
    if($extension==='jpg' || $extension==='jpeg' || $extension==='png' || $extension==='tiff' || $extension==='gif'){
      $ftype = 'Image';
    }
    if($extension==='mp3' || $extension==='mp4' || $extension==='mkv'){
      $ftype = 'Video';
    }
    if($extension===false || $extension===''){
      $ftype = 'Folder';
    }
    return $ftype;
  }


?>

<!-- MY PHP CODE ENDS -->

  <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <div class="navbar-item is-hidden-desktop">
        <a href="https://github.com/rehman0211" class="icon is-large has-text-light">
          <i class="fab fa-2x fa-github"></i>
        </a>
      </div>
      <div class="navbar-item is-hidden-desktop">
        <a href="https://www.linkedin.com/in/ammad-rehman-a85b1b164" class="icon is-large has-text-light">
          <i class="fab fa-2x fa-linkedin-in"></i>
        </a>
      </div>
    </div>
    <div class="navbar-menu">
      <div class="navbar-end">
        <div class="navbar-item">
          <a href="https://github.com/rehman0211" class="icon is-large has-text-light">
            <i class="fab fa-2x fa-github"></i>
          </a>
        </div>
        <div class="navbar-item">
          <a href="https://www.linkedin.com/in/ammad-rehman-a85b1b164" class="icon is-large has-text-light">
            <i class="fab fa-2x fa-linkedin-in"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <section class="hero is-primary">
    <div class="hero-body">
      <div class="container">
        <div class="columns has-text-centered">
          <div class="column">
            <h1 class="title is-1">
              Mohd Ammad Rehman
              <?php initialise();?>
            </h1>
            <h2 class="subtitle">
              Computer Engineering Undergrad @ Aligarh Muslim University
            </h2>
            <p>
              <a href="https://drive.google.com/file/d/10h1OIoWh8a6kHvhsuQj8xmKgYMupyxrB/view?usp=sharing" class="icon has-text-light">
                <i class="fas fa-file-word"></i> <strong>Resume</strong>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h1 class="title">System Task - DCKAP</h1>
      <hr />
      <p>Create a web page that takes a full path to a folder as a parameter and outputs the HTML for an unordered list of all the files in that folder.
        The filenames should link to the files themselves, and before every filename, you should display an appropriate icon based on the file extension.
        You may use the icons from here <b><a href='https://fontawesome.com/v4.7.0/icons/#file-type'>https://fontawesome.com/v4.7.0/icons/#file-type</a></b>
        You may assume that every file extension has an icon. 
      </p>
    </div>
  </section>
  <section class="section">
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- heading message -->
        <div class="fadeIn first">
          <p class="subtitle" style="padding-top: 15px;padding-bottom: 20px;"><strong>Enter your Folder's Path</strong></p>
        </div>

        <!-- Form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <input type="text" class="fadeIn second" name="directoryPath" placeholder="Enter correct folder Path" value="<?php echo $directoryPath;?>" required>
          <span class="error">* <?php echo $error;?></span><br>
          <input type="submit" class="fadeIn fourth" value="Show Contents">
        </form>
        <!-- <button onclick="myFunction()">Try it</button> -->


      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h1 class="title">Folder Contains : </h1>
      <hr />
      <?php foreach($content_array as $filename){ ?>
        <div class="card" >
        <div class="card-content">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
              
              <i class="<?php echo getImage(getFileType(getExtension($filename)));?>" aria-hidden="true"></i>
              </figure>
            </div>
            <div class="media-content">
              <p class="title is-4"><a href="<?php echo  $directoryPath. '/' . $filename; ?>"><?php echo $filename; ?></a></p>
              <p class="subtitle is-6"><?php echo 'File Type : ' . getFileType(getExtension($filename)); ?></p>
            </div>
          </div>
        </div>
        </div>
        <br/><br/>
      <?php } ?>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h1 class="title">Assumptions & Constraints</h1>
      <hr />
      <div class="card">
        <div class="card-content">
          <div class="content">
              <ul>
                  <li>
                      <p class="subtitle is-6"><strong>File Types</strong><br> 
                        <ul>
                          <li>doc, txt, xlsx, csv, folder, jpeg, jpg, png, pdf, cpp, html, js, py</li>
                          <li>similar type of extensions have same logo</li>
                        </ul>
                      </p>
                  </li>
                  <li>
                    <p class="subtitle is-6"><strong>Nested folders/files are not displayed</strong><br>
                    </p>
                  </li>
                  <li>
                    <p class="subtitle is-6"><strong>This is a single Page, no rendering assumed.</strong><br>
                    </p>
                  </li>
              </ul>
          </div>
          
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h1 class="title">Contact</h1>
      <hr />
      <nav class="level">
        <div class="level-item has-text-centered">
          <div>
            <a href="https://www.linkedin.com/in/ammad-rehman-a85b1b164" class="icon is-large">
              <i class="fab fa-2x fa-linkedin-in"></i>
            </a>
            <p class="heading"><a href="https://www.linkedin.com/in/ammad-rehman-a85b1b164">linkedin</a></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <a href="https://github.com/rehman0211" class="icon is-large">
              <i class="fab fa-2x fa-github"></i>
            </a>
            <p class="heading"><a href="https://github.com/rehman0211">github.com/rehman0211</a></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <a href="https://medium.com/@marehman0211" class="icon is-large">
              <i class="fab fa-2x fa-medium"></i>
            </a>
            <p class="heading"><a href="https://medium.com/@marehman0211">medium.com/@marehman0211</a></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <a href="mailto:marehman0211@gmail.com" class="icon is-large">
              <i class="fas fa-2x fa-envelope"></i>
            </a>
            <p class="heading"><a href="mailto:marehman0211@gmail.com">marehman0211@gmail.com</a></p>
          </div>
        </div>
        
      </nav>
    </div>
  </section>

  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <a href="https://rehman0211.github.io" target="_blank" class="icon has-text-primary">
          <i class="fab fa-github"></i> <strong><a href="https://rehman0211.github.io">My Portfolio</a></strong></a>
      </p>
    </div>
  </footer>

  <script src="src/dist/js/bundle.js"></script>
</body>

</html>