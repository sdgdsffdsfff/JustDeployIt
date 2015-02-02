<div class='box section section--first section--skinny'>
    <div class='preview-section'>
        <div class='preview-section__header'>
            <h4 class='g-heading-gamma'>From Revision:</h4>
        </div>
        <?php
        if(empty($startRevisionInfo)):
        ?>
        <div class='preview-section__content'>
            <p>Start of time…</p>
        </div>
        <?php
        else:
        ?>
        <div class='preview-section__content'>
            <p><a class="commit-link" href="<?php echo substr($Repository['url'], 0, strrpos($Repository['url'], '.git')); ?>/commit/<?php $startRevisionInfo['ref'];?>" rel="external" title="<?php $startRevisionInfo['ref'];?>"><?php $startRevisionInfo['ref'];?></a></p>
        </div>
        <div class='preview-section__content'>
            <p><?php $startRevisionInfo['message'];?></p>
        </div>
        <div class='preview-section__footer'>
            <p><?php $startRevisionInfo['author'];?>, <?php $startRevisionInfo['timestamp'];?></p>
        </div>
        <?php
        endif;
        ?>
    </div>
    <div class='preview-section'>
        <div class='preview-section__header'>
            <h4 class='g-heading-gamma'>To Revision:</h4>
        </div>
        <div class='preview-section__content'>
            <p><a class="commit-link" href="<?php echo substr($Repository['url'], 0, strrpos($Repository['url'], '.git')); ?>/commit/<?php echo $endRevisionInfo['ref'];?>" rel="external" title="<?php echo $endRevisionInfo['ref'];?>"><?php echo $endRevisionInfo['ref'];?></a></p>
        </div>
        <div class='preview-section__content'>
            <p><?php echo $endRevisionInfo['message'];?></p>
        </div>
        <div class='preview-section__footer'>
            <p><?php echo $endRevisionInfo['author'];?>, <?php echo $endRevisionInfo['timestamp'];?></p>
        </div>
    </div>
    <div class='content-block u-margin-top'>
        <h4 class='g-heading-gamma'>Servers</h4>
        <?php
        foreach($ServerList as $server) :
        ?>
        <p><?php echo $server['name'];?></p>
        <?php
        endforeach;
        ?>
        <h4 class='g-heading-gamma'>Repository</h4>
        <p class='u-text-break'><?php echo $Repository['url'];?></p>
    </div>
</div>
<?php
foreach($ServerList as $server) :
?>
<div class='box section section--first section--skinny'>
    <h2 class='g-heading-beta'><?php echo $server['name'];?></h2>
    <p class='form-paragraph text--small text--italic g-text-subtle'>(<?php echo $server['username'].'@'.$server['hostname'];?>)</p>
    <h3 class='g-heading-gamma'>Main Repository</h3>
    <div class='preview-section u-margin-top'>
        <div class='preview-section__header'>
            <h4 class='g-heading-gamma'>To be uploaded…</h4>
        </div>
        <table class='table'>
            <tbody></tbody>
            <tr>
                <td>
                    <li>README.md</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>UnitTest/charpter03Test/DomainObjectTest.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>UnitTest/charpter03Test/ShopProductTest.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/BookProduct.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/CdProduct.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/DomainObject.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/ShopProduct.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/ShopProductWriter.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/TextProductWriter.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/XmlProductWriter.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/conf.php</li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>charpter03/main.php</li>
                </td>
            </tr>
        </table>
    </div>
    <div class='preview-section'>
        <div class='preview-section__header'>
            <h4 class='g-heading-gamma'>To be removed…</h4>
        </div>
        <table class='table'>
            <tbody>
            <tr>
                <td class='u-text-center g-text-subtle'>
                    No files will be removed in this deployment.
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class='preview-section'>
        <div class='preview-section__header'>
            <h4 class='g-heading-gamma'>Configuration files to be uploaded…</h4>
        </div>
        <table class='table'>
            <tbody>
            <tr>
                <td class='u-text-center g-text-subtle'>No config files will be uploaded in this deployment.</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
endforeach;
?>
