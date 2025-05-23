<?php
/**
 * Template Name: Stock Data Collection
 */

get_header(); ?>
<div class="mh-section mh-group">
	<div id="main-content" class="mh-content" role="main" itemprop="mainContentOfPage"><?php

		while (have_posts()) : the_post();
			get_template_part('content', 'page');
			comments_template();
		endwhile; ?>

            <main id="primary" class="md:col-span-4 lead-card p-6">
                <div class="form-container max-w-xl mx-auto" style="font-family: Helvetica, Arial, sans-serif !important;">
                    <!--OTP Form-->
                    <form action="" method="POST" id="send_data" name="send_data">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="name" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Your Name', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
                                    <input type="text" 
                                    name="name" 
                                    style="width:100%;"
                                    id="name" 
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6"
                                    placeholder="Your Name (Required)" required>
                                </div>
                            </div> 

                            <div class="col-span-full">
                                <label for="email" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Email address', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
                                    <input type="email" 
                                    id="email" 
                                    style="width:100%;"
                                    name="email" 
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6"
                                    placeholder="Your Email Address (Required)" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <div class="mt-2">
                                    <label for="phone" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Mobile Phone', 'mh-newsdesk' ) ?></label>
                                    <input type="text"
                                    name="phone"
                                    id="phone"
                                    style="width:100%;"
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6" placeholder="Mobile Phone (Required)" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="stock" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Nombre d&apos;actions détenues', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
                                    <input type="text"
                                    name="stock"
                                    id="stock"
                                    style="width:100%;"
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6" placeholder="Nombre d'actions détenues (Required)" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="purchase" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Buy Price', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
                                    <input type="text"
                                    name="purchase"
                                    id="purchase"
                                    style="width:100%;"
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6" placeholder="Buy Price (Required)" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="sell" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Sell Price', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
                                    <input type="text"
                                    name="sell"
                                    id="sell"
                                    style="width:100%;"
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6" placeholder="Sell Price (Required)" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="loss" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Perte Totale', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
                                    <input type="text"
                                    name="loss"
                                    id="loss"
                                    style="width:100%;"
                                    class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6" placeholder="Perte Totale" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="remarks" class="block text-lg font-medium leading-6 text-gray-900"><?php _e( 'Remarques', 'mh-newsdesk' ) ?></label>
                                <div class="mt-2">
									<textarea placeholder="Remarques" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-2 ring-gray-100 placeholder:text-gray-400 focus:ring-2 focus:ring-gray-300 sm:text-lg sm:leading-6"
											  id="remarks" 
											  name="remarks" 
											  rows="4" 
											  cols="50"></textarea>
                                </div>
                            </div>
							
                            <div class="col-span-full">
                                <h4 id="error_title" class="bg-red-100 red-500 px-4 py-2 hidden"></h4>
                                <h4 id="duplicate_data" class="bg-red-100 red-500 px-4 py-2 hidden"></h4>
                                <ul id="no_values" class="bg-red-100"></ul>
                                <ul id="error_message" class="bg-red-100"></ul>
                            </div>

                            <div class="col-span-full">
                                <button type="submit" form="send_data" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg sm:w-auto px-5 py-2.5 text-center"><?php _e( 'Submit', 'mh-newsdesk' ) ?></button>
                            </div>

                        </div>
                    </form>

                    <div id="data_container" class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <p id="success_message" class="bg-green-100 green-500 px-4 py-2 hidden"></p>
                        </div>
                    </div>

                </div>

            </main><!-- #main -->
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();