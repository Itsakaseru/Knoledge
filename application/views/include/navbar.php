<div class="ui tablet computer only padded grid">
    <div class="ui secondary top fixed fluid menu">
        <a class="header item"><img src="<?php echo base_url('assets/images/logo.png'); ?>" style="height: auto; width: 12em;"></a>
        <div class=" right menu">
            <div class="item">
                <a href="#"><span class="iconify" data-icon="uil-bell" data-inline="false"></span></a>
                <span class="noti_count">3</span>
            </div>
            <div class="item">
                <div class="ui brown button topButton">Dashboard</div>
            </div>
            <div class="ui left labeled button item" tabindex="0">
                <div class="ui brown button" style="border-radius: .5rem 0 0 .5rem; font-family: 'Myriad Pro Semibold';">Admin</div>
                <div class="ui dark-brown button dropdown" style="border-radius: 0 .5rem .5rem 0; font-family: 'Myriad Pro Semibold';">
                    <i class="dropdown icon" style="color: #fff; margin: 0; font-size: 1rem !important;"></i>
                    <div class="menu">
                        <div class="item">Sign Out</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="ui mobile only padded grid">
    <div class="ui secondary top fixed fluid menu">
        <a class="header item"><img src="<?php echo base_url('assets/images/logo.png'); ?>" style="height: auto; width: 12em;""></a>
        <div class=" right menu">
            <div class="item">
                <button class="ui icon toggle basic button"
                    style="background-color: #955F26 !important; border: 0 !important;">
                    <i class="content icon" style="color: #fff;"></i>
                </button>
            </div>
    </div>
    <div class="ui vertical secondary fluid menu">
        <a style="color: #955F26;" class="item topButton">Dashboard</a>
        <a class="item topButton">
            <div class="ui dropdown topButton" style="color: #955F26;">
                Admin <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">Sign Out</div>
                </div>
            </div>
        </a>
        <a class="item topButton" style="color: #955F26;" href="#"><span class="noti_count">3</span>Notification</a>
    </div>
</div>
</div>

<style>
html,body{margin:0;padding:0}
.sticky-wrap{
	display:flex;
	flex-direction:column;
	min-height:100vh
}
.sticky-footer{margin-top:auto}

</style>

<div class="sticky-wrap">
  <div class="sticky-content">
    <h1>Test</h1>
  </div>
    <div class="sticky-footer">
        <div class="ui inverted brown vertical footer segment">
            <div class="ui center aligned container">
            <div class="ui stackable inverted divided grid">
                <div class="three wide column">
                <h4 class="ui inverted header">Our Team</h4>
                <div class="ui inverted list">
                    <a class="item" style="color: #fff !important;">Lemuel Lancaster</a>
                    <a class="item" style="color: #fff !important;">Andrio Effendi</a>
                    <a class="item" style="color: #fff !important;">Jeremy Yonathan</a>
                    <a class="item" style="color: #fff !important;">Hans Adithio</a>
                </div>
                </div>
                <div class="three wide column">
                <h4 class="ui inverted header">Contact</h4>
                <div class="ui inverted list" style="color: #fff !important;">
                    <a class="item" style="color: #fff !important;">lancaster.lemuel@gmail.com</a>
                    <a class="item" style="color: #fff !important;">andrioeffndi31@gmail.com</a>
                    <a class="item" style="color: #fff !important;">shigeru@gmail.com</a>
                    <a class="item" style="color: #fff !important;">hans.adithio@gmail.com</a>
                </div>
                </div>
                <div class="seven wide column">
                <h4 class="ui inverted header">Knoledge</h4>
                <p>Online student report management application.</p>
                </div>
            </div>
            <div class="ui inverted section divider"></div>
            <img src="<?php echo base_url('assets/images/logoWhite.png'); ?>" style="height: auto; width: 12em;" class="ui centered mini image"><br>
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Terms and Conditions</a>
                <a class="item" href="#">©2020 Knoledge</a>
            </div>
        </div>
    </div>
</div>