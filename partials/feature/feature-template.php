<?php
function renderArticle($data, $pageName, $allowed_pages)
{
	ob_start();
?>

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
							<img src="<?php echo $section['image_path']; ?>" srcset="<?= preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $section['image_path']); ?>, <?= $section['image_path']; ?>" alt="<?= !empty($section['title']) ? $section['title'] : preg_replace('/^.*\/([^\/]+)\.\w+$/', '$1', $section['image_path']); ?>" <?php echo false ? ' loading="lazy" fetchpriority="low" decoding="async"' : ''; ?>>
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
