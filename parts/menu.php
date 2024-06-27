
 <?php

$list = [
    ['id' => "list-home-list", 'href' => 'list-home', "active" => true, "topic" => "當季優惠"],
    ['id' => "list-profile-list", 'href' => 'Bob', "active" => false, "topic" => "熱銷商品"],
    ['id' => "list-messages-list", 'href' => 'Sally', "active" => false, "topic" => "熱銷品牌"],
    ['id' => "list-settings-list", 'href' => 'Sally', "active" => false, "topic" => "絕佳好評"],
    ['id' => "list-messages-list", 'href' => 'Sally', "active" => false, "topic" => "特價中"],
    ['id' => "list-messages-list", 'href' => 'Sally', "active" => false, "topic" => "評論"],
];
?>
<div class="row">
  <div class="w-200">
    <div class="list-group" id="list-tab" role="tablist">
        <?php
for ($i = 0; $i < count($list); $i++) {
    ?>
      <a class="list-group-item list-group-item-action <?=$list[$i]["active"] ? "active" : ""?> id="<?=$list[$i]['id']?>" data-bs-toggle="list" href="#<?=$list[$i]["href"]?>" role="tab" aria-controls="<?=$list[$i]["href"]?>"><?=$list[$i]["topic"]?></a>
    <?php
}?>
    </div>
  </div>
  <div class="col">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">    <div class="carsoul">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://picsum.photos/2000/600?grayscale" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://picsum.photos/2000/600?grayscale" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://picsum.photos/2000/600?grayscale" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    </div>
  </div>
</div>
