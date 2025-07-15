<?php
function renderArticle($data, $pageName, $allowed_pages)
{
	$site_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
	$breadcrumbs = [
		[
			'name' => 'Home',
			'url' => $site_url,
			'position' => 1
		],
		[
			'name' => 'Features',
			'url' => $site_url . 'features.php',
			'position' => 2
		],
		[
			'name' => ucwords($pageName),
			'url' => $site_url . 'features/feature?page=' . $pageName,
			'position' => 3
		]
	];

	ob_start();
?>
	<div class="js-feature-header fx-row box fx-wrap f-s-12 relative feature-header">
		<nav class="relative breadcrumbs" aria-label="Breadcrumb">
			<ul class="fx-row fx-wrap f-600" itemscope itemtype="https://schema.org/BreadcrumbList">
				<?php foreach ($breadcrumbs as $index => $crumb): ?>
					<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<?php if ($index < count($breadcrumbs) - 1): ?>
							<a itemprop="item" href="<?php echo htmlspecialchars($crumb['url']); ?>">
								<span itemprop="name"><?php echo htmlspecialchars($crumb['name']); ?></span>
							</a>
						<?php else: ?>
							<span class="js-current-nav fx-row fx-center current" itemprop="name">
								<?php echo htmlspecialchars($crumb['name']); ?>
								<span class="svg-wrapper">
									<svg class="icon" width="10" height="5" viewBox="0 0 10 5" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.75 0L4.875 3.125L8 0L9.25 0.625L4.875 5L0.5 0.625L1.75 0Z" />
									</svg>
								</span>
							</span>
						<?php endif; ?>
						<meta itemprop="position" content="<?php echo $crumb['position']; ?>" />
					</li>
					<?php if ($index < count($breadcrumbs) - 1) echo '<span>/</span>'; ?>
				<?php endforeach; ?>
			</ul>
		</nav>

		<nav class="fx-column fx-wrap f-500 feature-nav">
			<?php $current_index = array_search($pageName, $allowed_pages); ?>

			<a href="javascript:void(0)" class="js-feature-prev svg-wrapper feature-nav__prev<?php echo $current_index === 0 ? ' disabled' : ''; ?>" data-page="<?php echo $current_index > 0 ? $allowed_pages[$current_index - 1] : ''; ?>">
				<svg width="22" height="8" viewBox="0 0 22 8" xmlns="http://www.w3.org/2000/svg" class="icon">
					<path d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM22 4V4.5H1V4V3.5H22V4Z" />
				</svg>
			</a>

			<?php foreach ($allowed_pages as $page) {
				$active = ($page === $pageName) ? ' active' : '';
				echo "<a href='feature.php?page=$page' class='js-feature-nav feature-nav-item$active' data-page='$page'>" . ucwords(str_replace('-', ' ', $page)) . "</a>";
			} ?>

			<a href="javascript:void(0)" class="js-feature-next svg-wrapper feature-nav__next<?php echo $current_index === count($allowed_pages) - 1 ? ' disabled' : ''; ?>" data-page="<?php echo $current_index < count($allowed_pages) - 1 ? $allowed_pages[$current_index + 1] : ''; ?>">
				<svg width="22" height="8" viewBox="0 0 22 8" xmlns="http://www.w3.org/2000/svg" class="icon">
					<path d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM22 4V4.5H1V4V3.5H22V4Z" />
				</svg>
			</a>
		</nav>
	</div>


	<?php if (!empty($data['page'])) : ?>
		<div class="fx-column box features__item feature__intro">

			<div class="fx-column gap-30 features__item-content feature__intro-content">
				<?php if (!empty($data['page']['title'])) : ?>
					<?php $tag = isset($_GET['json']) && $_GET['json'] === 'true' ? 'h2' : 'h1'; ?>
					<<?= $tag; ?> class="h1 f-700 txt-alt-gray title"><?= $data['page']['title']; ?></<?= $tag; ?>>
				<?php endif; ?>

				<?php if (!empty($data['page']['intro'])) : ?>
					<p class="txt-alt-gray f-500 p text"><?= $data['page']['intro']; ?></p>
				<?php endif; ?>
			</div>

			<?php if (!empty($data['page']['image_path'])) : ?>
				<div class="relative features__item-img feature__intro-img">
					<img src="<?php echo $data['page']['image_path']; ?>" srcset="<?= preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $data['page']['image_path']); ?>, <?= $data['page']['image_path']; ?>" alt="<?= !empty($data['page']['title']) ? $data['page']['title'] : preg_replace('/^.*\/([^\/]+)\.\w+$/', '$1', $data['page']['image_path']); ?>" <?php echo $tag == 'h2' ? 'loading="lazy" fetchpriority="low" decoding="async"' : 'loading="eager" fetchpriority="high" decoding="sync"'; ?>>
				</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>


	<?php if (!empty($data['sections'])) : ?>
		<div class="fx-column feature__section-wrap">
			<?php foreach ($data['sections'] as $section) : ?>
				<div class="fx-column fx-center feature__section">

					<div class="fx-column gap-10 feature__section-content">
						<?php if (!empty($section['title'])) : ?>
							<h3 class="h2 f-700 txt-alt-gray title"><?= $section['title']; ?></h3>
						<?php endif; ?>

						<?php if (!empty($section['what_it_is'])) : ?>
							<p class="lead-text f-600 subtitle"><?= $section['what_it_is']; ?></p>
						<?php endif; ?>

						<?php if (!empty($section['why_it_matters'])) : ?>
							<p class="txt-alt-gray p f-500 text"><?= $section['why_it_matters']; ?></p>
						<?php endif; ?>
					</div>

					<?php if (!empty($section['image_path'])) : ?>
						<div class="relative feature__section-img">
							<img src="<?php echo $section['image_path']; ?>" srcset="<?= preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $section['image_path']); ?>, <?= $section['image_path']; ?>" alt="<?= !empty($section['title']) ? $section['title'] : preg_replace('/^.*\/([^\/]+)\.\w+$/', '$1', $section['image_path']); ?>"<?php echo false ? ' loading="lazy" fetchpriority="low" decoding="async"' : ''; ?>>
						</div>
					<?php endif; ?>

				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>


	<?php if (!empty($data['use_case'])) : ?>
		<div class="box fx-column feature__use_case">

			<div class="fx-column gap-20 feature__use_case-content">
				<span class="f-s-12 f-600 txt-white label">Use Case</span>

				<?php if (!empty($data['use_case']['title'])) : ?>
					<h3 class="h2 txt-black title"><?= $data['use_case']['title']; ?></h3>
				<?php endif; ?>

				<?php if (!empty($data['use_case']['text'])) : ?>
					<p class="p txt-gray text"><?= $data['use_case']['text']; ?></p>
				<?php endif; ?>

				<?php if (!empty($data['use_case']['link'])) : ?>
					<a href="<?= $data['use_case']['link']['url']; ?>" class="f-700 f-s-14 text-blue link"><?= $data['use_case']['link']['text']; ?></a>
				<?php endif; ?>
			</div>

			<?php if (!empty($data['use_case']['image_path'])) : ?>
				<div class="feature__use_case-img">
					<img src="<?php echo $data['use_case']['image_path']; ?>" srcset="<?= preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $data['use_case']['image_path']); ?>, <?= $data['use_case']['image_path']; ?>" alt="<?= !empty($data['use_case']['title']) ? $data['use_case']['title'] : preg_replace('/^.*\/([^\/]+)\.\w+$/', '$1', $data['use_case']['image_path']); ?>" loading="lazy" fetchpriority="low" decoding="async">
				</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>

	<?php if (!empty($data['cta'])) : ?>
		<div class="box fx-column fx-center text-align-center gap-30 feature__cta">
			<div class="fx-column fx-center gap-10">
				<?php if (!empty($data['cta']['title'])) : ?>
					<div class="h2 txt-black f-700"><?= $data['cta']['title']; ?></div>
				<?php endif; ?>

				<?php if (!empty($data['cta']['subtitle'])) : ?>
					<div class="f-500 lead-text"><?= $data['cta']['subtitle']; ?></div>
				<?php endif; ?>
			</div>

			<div class="fx-row fx-center gap-30 fx-wrap buttons-wrapper">
				<?php if (!empty($data['cta']['buttons']['explore'])) : ?>
					<a href="<?= $data['cta']['buttons']['explore']['link']; ?>" class="f-s-12 button button-bordered"><?= $data['cta']['buttons']['explore']['text']; ?></a>
				<?php endif; ?>

				<?php if (!empty($data['cta']['buttons']['start'])) : ?>
					<a href="<?= $data['cta']['buttons']['start']['link']; ?>" class="button button-blue"><?= $data['cta']['buttons']['start']['text']; ?></a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

<?php
	return ob_get_clean();
}
