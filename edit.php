  <?php
    require_once('./checkSession.php'); //引入登入判斷
    require_once('./db.inc.php'); //引用資料庫連線

    ?>
  <!DOCTYPYE html>
      <html>

      <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
          <title>我的 PHP 程式</title>
          <style>
              .border {
                  border: 1px #aaaaff solid;
                  text-align: center;
              }

              .w200px {
                  width: 100px;
              }

              .whitewordcolor {
                  background-color: #1E90FF;
                  color: #ffffff;
              }
          </style>
      </head>

      <body>
        <?php
        require_once("./templates/titles.php")
        ?>
          <div class="container-fluid">
              <div class="pt-5">
                  <h3>商品編輯</h3>
                  <form action="./update.php" name="myForm" method="POST" enctype="multipart/form-data">
                      <table class="border">
                          <thead class="whitewordcolor">
                              <tr>
                                  <th class="border">商品名稱</th>
                                  <th class="border">商品分類</th>
                                  <th class="border">商品照片路徑</th>
                                  <th class="border">商品價格</th>
                                  <th class="border">商品數量</th>
                                  <th class="border">新增時間</th>
                                  <th class="border">更新時間</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                $sql = "SELECT `i`.`id`,`i`.`aucClass`,`i`.`aucName`,`i`.`aucQty`,`i`.`aucDes`,`i`.`aucId`,`i`.`aucPriceStart`,`i`.`aucPriceNow`,`i`.`aucImg`,`i`.`created_at`,`i`.`updated_at`,`categories`.`categoryId`, `categories`.`categoryName`
                                FROM `auctionitems` AS `i` INNER JOIN `categories`
                                ON `i`.`aucClass` = `categories`.`categoryId`
                                WHERE `id` = ? ";
                                $arrParam = [
                                    (int)$_GET['id']
                                ];
                                //查詢
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute($arrParam);
                                //資料數量大於 0，則列出相關資料
                                if ($stmt->rowCount() > 0) {
                                    $arr = $stmt->fetchAll()[0];
                                ?>
                                  <tr>
                                      <!-- 商品名稱 -->
                                      <td class="border">
                                          <input type="text" name="aucName" value="<?php echo $arr['aucName'] ?>" maxlength="100" />
                                      </td>
                                      <!-- 商品分類 -->
                                      <td class="border">
                                          <select name="itemCategoryId">
                                              <option value="<?php echo $arr['categoryId']; ?>"><?php echo $arr['categoryName'] ?></option>
                                              <?php
                                                //顯示所有商品種類
                                                $catsql = "SELECT `categoryId`, `categoryName` FROM `categories` ";
                                                $stmt = $pdo->query($catsql);
                                                if ($stmt->rowCount() > 0) {
                                                    $catarr = $stmt->fetchAll();
                                                    for ($i = 0; $i < count($catarr); $i++) {
                                                ?>
                                                      <option value="<?php echo $catarr[$i]['categoryId'] ?>"><?php echo $catarr[$i]['categoryName'] ?></option>
                                              <?php
                                                    }
                                                }
                                                ?>
                                          </select>
                                      </td>
                                      <!-- 商品圖片 -->
                                      <td class="border">
                                          <img class="itemImg w200px" src="./images/items/<?php echo $arr['aucImg'] ?>" /><br />
                                          <input type="file" name="aucImg" value="" />
                                      </td>
                                      <!-- 商品價格 -->
                                      <td class="border">
                                          <input type="text" name="aucPriceStart" value="<?php echo $arr['aucPriceStart'] ?>" maxlength="11" />
                                      </td>
                                      <!-- 商品數量 -->
                                      <td class="border">
                                          <input type="text" name="aucQty" value="<?php echo $arr['aucQty'] ?>" maxlength="3" />
                                      </td>
                                      <td class="border"><?php echo $arr['created_at'] ?></td>
                                      <td class="border"><?php echo $arr['updated_at'] ?></td>
                                  </tr>
                              <?php
                                } else {
                                ?>
                                  <tr>
                                      <td colspan="7">沒有資料</td>
                                  </tr>
                              <?php
                                }
                                ?>
                          </tbody>
                      </table>
                      <input type="hidden" name="id" value="<?php echo (int)$_GET['id']; ?>">
                      <td class="border" colspan="7"><input type="submit" name="smb" value="更新"></td>
                  </form>
              </div>
          </div>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>

      </html>