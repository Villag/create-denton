<?php $user_info = get_userdata( $user->ID ); ?>

<section class="card span3">
	<!--- Photo with Caption --->
	<figure class="vcard" id="vcard-lastfirst-<?php echo $user->ID ?>"
	 itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Person/"
	 title="Firstname Lastname">
		<!-- Photo -->
		<?php echo get_avatar( $user->ID, '96', $user->display_name ); ?>
		<!-- alt redundant; image labeled by context, leave empty (webaim) -->
		<!-- Caption -->
		<figcaption>
			<!-- Profile -->
			<section class="profile">
				<!-- Name -->
				<header class="n" title="Name">
					<span class="fn" itemprop="name">
						<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
						<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
					</span> <!--/ .fn -->
				</header> <!--/ .n -->
				<!-- Location -->
				<address class="adr" itemprop="address" title="Location"
				 itemscope="itemscope" itemtype="http://data-vocabulary.org/Address/">
					<!-- Zip --><abbr class="postal-code" itemprop="postal-code" title="32303-9329">32312</abbr>
					<!-- Lat/Lon (Metadata) -->
				</address> <!--/ .adr -->
				<!-- Contact -->
				<a href="mailto:<?php echo $user->user_email ?>" class="email"><?php echo $user->user_email ?></a>
				<ul itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Organization/">
					<li class="tel"><abbr class="type" title="work">Office:</abbr> <abbr class="value" itemprop="tel" title="+1##########">(###) ###-####</abbr></li>
				</ul>
			</section> <!--/ .profile -->
			<!-- Links -->
			<section class="note">
				<ul>
					<li><a href="http://www.facebook.com/" class="url" itemprop="url" rel="me self external">facebook.com</a></li>
				</ul>
			</section>
		</figcaption> <!--/ .figcaption -->
	</figure> <!--/ .figure.vcard -->

	<!-- Biography -->
	<section title="Biography">
		<header>
			Biography
		</header>
		<p><?php echo $user_info->user_description; ?></p>
		<section>
			<header>
				Skills
			</header>
			<ul>
				<li><a href="glossary.html#tag" rel="tag">photoshop</a></li>
				<li><a href="glossary.html#tag" rel="tag">web design</a></li>
			</ul>
		</section>
	</section> <!--/ .note -->

</section>