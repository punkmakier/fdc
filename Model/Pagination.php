<?php
class Pagination
{
    //class by skmcoder
    private $host = "localhost";
    //database username
    private $username = "root";
    //database password
    private $password = "";
    //database name
    private $database = "fdc";
    /* table name  */
    private $table;
    /* Page name */
    private $page;
    /* where */
    private $where;
    /* Number of items per page */
    private $limit = 5;
    /* The number of items to display on the page */
    private $number_show;
    /* Determine the number of links in the middle */
    private $links_between;
    /* Link variables in the link ex &&id=10 */
    private $url_vars;
    public  function __construct($table, $page, $limit = null, $links_between = null, $url_vars = null,  $where = null)
    {
        $this->url_vars      = $url_vars;
        $this->links_between = $links_between;
        $this->table         = $table;
        $this->page          = $page;
        $this->where         = $where;
        if (isset($limit)) {
            $this->limit = $limit;
        }
        /* Check the pages in the link */
        $this->page_get();
    }
    public function connect()
    {
        $con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        mysqli_set_charset($con, "utf8");
        if (!$con) {
            echo "No contact";
        } else {
            echo "";
        }
        return $con;
    }
    private function  page_get()
    {
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            if ($page == 0 || $page < 1) {
                $this->number_show = 0;
            } else {
                $this->number_show = ($page * $this->limit) - $this->limit;
            }
        } else {
            $this->number_show = 0;
        }
    }
    public  function  prev()
    {
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        if (!isset($page) || $page == '' || $page < 1) {
            $page = 1;
        }
        if ($page > 1) {
            $mins = $page - 1;
            $prev_btn = " <li class='page-item'>" . "<a class='page-link' href=$this->page?page=1 >First</a>" . "</li>
            <li class='page-item'>" . "<a class='page-link' href=$this->page?page=$mins$this->url_vars   >&laquo;</a>" . "</li>";
          
            return $prev_btn;
        }
    }
    private function  next($rowsperpage)
    {
        if (isset($_GET['page']) and $_GET['page'] != '') {
            $page = (int)$_GET['page'];
        }
        if (!isset($page) || $page == '' || $page < 1 || $page > $rowsperpage) {
            $page = 1;
        }
        if ($page + 1 <= $rowsperpage) {
            $pos      = $page + 1;
            $next_btn = " <li class='page-item'>" . "<a class='page-link' href=$this->page?page=$pos$this->url_vars  >&raquo;</a>" . "</li>
            <li class='page-item'>" . "<a class='page-link' href=$this->page?page=$rowsperpage  >Last</a>" . "</li>";
            return $next_btn;
        }
    }
    private function  links($current_page, $total_pages, $url)
    {
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        // your current page
        // $pages=20; // Total number of pages
        if (!isset($page) || $page == '' || $page < 1 || $page > $current_page) {
            $page = 1;
        }
        if ($this->links_between != '') {
            $limit = $this->links_between;
        } else {
            $limit = 5;  /* The number of pages that appear in the middle of the page count */
        }
        $links = "";
        if ($total_pages >= 1 && $current_page <= $total_pages) {
            if ($page == 1) {
                $links .= "
                <li class = 'page-item active'>
                <a  class = 'page-link' href = \"{$url}?page=1$this->url_vars \">1</a>
                </li>";
            } else {
                $links .= "
                <li class = 'page-item'>
                <a  class = 'page-link' href = \"{$url}?page=1$this->url_vars \">1</a>
                </li>";
            }
            $i = max(2, $current_page - $limit);
            if ($i > 2)
                $links .= "              <li  class='page-item'> 
                <a class = 'page-link'>...</a>
                </li> ";
            for (; $i < min($current_page + $limit + 1, $total_pages); $i++) {
                if ($i == @$page) {
                    $links .= "
                    <li class = 'page-item active'>
                    <a  class = 'page-link' href = \"{$url}?page={$i}$this->url_vars \">{$i}</a>
                    </li>
    ";
                } else {
                    $links .= "
                    <li class = 'page-item'>
                    <a  class = 'page-link' href = \"{$url}?page={$i}$this->url_vars \">{$i}</a>
                    </li>
                    ";
                }
            }
            if ($i != $total_pages)
                $links .= "     <li  class='page-item'>    <a class='page-link'>...</a></li> ";
            if ($page == $total_pages) {
                $links .= "
                    <li class = 'page-item active'>
                    <a  class = 'page-link' href = \"{$url}?page={$total_pages}$this->url_vars \">{$total_pages}</a>
                    </li>
                    ";
            } else {
                $links .= "
                    <li class = 'page-item'>
                    <a  class = 'page-link' href = \"{$url}?page={$total_pages}$this->url_vars \">{$total_pages}</a>
                    </li>
                    ";
            }
        }
        return $links;
    }
    public  function  paginate_links()
    {
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        $conn = $this->connect();
        /* The number of items in the table */
        $count_items = "SELECT COUNT(*) from $this->table $this->where ";
        /* Query the number of items in the table */
        $excecute_pagination = mysqli_query($conn, $count_items);
        $row_pagination      = mysqli_fetch_array($excecute_pagination);
        if (!$row_pagination) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        /*all classes*/
        $total_rows = array_shift($row_pagination);
        /*Number of links per page per page*/
        $rowsperpage = $total_rows / $this->limit;
        $rowsperpage = ceil($rowsperpage);
        if (!isset($page) || $page == '' || $page < 1 || $page > $rowsperpage) {
            $page = 1;
        }
?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page >= 1) {
                ?>
                    <!--prec btn --> <?php echo  $this->prev(); ?>
                    <?php   /*  echo $this->links($rowsperpage);  */
                    echo $this->links($page, $rowsperpage, $this->page);
                    ?>
                    <!--next btn --><?php echo $this->next($rowsperpage);
                                }  ?>
        </nav>
<?php
    }
    public  function  getData()
    {
        $conn  = $this->connect();
        $query = "SELECT * FROM $this->table   $this->where   LIMIT $this->number_show,$this->limit";
        $q = mysqli_query($conn, $query);
        if ($q == false) {
            return false;
        }
        $rows = array();
        if(mysqli_num_rows($q) > 0){
            while ($row = mysqli_fetch_array($q)) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return "No data";
        }

        
    }
};
?>