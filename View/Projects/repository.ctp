    <div class='section section--first box'>
        <div class='page-header'>
            <h2 class='page-header__title g-heading-alpha'>Configure Repository Details</h2>
            <p class='page-header__lead'>Every project in deploy needs to be linked to a source repository. This is the location where your source code will be taken from when deploying to your servers.</p>
        </div>
    </div>
    <div class='content--constrained js-repo-type is-git-repo'>
        <div class='box section section--first section--skinny'>
            <form accept-charset="UTF-8" action="/projects/repository/<?php echo $this->request->params['pass'][0];?>" class="new_repository" id="new_repository" method="post">
                <div style="display:none"><input name="utf8" type="hidden" value="&#x2713;" />
                    <input name="authenticity_token" type="hidden" value="eHFDo2ox5SIJoFdbv2EUUGZ98RJTvUtxxObbL0kstNU=" />
                </div>
                <div class='js-repo-manual-details is-git-repo'>
                    <h3 class='form-heading g-heading-gamma'>Repository Type</h3>
                    <div class='form-group'>
                        <div class='radio-block radio-block--no-label'>
                            <label class="radio-block__group radio-block__group--full" for="scm_type_git">
                                <input checked="checked" class="radio-block__input js-scm-type" id="scm_type_git" name="repository[scm_type]" type="radio" value="git" />
                                <span>Git</span>
                            </label>
                            <label class="radio-block__group radio-block__group--full" for="scm_type_subversion"><input class="radio-block__input js-scm-type" id="scm_type_subversion" name="repository[scm_type]" type="radio" value="subversion" disabled />
                                <span>Subversion</span>
                            </label>
                            <label class="radio-block__group radio-block__group--full" for="scm_type_mercurial"><input class="radio-block__input js-scm-type" id="scm_type_mercurial" name="repository[scm_type]" type="radio" value="mercurial" disabled />
                                <span>Mercurial</span>
                            </label>
                        </div>
                    </div>
                    <hr class='form-separator'>
                    <div class='form-group'>
                        <label class="form-label" for="repository_url">Full URL to repository</label>
                        <input class="form-control js-repo-url" id="repository_url" name="repository[url]" type="text" />
                    </div>
                    <div class='form-group is-related-git is-related-mercurial'>
                        <label class="form-label" for="repository_port">Custom repository port (if required)</label>
                        <input class="form-control" id="repository_port" name="repository[port]" type="text" />
                    </div>
                    <div class='form-group is-related-git is-related-mercurial'>
                        <label class="form-label" for="repository_branch">Default branch you wish to deploy from?</label>
                        <input class="form-control" id="repository_branch" name="repository[branch]" type="text" />
                    </div>
                    <div class='form-group js-auth-requirement-http is-hidden'>
                        <div class='form-group'>
                            <label class="form-label" for="repository_username">Username</label>
                            <input class="form-control" id="repository_username" name="repository[username]" type="text" />
                        </div>
                        <div class='form-group'>
                            <label class="form-label" for="repository_password">Password</label>
                            <input class="form-control" id="repository_password" name="repository[password]" type="password" />
                            <p class='form-hint'>Username/Password for HTTP only.</p>
                        </div>
                    </div>
                    <div class='form-group js-auth-requirement-ssh'>
                        <label class="form-label" for="deploy_generated_public">Use this public key and add it to your repository server&#39;s authorized keys:</label>
                        <textarea class='textarea textarea--snippet' id='deploy_generated_public' readonly>ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEAqAnIAiQItqPoPvAREpdhQICT1yTFckVZ3FbejlY433FCtpcy618kpUhQhrTluC0GmB6fQ57cJbrFZt5H0nAidVqS8mv0eqeqpKyO3ggmYZeO+0nlu948Rv32UYCiDRBtgsyiZqgpJOSIJIGioLTfeMv/ojYOukJGu4LhXXMPGiltYU1Zykp2e0tWXzU0MX5duQ45DAuKn6ED2TL63SGGbm1TAQSIP959jHStkXL9GWF5etd207IULSGtjw0jV+CrvmDMIMsMpIRY80N9eNmy5uwvqmtM61EMWmaHgLmP7bKJ1RxGKqprQUb+TdwYiQA6Lm8kbRS+fQx17thn42oBTQ==</textarea>
                    </div>
                    <div class='form-group'>
                        <button class="button button--positive u-margin-top" name="button" type="submit">Save Repository Details</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <div class='sidebar content-block'>
        <h3 class='sidebar__heading g-heading-gamma'>Public Key</h3>
        <p>If you connect to your repository using SSH, you'll need to upload this project's Deploy public key to it.</p>
        <p><a class="button button--default js-public-key" href="/projects/public_key/<?php echo $this->request->params['pass'][0];?>">View Public Key</a></p>
    </div>
