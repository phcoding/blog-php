<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/21
 * Time: 11:25
 */

namespace ph\mysql;


class pagesplit
{
    public function __construct($total,$limit,$url)
    {
        $this->total = (int)$total;
        $this->limit = (int)$limit;
        $this->url = (string)$url;
        $this->pagecount = (int)ceil($total/$limit);
    }

    public function create($page=1)
    {
        $this->page = (int)$page;
?>
        <nav>
            <ul class="pagination">
                <li>
                    <a href="<?php $prev = $this->page-1;if($prev<1){$prev = 1;}echo $this->url."?page=".$prev;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for($i = 1;$i<=$this->pagecount;$i++){
                    $class = "";
                    if($this->page == $i){
                        $class = "active";
                    }
                    echo "<li class='{$class}'><a href='{$this->url}?page={$i}'>{$i}</a></li>";
                }
                ?>
                <li>
                    <a href="<?php $next = $this->page+1;if($next>$this->pagecount){$next = $this->pagecount;}echo $this->url."?page=".$next;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
<?php
    }
}
?>