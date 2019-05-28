    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
        <div class="navbar-wrapper">
            <div class="navbar-header d-md-none">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item d-md-none">
                        <a class="navbar-brand" href="index.php"><img class="brand-logo d-none d-md-block" alt="crypto ico admin logo" src="/assets/images/logo/logo.png"><img class="brand-logo d-sm-block d-md-none" alt="crypto ico admin logo sm" src="/assets/images/logo/logo.png"></a>
                    </li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v">   </i></a></li>
                </ul>
            </div>
            <div class="navbar-container">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"> <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-<?php echo $lang['FLAG']; ?>"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"> <a class="dropdown-item" href="index.php?lang=en"><i class="flag-icon flag-icon-gb"></i> English</a> <a class="dropdown-item" href="index.php?lang=zho"><i class="flag-icon flag-icon-cn"></i> 普通話</a> <a class="dropdown-item" href="index.php?lang=spa"><i class="flag-icon flag-icon-es"></i> Español</a> <a class="dropdown-item" href="index.php?lang=hin"><i class="flag-icon flag-icon-in"></i> हिन्दी</a> <a class="dropdown-item" href="index.php?lang=ara"><i class="flag-icon flag-icon-sa"></i> العربية</a> <a class="dropdown-item" href="index.php?lang=por"><i class="flag-icon flag-icon-pt"></i> Português</a> <a class="dropdown-item" href="index.php?lang=rus"><i class="flag-icon flag-icon-ru"></i> Русский</a> <a class="dropdown-item" href="index.php?lang=jpn"><i class="flag-icon flag-icon-jp"></i> 日本語</a> <a class="dropdown-item" href="index.php?lang=deu"><i class="flag-icon flag-icon-de"></i> Deutsch</a> <a class="dropdown-item" href="index.php?lang=vie"><i class="flag-icon flag-icon-vn"></i> Tiếng việt</a> <a class="dropdown-item" href="index.php?lang=kor"><i class="flag-icon flag-icon-kr"></i> 한국어</a> <a class="dropdown-item" href="index.php?lang=fra"><i class="flag-icon flag-icon-fr"></i> Français</a> <a class="dropdown-item" href="index.php?lang=tur"><i class="flag-icon flag-icon-tr"></i> Türkçe</a> <a class="dropdown-item" href="index.php?lang=ita"><i class="flag-icon flag-icon-it"></i> Italiano</a> </div>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="transactions.php"><i class="ficon icon-wallet"></i></a></li>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"> <span class="mr-1"><?=$user_session?></span>
                            </a>
                            <?php include("right-dropdown.php") ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ////////////////////////////////////////////////////////////////////////////-->