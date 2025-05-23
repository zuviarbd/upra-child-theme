<?php
/**
 * Template Name: Custom Home Template
 */
get_header(); ?>
    <div class="home mh-section mh-group -mt-[15px] mb-16">
        <!-- Hero -->

        
		<div class="bg-[#409DA4] mb-6">		
			<div class="max-w-5xl mx-auto">
				<!-- left-slider -->
				<div class="overflow-hidden relative group">
					<a href="https://upra.fr/refocus-datos/">
						<img class="w-full h-auto object-cover"
							 src="https://upra.fr/wp-content/uploads/2025/03/UPRA-Hero-Background.png" alt=""/>
					</a>
				</div>
			</div>
		</div>
		
		<!-- #Text Block -->
		
		<div class="max-w-5xl mx-auto mt-6 mb-10">
			<div>
				<p class="text-2xl tracking-wide font-medium antialiased text-justify px-6 md:px-0">
					<?php _e("Le «procès de groupe» initié par l’UPRA a obtenu un financement. Il est donc gratuit et il va démarrer début avril c’est désormais acquis! Il s’agit d’un procès en réparation de vos pertes boursières.") ?>
				</p>
				<a class="mt-2 px-12 py-4 hover:bg-[#45474B] bg-[#327A7A] block max-w-fit mx-auto text-center text-lg group overflow-hidden relative text-slate-200 active:text-slate-100 flex-grow flex items-center justify-center hover:text-slate-100" href="<?php echo esc_url( 'https://upra.fr/refocus-datos/' ); ?>" target="_self">
										
					<span class="text-xl uppercase transition-all" style="font-family: oswald,sans-serif;">
						<?php _e("Read More") ?>
					</span>
				
					<span class="transition-all ml-2 group-hover:ml-4">
						<svg class="h-6 w-6 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							 stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
						</svg>
					</span>				
				</a>				
			</div>
		</div>


        <!-- Blocks -->
        <div class="max-w-5xl mx-auto grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">

            <!--        aggregator-->
			
            <div class="rounded-lg grid grid-cols-1 gap-4">
				<div class="bg-[#45474b] rounded block">
					<div class="border-solid border-b border-slate-800">
						<h4 class="py-5 text-slate-200 text-2xl uppercase text-center tracking-wide antialiased "><?php _e("PLAINTIFFS aggregator", "mh-newsdesk"); ?></h4>
					</div>

					<div class="text-slate-200 overflow-hidden">
						<div class="min-w-full bg-[#303133]">

							<div class="flex pl-3 py-3">
								<p  class="text-2xl m-0 p-0 mr-2" style="font-family: oswald,sans-serif;"><?php _e("Nous sommes déjà :", "mh-newsdesk"); ?></p>
								<p  class="text-3xl m-0 p-0" style="font-family: oswald,sans-serif;" id="total_people"></p>
							</div>
							<hr class="block mx-auto w-20 my-1 h-1.5 bg-[#45474b] border-0" />
							<div class="flex pl-3 py-3">
								<p  class="text-2xl m-0 p-0 mr-4" style="font-family: oswald,sans-serif;"><?php _e("Actions cumulées :", "mh-newsdesk"); ?></p>
								<p  class="text-3xl m-0 p-0" style="font-family: oswald,sans-serif;" id="total_share"></p>
							</div>


						</div>
					</div>

					<!-- button -->
					<div class="flex justify-center py-3">
						<a class="group relative inline-flex items-center overflow-hidden font-bold px-8 py-3 text-gray-700 bg-[#DCFFFE] hover:bg-[#409DA4] active:text-gray-900 hover:text-slate-900" href="https://upra.fr/submit-your-data/">
							<span class="absolute -end-full transition-all group-hover:end-4">
								<svg
										class="h-5 w-5 rtl:rotate-180"
										xmlns="http://www.w3.org/2000/svg"
										fill="none"
										viewbox="0 0 24 24"
										stroke="currentColor"
								>
								<path
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M17 8l4 4m0 0l-4 4m4-4H3"
								/>
								</svg>
							</span>

							<span class="text-md font-sans uppercase transition-all group-hover:me-4">INSCRIVEZ-VOUS</span>
						</a>
					</div>

				</div>
			</div>
            <!--        end-->


            <?php $query = new WP_Query(array('post_type' => 'any', 'post__in' => array(2, 5, 12, 14, 20)));
            $args = [
                'post_type' => 'page',
                'post__in' => [10607, 10611],
                'posts_per_page' => 2,
                'orderby' => 'id',
                'order' => 'ASC'
            ];
            $the_query = new WP_Query($args);

            if ($the_query->have_posts()):
                while ($the_query->have_posts()):
                    $the_query->the_post();

                    $upra_current_post_id = get_the_ID();

                    $upra_post_permalink = get_the_permalink();


                    ?>

                    <div class="bg-[#45474B] rounded-md transition h-full">
                        <article class="overflow-hidden rounded border border-solid border-slate-300 flex flex-col h-full group">
                            <a class="overflow-hidden" href="<?php echo $upra_post_permalink; ?>">
                                <img class="h-56 w-full object-cover transition duration-300 hover:scale-105"
                                     src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
                            </a>
                            <div class="flex flex-col">
                                <a href="<?php echo $upra_post_permalink; ?>" class="py-3 text-center text-lg group relative block text-slate-200 focus:outline-none focus:ring active:text-slate-100 flex-grow flex items-center justify-center hover:text-slate-100">
									<span class="absolute -end-full transition-all group-hover:end-16">
										<svg class="h-6 w-6 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
										</svg>
									</span>
									<span class="text-xl uppercase transition-all group-hover:me-8" style="font-family: oswald,sans-serif;">
										<?php the_title(); ?>
									</span>
                                </a>
                            </div>
                        </article>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>


        </div>
		

    </div>
<?php get_footer();