<head>
    <title>Knoledge Login</title>
    <?php echo $main; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>
<body>
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <div class="ui image header">
                <img class="image" src="<?php echo base_url('assets/images/logo.svg'); ?>">
            </div>
            <form class="ui large form" action="<?php echo base_url('login/action'); ?>" method="post">
                <div class="field">
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <button class="ui button" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
