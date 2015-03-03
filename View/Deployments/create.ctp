    <div class='section section--first box'>
        <div class='page-header'>
            <h2 class='page-header__title g-heading-alpha'>Preview Deployment</h2>
            <p class='page-header__lead'>
                The information below shows what would happen if you ran this deployment.
                If you're happy with this, just press 'Run Deployment' below otherwise press 'Go back to make changes' to make changes.
            </p>
        </div>
    </div>
    <div class='loading-block js-preview-loading'>
        <div class='section--first u-text-center'>
            <div class='first-project'>
                <img alt="Spinner Icon" class="large-icon u-margin-bottom" src="/img/icons/icon-spinner-b9e57ecb8e4afe0ea243a5a9cc699630.svg" />
                <div class='g-heading-gamma'>Please wait while your preview is generated&hellip;</div>
            </div>
        </div>
    </div>
    <div class='section section--first section--skinny box js-preview-container'>
        <h3 class='form-heading g-heading-beta'>Ready to go?</h3>
        <p class='form-paragraph'>
            If you're happy with the information outlined above, just hit the "Run Deployment" button or click "Go back to make changes" to make changes. Once you have approved the deployment you will not be able to cancel it through this system.
        </p>
        <form accept-charset="UTF-8" action="/deployments/act/<?php echo $Project['id'];?>" class="new_deployment" id="new_deployment" method="post">
            <div style="display:none">
                <input name="utf8" type="hidden" value="&#x2713;" />
                <input name="authenticity_token" type="hidden" value="4KixzdUUL2+E/WLOW6xvPIK5ydNR5egmlK76+SB1KKk=" />
            </div>
            <input id="deployment_start_revision" name="deployment[start_revision]" type="hidden" value="<?php echo $this->request->data['deployment']['start_revision']; ?>" />
            <input id="deployment_end_revision" name="deployment[end_revision]" type="hidden" value="<?php echo $this->request->data['deployment']['end_revision']; ?>" />
            <input id="deployment_server_id" name="deployment[server_id]" type="hidden" />
            <input id="deployment_parent_identifier" name="deployment[parent_identifier]" type="hidden" value="<?php echo $this->request->data['deployment']['parent_identifier']; ?>" />
            <input id="deployment_copy_config_files" name="deployment[copy_config_files]" type="hidden" value="<?php echo $this->request->data['deployment']['copy_config_files']; ?>" />
            <input id="deployment_email_notify" name="deployment[email_notify]" type="hidden" value="<?php echo $this->request->data['deployment']['email_notify']; ?>" />
            <input id="deployment_branch" name="deployment[branch]" type="hidden" value="<?php echo $this->request->data['deployment']['branch']; ?>" />
            <button class="button button--positive u-margin-right" name="submit" type="submit">Run Deployment</button>
            <button class="button" name="edit" type="submit">Make Changes</button>
        </form>

    </div>
