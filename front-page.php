<?php
/**
 * Controls the front page output.
 */

// Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

//
add_action( 'genesis_loop', 'prefix_do_front_page_loop' );
function prefix_do_front_page_loop() {
	?>
	<article class="home-section">
		<div class="wrap">
			<h3 style="text-align:center;">Banner or something pretty here</h3>
		</div>
	</article>

	<article class="home-section">
		<div class="wrap">
			<div class="one-third first">
				<h3>Heading 3</h3>
				<p>Suspendisse blandit semper euismod. Suspendisse sed ligula ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
			</div>
			<div class="one-third">
				<h3>Heading 3</h3>
				<p>Suspendisse blandit semper euismod. Suspendisse sed ligula ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
			</div>
			<div class="one-third">
				<h3>Heading 3</h3>
				<p>Suspendisse blandit semper euismod. Suspendisse sed ligula ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
			</div>
		</div>
	</article>

	<article class="home-section">
		<div class="wrap">
			<h2>Home Two Section</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
		</div>
	</article>

	<article class="home-section">
		<div class="wrap">
			<h2>Home Three Section</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
		</div>
	</article>

	<article class="home-section">
		<div class="wrap">
			<h2>Home Four Section</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
		</div>
	</article>
	<?php
}

// Run the Genesis loop
genesis();
