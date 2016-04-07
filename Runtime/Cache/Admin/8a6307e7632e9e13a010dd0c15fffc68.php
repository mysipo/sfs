<?php if (!defined('THINK_PATH')) exit(); if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>     
    <span> 
      <form action="<?php echo U('edit');?>" method="post" >         
        <i class="fa fa-table fa-fw"></i>&nbsp;&nbsp;<?php echo ($list["title"]); ?>
        <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>"> 
      </form>
    </span>    
    <a title="添加子分类" href="<?php echo U('add?pid='.$list['id']);?>" class="add-sub-cate" >添加</a>     
    <a title="编辑" href="<?php echo U('edit?id='.$list['id'].'&pid='.$list['pid']);?>">编辑</a>
    <a title="<?php echo (show_status_op($list["status"])); ?>" href="<?php echo U('setStatus?ids='.$list['id'].'&status='.abs(1-$list['status']));?>" class="ajax-get"><?php echo (show_status_op($list["status"])); ?></a>
    <a title="删除" href="<?php echo U('remove?id='.$list['id']);?>" class="confirm ajax-get">删除</a>
    <a title="移动" href="<?php echo U('operate?type=move&from='.$list['id']);?>">移动</a>
    <a title="合并" href="<?php echo U('operate?type=merge&from='.$list['id']);?>">合并</a>    
    <?php if(!empty($list['_'])): ?><ul>
      <?php echo R('Category/tree', array($list['_']));?> 
    </ul><?php endif; ?>
</li><?php endforeach; endif; else: echo "" ;endif; ?>