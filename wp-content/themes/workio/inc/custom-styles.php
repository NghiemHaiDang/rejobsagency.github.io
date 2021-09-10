<?php
if ( !function_exists ('workio_custom_styles') ) {
	function workio_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php
				$main_font = workio_get_config('main_font');
				$main_font_family = isset($main_font['font-family']) ? $main_font['font-family'] : false;
				$main_font_size = isset($main_font['font-size']) ? $main_font['font-size'] : false;
				$main_font_weight = isset($main_font['font-weight']) ? $main_font['font-weight'] : false;
			?>
			<?php if ( $main_font_family ): ?>
				/* Main Font */
				.btn,
				body
				{
					font-family:  <?php echo '\'' . $main_font_family . '\','; ?> sans-serif;
				}
			<?php endif; ?>
			<?php if ( $main_font_size ): ?>
				/* Main Font Size */
				body
				{
					font-size: <?php echo esc_html($main_font_size); ?>;
				}
			<?php endif; ?>
			<?php if ( $main_font_weight ): ?>
				/* Main Font Weight */
				body
				{
					font-weight: <?php echo esc_html($main_font_weight); ?>;
				}
			<?php endif; ?>

			<?php
				$heading_font = workio_get_config('heading_font');
				$heading_font_family = isset($heading_font['font-family']) ? $heading_font['font-family'] : false;
				$heading_font_weight = isset($heading_font['font-weight']) ? $heading_font['font-weight'] : false;
			?>
			<?php if ( $heading_font_family ): ?>
				/* Heading Font */
				h1, h2, h3, h4, h5, h6
				{
					font-family:  <?php echo '\'' . $heading_font_family . '\','; ?> sans-serif;
				}			
			<?php endif; ?>

			<?php if ( $heading_font_weight ): ?>
				/* Heading Font Weight */
				h1, h2, h3, h4, h5, h6
				{
					font-weight: <?php echo esc_html($heading_font_weight); ?>;
				}			
			<?php endif; ?>


			<?php if ( workio_get_config('main_color') != "" ) : ?>
				/* seting background main */
				.widget-team .social > li > a:hover,.leaflet-interactive .map-popup .icon-wrapper,
				.product-block.grid .add-cart .added_to_cart::before,
				.product-block.grid:hover .add-cart .added_to_cart::before, .product-block.grid:hover .add-cart .button::before,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.pagination > span.current, .pagination > a.current, .apus-pagination > span.current, .apus-pagination > a.current,
				.post-layout .top-image .categories-name,.readmore:before,
				.employer-grid:hover .btn-action-job,.btn-action-job.btn-unfollow-employer,
				.ui-slider-horizontal .ui-slider-range,.candidate_resume_skill .progress-box .bar-fill,
				.filter-listing-form .circle-check .list-item [type="radio"]:checked + label::before,
				.pagination li > span.current, .pagination li > a.current, .apus-pagination li > span.current, .apus-pagination li > a.current,
				.widget-achievements .inner-left .verify,.filter-listing-form .button,
				.job-grid-v1 .job-tags .count-more-tags,
				.view-detail::before,.candidate-archive-layout:hover .btn-action-job,
				.candidate-archive-layout .btn-action-job[class*="added"],
				.bg-theme, .featured-urgent-label .featured, .login-form-wrapper .role-tabs, .register-form .role-tabs, .subwoo-inner .bookmark, .subwoo-inner:hover .add-cart .added_to_cart, .subwoo-inner:hover .add-cart .button
				{
					background-color: <?php echo esc_html( workio_get_config('main_color') ) ?>;
				}
				.view_all:after,
				.bg-theme{
					background-color: <?php echo esc_html( workio_get_config('main_color') ) ?> !important;
				}
				/* setting color */
				.job-grid-v1 .job-tags a:hover,.job-tags a:hover,
				.list-options-action [type="radio"]:checked + label,
				#order_review .order-total .amount, #order_review .cart-subtotal .amount,
				.woocommerce table.shop_table tbody .product-subtotal,
				.woocommerce table.shop_table tbody .order-total .woocommerce-Price-amount,
				.woocommerce-tabs.tabs-v1 .nav-tabs > li.active > a,
				.product-block.grid .add-cart .added_to_cart::before, .product-block.grid .add-cart .button::before,
				.product-categories li a:hover, .product-categories li a:active,.woocommerce div.product p.price ins, .woocommerce div.product span.price ins,.product-categories li.current-cat-parent > .count, .product-categories li.current-cat > .count, .product-categories li:hover > .count,.product-categories li.current-cat-parent > a, .product-categories li.current-cat > a, .product-categories li:hover > a,
				.detail-post .entry-tags-list a:hover, .detail-post .entry-tags-list a:focus, .detail-post .entry-tags-list a.active,
				.widget-search .btn,.top-info-blog i,.wp-block-quote::before,
				.pagination > span:hover, .pagination > a:hover, .apus-pagination > span:hover, .apus-pagination > a:hover,
				.widget_pages ul li:hover > a, .widget_nav_menu ul li:hover > a, .widget_meta ul li:hover > a, .widget_archive ul li:hover > a, .widget_recent_entries ul li:hover > a, .widget_categories ul li:hover > a,
				.tagcloud a:hover, .tagcloud a:focus, .tagcloud a.active,
				.company-items-inner:hover .letter-title,.readmore,
				.job-detail-header .btn.add-a-review:hover, .job-detail-header .button.add-a-review:hover, .candidate-detail-header .btn.add-a-review:hover, .candidate-detail-header .button.add-a-review:hover, .employer-detail-header .btn.add-a-review:hover, .employer-detail-header .button.add-a-review:hover,
				.employer-style-inner .employer-metas .open-job,
				.job-detail-header .btn.btn-download-cv:hover, .job-detail-header .button.btn-download-cv:hover, .candidate-detail-header .btn.btn-download-cv:hover, .candidate-detail-header .button.btn-download-cv:hover, .employer-detail-header .btn.btn-download-cv:hover, .employer-detail-header .button.btn-download-cv:hover,
				.job-detail-header .action [class*="candidate-shortlist"]:hover, .job-detail-header .btn-shortlist:hover, .candidate-detail-header .action [class*="candidate-shortlist"]:hover, .candidate-detail-header .btn-shortlist:hover, .employer-detail-header .action [class*="candidate-shortlist"]:hover, .employer-detail-header .btn-shortlist:hover,
				.candidate_resume_skill .progress-box .bar-fill .percent,
				.widget.widget_apus_job_employer_info .list .icon,
				.widget.widget_apus_job_employer_info .job-detail-title-employer a,.title-detail-info,
				.search_distance_wrapper .search-distance-label,.filter-listing-form .terms-list + .toggle-filter-list,
				.form-group-salary .from-to-wrapper,
				.pagination li > span:hover, .pagination li > a:hover, .apus-pagination li > span:hover, .apus-pagination li > a:hover,
				.select2-container.select2-container--default .select2-results__option[aria-selected="true"], .select2-container--default .select2-results__option[data-selected="true"],
				.select2-container.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected],
				.job-grid .employer-title a,.category-banner-inner .number,
				.job-list .employer-title a,
				.widget-testimonials .testimonials-item .job,
				.candidate-archive-layout .job-tags a:hover,
				a:focus,a:hover, .login-form-wrapper .create-account .create, .register-form .create-account .create, .megamenu .dropdown-menu li > a:hover, .megamenu .dropdown-menu li > a:focus, .megamenu .dropdown-menu li > a:active,

				.megamenu .dropdown-menu li:hover > a, .megamenu .dropdown-menu li.current-menu-item > a, .megamenu .dropdown-menu li.open > a, .megamenu .dropdown-menu li.active > a, .candidate-archive-layout .candidate-category a:focus-within, .candidate-archive-layout .candidate-category a:hover, .subwoo-inner .title, .user-job-packaged [type="radio"]:checked + label, span.featured
				{
					color: <?php echo esc_html( workio_get_config('main_color') ) ?>;
				}
				.search-wrapper-message .btn,
				.view_all,
				.text-theme {
					color: <?php echo esc_html( workio_get_config('main_color') ) ?> !important;
				}

				/* setting border color */
				.job-grid-v1 .job-tags a:hover,
				.widget-team .social > li > a:hover,.widget-search .form-control:focus,
				.woocommerce form .form-row input.input-text:hover, .woocommerce form .form-row textarea:hover,
				.woocommerce .quantity .qty,.details-product .apus-woocommerce-product-gallery-thumbs .slick-slide:hover .thumbs-inner, .details-product .apus-woocommerce-product-gallery-thumbs .slick-slide:active .thumbs-inner, .details-product .apus-woocommerce-product-gallery-thumbs .slick-slide.slick-current .thumbs-inner,
				.product-block.grid .add-cart .added_to_cart:hover::before, .product-block.grid .add-cart .button:hover::before,
				.product-block.grid .add-cart .added_to_cart::before, .product-block.grid .add-cart .button::before,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.widget-search .form-control:hover,
				.detail-post .entry-tags-list a:hover, .detail-post .entry-tags-list a:focus, .detail-post .entry-tags-list a.active,
				.tagcloud a:hover, .tagcloud a:focus, .tagcloud a.active,
				#commentform .form-control:hover,.employer-grid:hover .btn-action-job,.btn-action-job.btn-unfollow-employer,
				.my_resume_eduarea .content::before,.my_resume_eduarea .content,
				.apus-breadscrumb,.ui-slider-horizontal .ui-slider-handle,
				.pagination li > span:hover, .pagination li > a:hover, .apus-pagination li > span:hover, .apus-pagination li > a:hover,
				.pagination li > span.current, .pagination li > a.current, .apus-pagination li > span.current, .apus-pagination li > a.current,
				.job-list-container:hover,.select2-container--default.select2-container.select2-container--open .select2-selection--single,
				.candidate-archive-layout .btn-action-job[class*="added"],
				.candidate-archive-layout .job-tags a:hover,.candidate-archive-layout:hover .btn-action-job,
				input[type="text"]:hover, input[type="email"]:hover, input[type="url"]:hover, input[type="password"]:hover, input[type="search"]:hover, input[type="number"]:hover, input[type="tel"]:hover, input[type="range"]:hover, input[type="date"]:hover, input[type="month"]:hover, input[type="week"]:hover, input[type="time"]:hover, input[type="datetime"]:hover, input[type="datetime-local"]:hover, input[type="color"]:hover, textarea:hover,
				.border-theme, .candidate-list:hover, .subwoo-inner.is_featured, .subwoo-inner:hover
				{
					border-color: <?php echo esc_html( workio_get_config('main_color') ) ?>;
				}

				.subwoo-inner.is_featured .icon-wrapper {
					border-color: <?php echo esc_html( workio_get_config('main_color') ) ?> !important;
					color: <?php echo esc_html( workio_get_config('main_color') ) ?> !important;
				}
				.subwoo-inner .icon-wrapper {
					color: <?php echo esc_html( workio_get_config('main_color') ) ?> !important;
				}
				.subwoo-inner.is_featured .add-cart .button {
					background-color: <?php echo esc_html( workio_get_config('main_color') ) ?>;
				}
				.featured-urgent-label .featured:before, .subwoo-inner .bookmark:before
				{
					border-left-color: <?php echo esc_html( workio_get_config('main_color') ) ?>;
				}
				.featured-urgent-label .featured:after, .subwoo-inner .bookmark:after
				{
					border-top-color: <?php echo esc_html( workio_get_config('main_color') ) ?>;
				}
			<?php endif; ?>


			<?php if ( workio_get_config('button_color') != "" ) : ?>
				input[type="submit"],
				.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce input.button, .woocommerce button.button, .woocommerce a.button,
				.action [class*="candidate-shortlist"], .btn-shortlist,
				.candidate-alert-form .button, .job-alert-form .button,
				.widget-mailchimp button,
				.widget-mailchimp.with-icon button,
				.job-list:hover .btn-apply,
				.add-fix-top,
				.btn-theme, .top-wrapper-menu .btn.register, .box-employer form .button, .box-employer form button, .box-employer form .btn, .box-employer form input[type="button"], .box-employer form input[type="reset"], .box-employer form input[type="submit"], .btn-theme-second,
				.job-detail-header .btn.btn-added-candidate-shortlist, .job-detail-header .btn.btn-add-candidate-shortlist, .job-detail-header .button.btn-added-candidate-shortlist, .job-detail-header .button.btn-add-candidate-shortlist, .candidate-detail-header .btn.btn-added-candidate-shortlist, .candidate-detail-header .btn.btn-add-candidate-shortlist, .candidate-detail-header .button.btn-added-candidate-shortlist, .candidate-detail-header .button.btn-add-candidate-shortlist, .employer-detail-header .btn.btn-added-candidate-shortlist, .employer-detail-header .btn.btn-add-candidate-shortlist, .employer-detail-header .button.btn-added-candidate-shortlist, .employer-detail-header .button.btn-add-candidate-shortlist, .job-detail-header .btn-action-job, .candidate-detail-header .btn-action-job, .employer-detail-header .btn-action-job, .cmb-form .cmb-row[data-fieldtype="wp_job_board_file"] .upload-file-btn, .cmb-form .button-primary
				{
					border-color: <?php echo esc_html( workio_get_config('button_color') ) ?> ;
					background-color: <?php echo esc_html( workio_get_config('button_color') ) ?> ;
				}
				.btn-theme.btn-outline{
					border-color: <?php echo esc_html( workio_get_config('button_color') ) ?> ;
					color: <?php echo esc_html( workio_get_config('button_color') ) ?> ;
				}
				.btn-theme.btn-inverse{
					border-color: <?php echo esc_html( workio_get_config('button_color') ) ?> ;
					background-color: <?php echo esc_html( workio_get_config('button_color') ) ?> ;
				}
			<?php endif; ?>

			<?php if ( workio_get_config('button_hover_color') != "" ) : ?>
				/* seting background main */
				.woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce input.button:hover, .woocommerce button.button:hover, .woocommerce a.button:hover,
				.action [class*="candidate-shortlist"]:hover, .btn-shortlist:hover,
				.action [class*="candidate-shortlist"]:focus, .btn-shortlist:focus,
				input[type="submit"]:hover,
				input[type="submit"]:focus,
				.candidate-alert-form .button:hover, .job-alert-form .button:hover,
				.widget-mailchimp.with-icon button:hover,
				.widget-mailchimp.with-icon button:focus,
				.add-fix-top:hover,
				.add-fix-top:focus,
				.widget-mailchimp button:hover,
				.widget-mailchimp button:focus,
				.btn-theme:hover,
				.btn-theme:focus,
				.btn-theme.btn-outline:hover,
				.btn-theme.btn-outline:focus,
				.top-wrapper-menu .btn.register:hover,
				.top-wrapper-menu .btn.register:focus-within,
				.box-employer form .button:hover, .box-employer form button:hover, .box-employer form .btn:hover, .box-employer form input[type="button"]:hover, .box-employer form input[type="reset"]:hover, .box-employer form input[type="submit"]:hover,
				.btn-theme-second:hover,
				.btn-theme-second:focus,
				.btn-apply:hover,

				.job-detail-header .btn.btn-added-candidate-shortlist:hover, .job-detail-header .btn.btn-add-candidate-shortlist:hover, .job-detail-header .button.btn-added-candidate-shortlist:hover, .job-detail-header .button.btn-add-candidate-shortlist:hover, .candidate-detail-header .btn.btn-added-candidate-shortlist:hover, .candidate-detail-header .btn.btn-add-candidate-shortlist:hover, .candidate-detail-header .button.btn-added-candidate-shortlist:hover, .candidate-detail-header .button.btn-add-candidate-shortlist:hover, .employer-detail-header .btn.btn-added-candidate-shortlist:hover, .employer-detail-header .btn.btn-add-candidate-shortlist:hover, .employer-detail-header .button.btn-added-candidate-shortlist:hover, .employer-detail-header .button.btn-add-candidate-shortlist:hover,

				.job-detail-header .btn-action-job:hover, .candidate-detail-header .btn-action-job:hover, .employer-detail-header .btn-action-job:hover,
				.cmb-form .cmb-row[data-fieldtype="wp_job_board_file"] .upload-file-btn:hover, .cmb-form .button-primary:hover
				{
					border-color: <?php echo esc_html( workio_get_config('button_hover_color') ) ?> ;
					background-color: <?php echo esc_html( workio_get_config('button_hover_color') ) ?> ;
				}
				.btn-theme.btn-inverse:focus,
				.btn-theme.btn-inverse:hover,
				.employer-detail-description .tag-detail .job-tags a:focus-within, .job-detail-description .tag-detail .job-tags a:focus-within,
				.employer-detail-description .tag-detail .job-tags a:hover, .job-detail-description .tag-detail .job-tags a:hover, .btn-action-job.has-text:hover {
					border-color: <?php echo esc_html( workio_get_config('button_hover_color') ) ?> ;
					color: <?php echo esc_html( workio_get_config('button_hover_color') ) ?> ;
				}
			<?php endif; ?>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}