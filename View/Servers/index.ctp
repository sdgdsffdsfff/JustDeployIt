    <div class='section section--first section--with-create box'>
        <div class='page-header'>
            <h2 class='page-header__title g-heading-alpha'>Servers</h2>
            <p class='page-header__lead'>
                The list below shows all the servers which are configured for this project.
            </p>
        </div>
        <a class="button button--positive button--create section__create" href="/servers/new/<?php echo $Project['id']; ?>" title="New Server">
            <img alt="Icon add" class="button__icon" src="/img/icons/icon-add-e0280f31016ead5fa85f6969fbd6f2db.svg" />
        </a>
    </div>
    <div class='content--constrained'>
        <div class='box section section--first section--skinny'>
            <h3 class='g-heading-beta'>Individual Servers</h3>
            <div class='u-margin-top form-group'>
                <table class='table table--responsive'>
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Type</td>
                        <td>Endpoint</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    function newServerItemDetail($Server) {
                        $ServerItem = array();
                        if($Server['type'] == 'ftp') :
                            $ServerItem['port'] = empty($Server['port'])    ?  21  : $Server['port'];
                            $ServerItem['pasv'] = empty($Server['passive']) ?  '' : ' (PASV)';
                            $ServerItem['endpoint'] = $Server['hostname'].':'.$ServerItem['port'].$ServerItem['pasv'];
                            $ServerItem['type'] = strtoupper($Server['type']);
                        elseif ($Server['type'] == 'ssh'):
                            $ServerItem['port'] = empty($Server['port'])    ?  22  : $Server['port'];
                            $ServerItem['endpoint'] = $Server['hostname'].':'.$ServerItem['port'];
                            $ServerItem['type'] = 'SSH/SFTP';
                        endif;

                        return $ServerItem;
                    }
                    if(empty($ServerList)):
                    ?>
                    <tr>
                        <td class='u-text-center g-text-subtle' colspan='4'>
                            You haven't added any servers yet. <a href="/servers/new/<?php echo $Project['id']; ?>">Add one now</a>.
                        </td>
                    </tr>
                    <?php
                    else :
                        foreach($ServerList as $key => $val) :
                            extract($val);
                            $ServerItem = newServerItemDetail($Server);
                    ?>
                    <tr id='server-<?php echo $Server['id']; ?>'>
                        <td class='table__label' data-column-label='Name'>
                            <a href="/servers/edit/<?php echo $Project['id']; ?>/<?php echo $Server['id']; ?>"><?php echo $Server['name']; ?></a>
                        </td>
                        <td class='table__label' data-column-label='Type'><?php echo $ServerItem['type']; ?></td>
                        <td class='table__label' data-column-label='Endpoint'><?php echo $ServerItem['endpoint']; ?></td>
                        <td class='u-text-right table__actions'>
                            <input name='server_identifier[]' type='hidden' value='<?php echo $Server['id']; ?>'>
                            <a href="/servers/edit/<?php echo $Project['id']; ?>/<?php echo $Server['id']; ?>"><img alt="Edit" class="icon" src="/img/icons/icon-pencil-c3c83e027bd471c46571ffc8a6914974.svg" /></a>
                            <a confirm="Are you sure you wish to remove this server?" data-method="delete" href="/servers/del/<?php echo $Project['id']; ?>/<?php echo $Server['id']; ?>" rel="nofollow"><img alt="Delete" class="icon" src="/img/icons/icon-trash-4d0e03bf959145d64a6c5a9905127c05.svg" /></a>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <?php
        foreach($GroupList as $key => $val) :
            extract($val);
        ?>
        <div class='box section section--skinny section--first'>
            <h3 class='g-heading-beta'><?php echo $ServerGroup['name'];?></h3>
            <div class='u-margin-top form-group'>
                <table class='table table--responsive'>
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Type</td>
                        <td>Endpoint</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($Server)) :
                        foreach($Server as $key => $val) :
                            $ServerItem = newServerItemDetail($val);
                    ?>
                    <tr id='server-<?php echo $val['id'];?>'>
                        <td class='table__label' data-column-label='Name'>
                            <a href="/servers/edit/<?php echo $Project['id'];?>/<?php echo $val['id'];?>"><?php echo $val['name'];?></a>
                        </td>
                        <td class='table__label' data-column-label='Type'><?php echo $ServerItem['type'];?></td>
                        <td class='table__label' data-column-label='Endpoint'><?php echo $ServerItem['endpoint'];?></td>
                        <td class='u-text-right table__actions'>
                            <input name='server_identifier[]' type='hidden' value='<?php echo $val['id'];?>'>
                            <a href="/servers/edit/<?php echo $Project['id'];?>/<?php echo $val['id'];?>"><img alt="Edit" class="icon" src="/img/icons/icon-pencil-c3c83e027bd471c46571ffc8a6914974.svg" /></a>
                            <a confirm="Are you sure you wish to remove this server?" data-method="delete" href="/servers/del/<?php echo $Project['id'];?>/<?php echo $val['id'];?>" rel="nofollow"><img alt="Delete" class="icon" src="/img/icons/icon-trash-4d0e03bf959145d64a6c5a9905127c05.svg" /></a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    else :
                    ?>
                    <tr>
                        <td class='u-text-center g-text-subtle' colspan='4'>
                            This group has no any server yet.
                        </td>
                    </tr>
                    <?php
                    endif;
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <?php
        endforeach;
        ?>
    </div>
    <div class='sidebar'>
        <div class='content-block'>
            <h3 class='sidebar__heading g-heading-gamma'>Automatic Deployment</h3>
            <p>You can enable automatic deployment from Github or Codebase &mdash; simply edit any server to view the appropriate hook URL.</p>
            <h3 class='sidebar__heading g-heading-gamma'>Firewall Access</h3>
            <p>To grant Deploy access to your servers, please allow the following IP ranges through your firewall:</p>
            <ul>
                <li>
                    <code>185.22.208.0/25</code>
                </li>
                <li>
                    <code>2a00:67a0:a:1::/64</code>
                </li>
            </ul>

        </div>
    </div>
