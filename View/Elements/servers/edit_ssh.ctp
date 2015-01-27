<div class='section section--first section--skinny box'>
    <h3 class='form-heading form-heading--spaced g-heading-beta'>SSH Server Configuration</h3>
    <input id="server_host_key" name="server[id]" type="hidden" value="<?php echo $Server['id'];?>" />
    <div class='form-group'>
        <label class="form-label" for="server_hostname">Hostname</label>
        <input class="form-control" id="server_hostname" name="server[hostname]" type="text" value="<?php echo $Server['hostname'];?>" />
    </div>
    <div class='form-group'>
        <label class="form-label" for="server_port">Port</label>
        <input class="form-control" id="server_port" name="server[port]" type="text" value="<?php echo $Server['port']; ?>" />
        <p class='form-hint'>Leave blank to use default (port 22).</p>
    </div>
    <div class='form-group'>
        <label class="form-label" for="server_username">Username</label>
        <input class="form-control" id="server_username" name="server[username]" type="text" value="<?php echo $Server['username']; ?>" />
        <p class='form-hint'>
            In the interests of security we do not recommend you deploy with your root user.
        </p>
    </div>
    <div class='form-group'>
        <label class="form-label" for="server_password">Password</label>
        <input class="form-control" id="server_password" name="server[password]" type="password" />
    </div>
    <div class='form-group'>
        <label class="form-checkbox" for="server_use_ssh_keys">
            <input name="server[use_ssh_keys]" type="hidden" value="<?php echo $Server['use_ssh_keys']; ?>" />
            <input class="form-checkbox__input" id="server_use_ssh_keys" name="server[use_ssh_keys]" type="checkbox" value="<?php echo $Server['use_ssh_keys']; ?>" />
            <span class='form-checkbox__text'>Use SSH key rather than password for authentication</span>
        </label>
        <p class='form-hint'>
            If enabled, leave the password field blank &mdash; it will not be used.
            You can find the appropriate public key to put on your server <a class="js-view-public-key" href="/projects/deepphpoop/public_key">here</a>.
        </p>
    </div>
    <div class='form-group'>
        <label class="form-label" for="server_server_path">Deployment Path</label>
        <input class="form-control" id="server_server_path" name="server[server_path]" type="text" value="" />
        <p class='form-hint'>Where on the server should your files be placed (for example, <strong>public_html/</strong> or <strong>/absolute/path/here</strong>).</p>
    </div>
</div>