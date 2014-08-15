<?php
$a = (int) $_GET['a'];
print $this->getMsg();
?>
<div class="assman_canvas_inner">
    <h2 class="assman_cmp_heading" id="assman_pagetitle"><?php print $data['pagetitle']; ?></h2>
</div>

<div class="x-panel-body panel-desc x-panel-body-noheader x-panel-body-noborder"><p><?php print $data['subtitle']; ?></p></div>

<div class="assman_canvas_inner">

<div class="clearfix">

    <!--span class="button btn assman-btn pull-left" onclick="javascript:paint('fieldcreate');">Add Asset</span-->

        <div class="pull-right">   
            <form action="<?php print static::page('assets'); ?>" method="post">
                <input type="text" name="searchterm" placeholder="<?php print $data['btn.search']; ?>..." value="<?php print $data['searchterm']; ?>"/>    
                <input type="submit" class="button btn assman-btn" value="<?php print $data['btn.search']; ?>"/>
                <a href="<?php print static::page('assets'); ?>" class="btn"><?php print $data['btn.showall']; ?></a>
            </form>
            
        </div>
   </div>     

<?php if ($data['results']): ?>
<table class="classy">
    <thead>
        <tr>
            <th>
                <?php print $this->modx->lexicon('assman.lbl.thumbnail'); ?>
            </th>
            <th>
                <?php print $this->modx->lexicon('assman.lbl.title'); ?>
            </th>
            <th>
                <?php print $this->modx->lexicon('assman.lbl.alt'); ?>
            </th>
            <th>
                <?php print $this->modx->lexicon('assman.lbl.size'); ?>
            </th>
            <th><?php print $this->modx->lexicon('assman.lbl.action'); ?></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($data['results'] as $r) :?>
    <tr>
        <td><?php 
            //print $r->get('path'); 
            print $this->modx->runSnippet('Asset', array('asset_id'=>$r->get('asset_id'),'width'=>$this->modx->getOption('assman.thumbnail_width'),'tpl'=>'<img src="[[+url]]" width="'.$this->modx->getOption('assman.thumbnail_width').'" height="[[+asset_id.height]]" />'));
            ?>
        </td>
        <td><?php print $r->get('title'); ?></td>
        <td><?php print $r->get('alt'); ?></td>
        <td><?php print $r->get('size'); ?>
        </td>
        <td>
            <span class="button btn" onclick="javascript:paint('assetedit',{asset_id:<?php print $r->get('asset_id'); ?>});"><?php print $data['btn.edit']; ?></span>
            <span class="button btn" onclick="javascript:mapi('asset','delete',{asset_id:<?php print $r->get('asset_id'); ?>},'assets');"><?php print $data['btn.delete']; ?></span>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>

    <div class="danger"><?php print $this->modx->lexicon('assman.no_results'); ?></div>

<?php endif; ?>

<?php 
// Pagination : see the get_data function in the controllers/store/upudate.class.php
$offset = (int) (isset($_GET['offset'])) ? $_GET['offset'] : 0;
$results_per_page = (int) $this->modx->getOption('assman.default_per_page','',$this->modx->getOption('default_per_page'));
print \Pagination\Pager::links($data['count'], $offset, $results_per_page)
    ->setBaseUrl($data['baseurl']);
?>
</div>