<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $description ?>" />
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?php echo $title ?>">
<meta itemprop="description" content="<?php echo $description ?>">
<meta itemprop="image" content="<?php echo $image?>">

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $title ?>">
<meta name="twitter:description" content="<?php echo $description ?>">
<meta name="twitter:creator" content="<?php bloginfo('site_title') ?>">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?php echo $image; ?>">

<!-- Schema.org markup for Facebook -->
<meta property="title" content="<?php echo $title ?>">
<meta property="og:title" content="<?php echo $title ?>">
<meta property="og:image" content="<?php echo $image ?>">
<meta property="og:type" content="article" />
<meta property="og:image:alt" content="<?php echo $title ?>">
<meta property="og:description" content="<?php echo $description ?>">