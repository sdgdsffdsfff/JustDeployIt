<div class='page-header'>
    <h2 class='page-header__title g-heading-beta'>Choose a commit&hellip;</h2>
    <p class='text--micro'>
        <span class="text--subtle">&hellip;or</span>
        <a class="text--semibold text--info text--link js-switch-to-manual" href="#">enter commit manually</a>.
    </p>
</div>
<table class='table commit-selector u-margin-top js-commit-table'>
    <thead>
    <tr>
        <td class='commit-selector__commit commit-selector__commit--radiobox'></td>
        <td class='commit-selector__commit commit-selector__commit--ref'>Commit</td>
        <td class='commit-selector__commit commit-selector__commit--message'>Message</td>
        <td class='commit-selector__commit commit-selector__commit--date'>Timestamp</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($GitLog as  $key => $log):
        $checked = false;
        if($this->request->query['selected'] == $log['commit']) :
            $checked = true;
        elseif(empty($this->request->query['selected']) && $this->request->query['beginningOfTime'] == 'true' && count($GitLog) == $key + 1) :
            $checked = true;
        endif;
    ?>
    <tr data-author='<?php echo $log['Author']; ?>' data-message='<?php echo $log['message']; ?>' data-ref='<?php echo $log['commit']; ?>' data-short-message='<?php echo $log['message']; ?>' data-timestamp='<?php echo $log['CommitDate']; ?>'>
        <td class='commit-selector__commit commit-selector__commit--radiobox'>
            <input <?php  if($checked) echo 'checked="checked"'; ?> id="<?php echo $log['commit']; ?>" name="commit" type="radio" value="<?php echo $log['commit']; ?>" />
        </td>
        <td class='commit-selector__commit commit-selector__commit--ref'><?php echo substr($log['commit'], 0, 8); ?></td>
        <td class='commit-selector__commit commit-selector__commit--message'><?php echo $log['message']; ?></td>
        <td class='commit-selector__commit commit-selector__commit--date'><?php echo strftime('%d %b %H:%M', strtotime($log['message'])); ?></td>
    </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>
<div class='js-commit-manual is-hidden'>
    <p class='form-paragraph'>Enter the commit reference you wish to deploy from below. We'll then check we can find our commit and fetch the details.</p>
    <input class="form-control" id="commit_ref" name="commit_ref" type="text" value="" />
</div>
<div class='u-margin-top clearfix u-margin-bottom'>
    <div class='u-float-left'>
        <label class="form-checkbox form-checkbox--small">
            <input class="form-checkbox__input js-beginning-of-time" id="beginning_of_time" name="beginning_of_time" type="checkbox" value="1" />
            <span class='text--micro form-checkbox__text'>Deploy the entire repository</span>
        </label>
    </div>
    <div class='u-float-right'>
        <button class="button button--small button--positive js-select-commit" name="button" type="submit">Select Commit</button>
        <button class="button button--small js-close-dialog" name="button" type="submit">Close</button>
    </div>
</div>
