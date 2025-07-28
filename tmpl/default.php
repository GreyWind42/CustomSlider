<?php defined('_JEXEC') or die;

use Joomla\CMS\WebAsset\WebAssetManager;
use Joomla\CMS\Factory;

// Bootstrap laden (falls im Template nicht enthalten)
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseScript(
    'bootstrap.bundle.cdn',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
    [],
    ['defer' => true, 'crossorigin' => 'anonymous']
);

$defaultHeading     = $params->get("heading", "h2");
$defaultHeadingSize = $params->get("headingSize", "1rem");
$defaultDescSize    = $params->get("descSize", "1rem");
$showArrows = (bool) $params->get('showArrows', 1);
$carouselFade = (bool) $params->get('carouselFade', 0);
$interval   = (int) $params->get('interval', 5000);

$paramsArray = [];

for ($i = 1; $i <= 5; $i++) {
    $img = $params->get("image$i");
    if ($img) {
        $paramsArray[] = [
            'image'        => $img,
            'title'        => $params->get("title$i"),
            'desc'         => $params->get("desc$i"),
            'captionClass' => $params->get("captionClass$i", 'carousel-caption d-none d-md-block'),
            'link'         => $params->get("link$i"),
            'heading'      => $defaultHeading,
            'headingSize'  => $defaultHeadingSize,
            'descSize'     => $defaultDescSize
        ];
    }
}

?>
<div id="customSlider" class="carousel slide <?php echo $carouselFade ? ' carousel-fade' : ''; ?>" data-bs-ride="carousel" data-bs-interval="<?php echo $interval; ?>">
  <div class="carousel-inner">
    <?php foreach ($paramsArray as $index => $item): ?>
    <div class="carousel-item<?php echo $index === 0 ? ' active' : ''; ?>">
      <img src="<?php echo $item['image']; ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($item['title']); ?>">
      <div class="<?php echo htmlspecialchars($item['captionClass']); ?>">
        <<?php echo $item['heading']; ?> style="font-size: <?php echo htmlspecialchars($item['headingSize']); ?>;">
          <?php echo htmlspecialchars($item['title']); ?>
        </<?php echo $item['heading']; ?>>
        <p style="font-size: <?php echo htmlspecialchars($item['descSize']); ?>;">
          <?php echo htmlspecialchars($item['desc']); ?>
        </p>
        <?php if ($item['link']): ?>
          <!-- Optional: Link einbauen -->
          <a href="<?php echo htmlspecialchars($item['link']); ?>" class="stretched-link"></a>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

<?php if ($showArrows): ?>
  <button class="carousel-control-prev" type="button" data-bs-target="#customSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#customSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
<?php endif; ?>
</div>

