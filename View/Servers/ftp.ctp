<?php
/**
 * 使用cakephp2的扩展视图概念
 */
$this->extend('/Elements/servers/typeForm');
$this->start('typeFormContent');
?>
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
<?php
$this->end();
?>
