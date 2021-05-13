<!-- <h2 class="mt-3">後端管理頁面</h2> 
<div class="d-flex">
    <div>-<a href="./admin.php">商品列表</a> | <a href="./new.php">商品新增</a> | <a href="./category.php">商品分類新增</a></div>
    <a class="ml-auto " href="./logout.php">登出</a>
</div>
<hr style="margin-bottom:2px;"> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">後台管理</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./admin.php">商品列表 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./new.php">商品新增</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./category.php" >商品分類新增</a>
      </li>
    </ul>
  </div>
  <a class="ml-auto text-white mr-5" href="./logout.php">登出</a>
</nav>