<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/21
 * Time: 0:12
 */
$articles = $mysql->get("select * from `article`");
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="index.php" style="color: #eee;">博客文章栏</a>
    </div>
    <div class="panel-footer">博客总数：<?php echo count($articles);?></div>
</div>
<?php
foreach ($articles as $article) {
    echo "<div class='panel panel-success'>";
    echo "<div class='panel-heading'>";
    echo "<a href='blog.php?atid={$article['atid']}'>{$article['title']}</a>";
    echo "<span class='pull-right small'>作者：".$article['author']." 创作时间".date("Y-m-d/H:i:s",$article['time'])."</span>";
    echo "</div>";
    echo "<div class='panel-body'>";
    echo substr(strip_tags($article['content']),0, 160)."...";
    echo "</div>";
    echo "</div>";
}
?>