<form accept-charset="UTF-8" action="/servers/index/<?php echo $Server['project_id']; ?>" autocomplete="off" class="new_server" id="new_server" method="post">
    <div style="display:none"><input name="utf8" type="hidden" value="&#x2713;" />
        <input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" />
    </div>
    <div class='section section--first section--skinny box'>
        <h3 class='form-heading form-heading--spaced g-heading-beta'>Choose Protocol</h3>
        <div class='form-group'>
            <label class="form-label" for="server_name">Name</label>
            <input class="form-control" id="server_name" name="server[name]" type="text" />
        </div>
        <div class='form-group'>
            <label class="form-label" for="server_type">Protocol</label>
            <div class='form-select'>
                <select id="server_type" name="server[type]"><option value="">Select Protocol</option>
                    <option value="Servers::Ssh">SSH/SFTP</option>
                    <option selected="selected" value="Servers::Ftp">FTP</option>
            </div>
        </div>
    </div>
    <div class='js-protocol-container'>
        <div class='section section--first section--skinny box'>
            <h3 class='form-heading form-heading--spaced g-heading-beta'>FTP Server Configuration</h3>
            <div class='form-group'>
                <label class="form-label" for="server_hostname">Hostname</label>
                <input class="form-control" id="server_hostname" name="server[hostname]" type="text" />
            </div>
            <div class='form-group'>
                <label class="form-label" for="server_port">Port</label>
                <input class="form-control" id="server_port" name="server[port]" type="text" />
                <p class='form-hint'>Leave blank to use default (21).</p>
            </div>
            <div class='form-group'>
                <label class="form-label" for="server_username">Username</label>
                <input class="form-control" id="server_username" name="server[username]" type="text" />
                <p class='form-hint form-hint--warning is-hidden'>
                    In the interests of security we do not recommend you deploy with your root user.
                </p>
            </div>
            <div class='form-group'>
                <label class="form-label" for="server_password">Password</label>
                <input class="form-control" id="server_password" name="server[password]" type="password" />
            </div>
            <div class='form-group'>
                <label class="form-checkbox" for="server_passive"><input name="server[passive]" type="hidden" value="0" />
                    <input class="form-checkbox__input" id="server_passive" name="server[passive]" type="checkbox" value="1" />
                    <span class='form-checkbox__text'>Use passive (PASV) mode</span>
                </label>
                <p class='form-hint'>Using passive (PASV) mode may be helpful if you're having firewall issues with your server.</p>
            </div>
            <div class='form-group'>
                <label class="form-checkbox" for="server_force_hidden_files"><input name="server[force_hidden_files]" type="hidden" value="0" />
                    <input class="form-checkbox__input" id="server_force_hidden_files" name="server[force_hidden_files]" type="checkbox" value="1" />
                    <span class='form-checkbox__text'>Force the server to report hidden files</span>
                </label>
                <p class='form-hint'>
                    Some FTP servers do not report hidden files like <code>.gitignore</code> by default.
                    Check this box if yours does not report hidden files.
                </p>
            </div>
            <div class='form-group'>
                <label class="form-label" for="server_server_path">Deployment Path</label>
                <input class="form-control" id="server_server_path" name="server[server_path]" type="text" />
                <p class='form-hint'>Where on the server should your files be placed (for example, <strong>public_html/</strong> or <strong>/absolute/path/here</strong>).</p>
            </div>
        </div>

    </div>
    <div class='section section--first section--skinny box'>
        <h3 class='form-heading form-heading--spaced g-heading-beta'>Server Group</h3>
        <div class='form-group'>
            <label class="form-label" for="server_server_group">Server Group</label>
            <div class='form-select'>
                <select id="server_server_group_identifier" name="server[server_group_identifier]">
                    <option value="">Individual Servers</option>
                    <?php
                    if(isset($ServerGroup)):
                        foreach($ServerGroup as $key => $val):
                            ?>
                            <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <p class='form-hint'>
                Select a group that this server will belong to. This server will then be deployed
                simultaniously with the other servers in the group.
                <a class="js-manage-server-groups" href="/server_groups/index/<?php echo $Server['project_id']; ?>">Manage Server Groups</a>.
            </p>
        </div>
    </div>
    <div class='section section--first section--skinny box js-deployment-options'>
        <h3 class='form-heading form-heading--spaced g-heading-beta'>Deployment Options</h3>
        <div class='form-group'>
            <label class="form-label" for="server_notification_email">Notification email address</label>
            <input class="form-control" id="server_notification_email" name="server[notification_email]" type="text" />
            <p class='form-hint'>Leave blank to use project notification address.</p>
        </div>
        <div class='form-group'>
            <label class="form-label" for="server_branch">Branch to deploy from</label>
            <div class='form-select'>
                <select id="server_branch" name="server[branch]">
                    <option value="">Project default (<?php echo $Repository['branch'];?>)</option>
                    <?php foreach($Repository['branches'] as $ky => $val) : ?>
                        <option value="<?php echo $val;?>"><?php echo $val;?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class='form-group'>
            <label class="form-label" for="server_environment">Environment</label>
            <input class="form-control" id="server_environment" name="server[environment]" type="text" />
            <p class='form-hint'>Production, Testing, Development etc. can be substituted into SSH commands.</p>
        </div>
        <div class='form-group'>
            <label class="form-label" for="server_root_path">Subdirectory to deploy from</label>
            <input class="form-control" id="server_root_path" name="server[root_path]" type="text" />
            <p class='form-hint'>
                The subdirectory in your repository that you wish to deploy.
                Leave blank to use the default specified in the project.
            </p>
        </div>
    </div>
    <div class='form-submit'>
        <button class="button button--positive" name="button" type="submit">Save</button>
    </div>
</form>
