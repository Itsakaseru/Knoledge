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
            <form class="ui large form <?php if(validation_errors() || isset($pw_false)) echo "error" ?>" action="<?php echo base_url('login/action'); ?>" method="post">
                <div class="ui error message">
                    <ul class="list">
                        <?php if(form_error('email') != NULL) echo form_error('email'); ?>
                        <?php if(form_error('password') != NULL) echo form_error('password'); ?>
                        <?php if($pw_false == 1) echo "<li>Wrong email or password.</li>"; ?>
                    </ul>
                </div>
                <div class="field">
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <!--
                <div class="field remember-me">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0">
                        <label>Remember Me</label>
                    </div>
                </div>
                -->
                <button class="ui button" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
