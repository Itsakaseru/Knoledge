<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
html {
	font-family: 'Myriad Pro Regular' !important;
}

.for-container {
    width: 100%;  
    min-height: 100vh;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    position: fixed; 
    overflow-y: scroll;
}

.for-container img{
    width: 100vh;  
    height: auto;
}

.btnCenter {
    display: flex;
}

.btn {
  font-weight: 400;
  padding: 20px;
  background-color: #5e7fdc;
  color: white;
  width: 320px;
  margin: 0 auto;
  text-align: center;
  font-size: 1.2em;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 80px;
  margin-bottom: 50px;
  transition: all 0.2s linear;
}
@media screen and (max-width: 400px) {
  .btn {
    margin: 0 auto;
    margin-top: 60px;
    margin-bottom: 50px;
    width: 200px;
  }
}
.btn:hover {
  background-color: rgba(94, 127, 220, 0.8);
  transition: all 0.2s linear;
}
::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

</style>
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
</head>
<body>
<div class="for-container" style="overflow: hidden;">
    <div class="left">
        <h1 class="text-center">Oops! Something went wrong!</h1>
        <h4 style="text-align: center; text-decoration: none !important;">404 Not Found</h4>
        <div class="btnCenter">
            <a style="text-align: center; text-decoration: none !important;" class="btn" href="<?php echo config_item('base_url') . 'Dashboard'; ?>">Return to Dashboard</a>
        </div>
    </div>
    <div class="right">
        <img src="<?php echo config_item('base_url') . 'assets/images/404.jpg'; ?>" alt=":3"/>
    </div>
</div>
</body>
</html>