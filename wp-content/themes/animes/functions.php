<?php

/***********************************************************************************************/
/* 	Define Constants */
/***********************************************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT.'/images');
define('THEMEDOMAIN','animes-framework');

/***********************************************************************************************/
/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */


add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video', 'chat' ));
	
add_theme_support('post-thumbnails', array('post','personajes','animes'));

set_post_thumbnail_size(210, 210, true);
add_image_size('custom-blog-image', 120,74);
add_image_size('custom-blog-image-medium', 9999, 242);
add_image_size('custom-blog-image-large', 9999, 244);
add_image_size('custom-blog-image-small', 9999,67);

add_theme_support('automatic-feed-links');

/***********************************************************************************************/
/* Localization Support */
/***********************************************************************************************/
function custom_theme_localization() 
{
	$lang_dir = THEMEROOT . '/lang';
	load_theme_textdomain(THEMEDOMAIN, $lang_dir);
}

add_action('after_theme_setup', 'custom_theme_localization');

/******************************	***************************************************/
/* Register Custom Post Type  */
/**********************************************************************************/

/*Registrar tipo de post anime*/
function anime_create_post_type(){
	
	$labels = array(
		'name' 				 => __('Animes', THEMEDOMAIN ),
		'singular_name' 	 => __('Anime',THEMEDOMAIN),
		'add_new'			 => __('Nuevo Anime', THEMEDOMAIN),
		'add_new_item' 		 => __('Agregar nuevo anime',THEMEDOMAIN),
		'edit_item'          => __( 'Editar anime', THEMEDOMAIN ),
    	'new_item'           => __( 'Nuevo anime', THEMEDOMAIN ),
    	'view_item'          => __( 'Ver anime', THEMEDOMAIN ),
    	'search_items'       => __( 'Buscar anime', THEMEDOMAIN ),
    	'not_found'          => __( 'Anime no encontrado', THEMEDOMAIN ),
    	'not_found_in_trash' => __( 'Anime no encontrado en la papelera', THEMEDOMAIN ),
	);
	$args = array(   
	    'has_archive'  => true,
	    'hierarchical' => false,
	    'labels'       => $labels,
	    'menu_icon'    => 'dashicons-screenoptions',
	    'public'       => true,
	    'supports'     => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
	    'taxonomies'   => array( 'post_tag', 'category'),
	);
	
	register_post_type( 'animes', $args );
	
	/*Registrar personaje*/
	$labels2 = array(
		'name' 				 => __('Personajes', THEMEDOMAIN ),
		'singular_name' 	 => __('Personaje',THEMEDOMAIN),
		'add_new'			 => __('Nuevo personaje', THEMEDOMAIN),
		'add_new_item' 		 => __('Agregar nuevo personaje',THEMEDOMAIN),
		'edit_item'          => __( 'Editar personaje', THEMEDOMAIN ),
    	'new_item'           => __( 'Nuevo personaje', THEMEDOMAIN ),
    	'view_item'          => __( 'Ver personaje', THEMEDOMAIN ),
    	'search_items'       => __( 'Buscar personaje', THEMEDOMAIN ),
    	'not_found'          => __( 'personaje no encontrado', THEMEDOMAIN ),
    	'not_found_in_trash' => __( 'personaje no encontrado en la papelera', THEMEDOMAIN ),
	);
	$args2 = array(
	    'has_archive'  => true,
	    'hierarchical' => false,
	    'labels'       => $labels2,
	    'menu_icon'    => 'dashicons-admin-users	',
	    'public'       => true,
	    'supports'     => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
	    'taxonomies'   => array( 'post_tag', 'category'),
	);

	register_post_type( 'personajes', $args2 );
	flush_rewrite_rules();
	
}

add_action( 'init', 'anime_create_post_type' );


/***************** CREAR METABOX DE SELECT PARA SELECCIONAR ANIME ************************/

add_action( 'add_meta_boxes', 'cd_mb_anime_add' );

function cd_mb_anime_add() {
  add_meta_box( 'mb-anime-id', 'Seleccionar Anime: ', 'cd_mb_anime_cb', 'personajes', 'side', 'default' );
}

function cd_mb_anime_cb( $post ) {
  $values = get_post_custom( $post->ID );

  /*$check = isset( $values['mb_genre'] ) ? esc_attr( $values['mb_genre'][0] ) : '';*/

  $selected = isset( $values['my_meta_box_anime_select'] ) ? esc_attr( $values['my_meta_box_anime_select'][0] ) : '';

  wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>
  <!--p>
    <label for="my_meta_box_text">Text Label</label>
    <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php //echo $text; ?>" />
  </p-->

  <!-- Traer todos los post para el tipo Anime -->
  <?php  
  	$args = array(
  		'post_type'      => 'animes',
  		'posts_per_page' => -1
  	);

  	$animes_array = get_posts($args);
  ?>

  <p>
     <label for="my_meta_box_anime_select">Anime:</label>
     <select name="my_meta_box_anime_select" id="my_meta_box_anime_select">
        <?php  foreach ( $animes_array as $anime ) : ?>
            <option value="<?php echo $anime->post_name ?>" <?php selected( $selected, $anime->post_name ); ?> >
               <?php echo $anime->post_title ?>
            </option>
        <?php endforeach; ?>
     </select>
  </p>
  <!--p>
    <input type="checkbox" name="mb_subfeatured" id="mb_subfeatured" <?php checked( $check, 'on' ); ?> />
    <label for="mb_subfeatured">Artículo Subdestacado?</label>
  </p-->
<?php
}

add_action( 'save_post', 'cd_mb_anime_save' );

function cd_mb_anime_save( $post_id ) {
  global $post;

  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_post', $post->ID ) ) return;

  // now we can actually save the data
  $allowed = array(
      'a'     =>  array( // on allow a tags
        'href'  =>  array() // and those anchords can only have href attribute
    )
  );

  // Probably a good idea to make sure your data is set
  /*if( isset( $_POST['my_meta_box_text'] ) )
    update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );*/

   if( isset( $_POST['my_meta_box_anime_select'] ) )
      update_post_meta( $post_id, 'my_meta_box_anime_select', esc_attr( $_POST['my_meta_box_anime_select'] ) );

  // This is purely my personal preference for saving checkboxes

  /*$chk = ( isset( $_POST['mb_subfeatured'] ) && $_POST['mb_subfeatured'] ) ? 'on' : 'off';
  update_post_meta( $post_id, 'mb_subfeatured', $chk );*/

}



/***************** CREAR METABOX DE GENERO  ************************/

add_action( 'add_meta_boxes', 'cd_mb_genre_add' );

function cd_mb_genre_add() {
  add_meta_box( 'mb-genre-id', 'Seleccionar Género: ', 'cd_mb_genre_cb', 'personajes', 'side', 'default' );
}

function cd_mb_genre_cb( $post ) {
  $values = get_post_custom( $post->ID );

  /*$check = isset( $values['mb_genre'] ) ? esc_attr( $values['mb_genre'][0] ) : '';*/

  $selected = isset( $values['my_meta_box_genre_select'] ) ? esc_attr( $values['my_meta_box_genre_select'][0] ) : '';

  wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>
  <!--p>
    <label for="my_meta_box_text">Text Label</label>
    <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php //echo $text; ?>" />
  </p-->

  <p>
     <label for="my_meta_box_genre_select">Género:</label>
     <select name="my_meta_box_genre_select" id="my_meta_box_genre_select">
       <option value="m" <?php selected( $selected, 'm' ); ?>>Masculino</option>
       <option value="f" <?php selected( $selected, 'f' ); ?>>Femenino</option>
       <option value="a" <?php selected( $selected, 'a' ); ?>>Alien</option>
     </select>
  </p>
  <!--p>
    <input type="checkbox" name="mb_subfeatured" id="mb_subfeatured" <?php checked( $check, 'on' ); ?> />
    <label for="mb_subfeatured">Artículo Subdestacado?</label>
  </p-->
<?php
}

add_action( 'save_post', 'cd_mb_genre_save' );

function cd_mb_genre_save( $post_id ) {
  global $post;

  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_post', $post->ID ) ) return;

  // now we can actually save the data
  $allowed = array(
      'a'     =>  array( // on allow a tags
        'href'  =>  array() // and those anchords can only have href attribute
    )
  );

  // Probably a good idea to make sure your data is set
  /*if( isset( $_POST['my_meta_box_text'] ) )
    update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );*/

   if( isset( $_POST['my_meta_box_genre_select'] ) )
   update_post_meta( $post_id, 'my_meta_box_genre_select', esc_attr( $_POST['my_meta_box_genre_select'] ) );

  // This is purely my personal preference for saving checkboxes

  /*$chk = ( isset( $_POST['mb_subfeatured'] ) && $_POST['mb_subfeatured'] ) ? 'on' : 'off';
  update_post_meta( $post_id, 'mb_subfeatured', $chk );*/

}