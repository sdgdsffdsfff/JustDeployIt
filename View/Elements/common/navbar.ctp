<div class='second-navigation js-nav-bar is-menu-closed'>
    <div class='container u-clearfix'>
        <div class='second-navigation__title'>
            <a class="g-text-semibold" href="/deployments/index/<?php echo $Project['id'];?>"><?php echo $Project['name'];?></a>
        </div>
        <a class="second-navigation__toggle js-toggle-menu" href="#">
            <img alt="Menu Icon" class="second-navigation__toggle-img second-navigation__toggle-img--open" src="/img/icons/icon-menu-2eb971600fbdab538bd350931cbd5fe8.svg" />
            <img alt="Menu Icon" class="second-navigation__toggle-img second-navigation__toggle-img--hide" src="/img/icons/icon-hide-3ee2bdbbde6b0a782e4c8d23241bccf6.svg" />
        </a>
        <ul class='second-menu'>
            <li class='second-menu__item'>
                <a class="<?php if($this->request['controller'] == 'deployments') echo 'is-active'; ?> second-menu__link" href="/deployments/index/<?php echo $Project['id'];?>">Deployments</a>
            </li>
            <li class='<?php if($this->request['controller'] != 'deployments') echo 'is-active'; ?> is-dropdown second-menu__item'>
                <a class="second-menu__link second-menu__link--dropdown" href="/projects/edit/<?php echo $Project['id'];?>">Settings</a>
                <ul class='sub-menu box box--heavy'>
                    <li class='<?php if($this->request['controller'] == 'projects' && $this->request['action'] == 'edit') echo 'is-active'; ?> sub-menu__item'>
                        <a class="sub-menu__link" href="/projects/edit/<?php echo $Project['id'];?>">General Settings</a>
                    </li>
                    <li class='<?php if($this->request['controller'] == 'servers') echo 'is-active'; ?> sub-menu__item'>
                        <a class="sub-menu__link" href="/servers/index/<?php echo $Project['id'];?>">Servers &amp; Groups</a>
                    </li>
                    <li class='sub-menu__item'>
                        <a class="sub-menu__link" href="/projects/deepphpoop/config_files">Config Files</a>
                    </li>
                    <li class='sub-menu__item'>
                        <a class="sub-menu__link" href="/projects/deepphpoop/excluded_files">Excluded Files</a>
                    </li>
                    <li class='sub-menu__item'>
                        <a class="sub-menu__link" href="/projects/deepphpoop/notifications">Notifications</a>
                    </li>
                    <li class='sub-menu__item'>
                        <a class="sub-menu__link" href="/projects/deepphpoop/commands">SSH Commands</a>
                    </li>
                </ul>
            </li>
            <li class='second-menu__item'>
                <a href="https://github.com/shukai0828/DeepPHPOOP/tree/master">Browse Repository</a>
            </li>
            <li class='second-menu__item'>
                <a href="https://github.com/shukai0828/DeepPHPOOP/commits/master">View Commits</a>
            </li>
            <li class='second-menu__item second-menu__item--deploy'>
                <a href="/projects/deepphpoop/deployments/new">Deploy Now</a>
            </li>
        </ul>
    </div>
</div>
