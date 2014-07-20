<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		// Avada edit
        //Register sidebar options for blog/portfolio/woocommerce category/archive pages
        global $wp_registered_sidebars;
        $sidebar_options[] = 'None';
        for($i=0;$i<1;$i++){
            $sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
            //var_dump($sidebars);
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $sidebar){
                    $sidebar_options[] = $sidebar['name'];
                }
            }
            $sidebars = sidebar_generator::get_sidebars();
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $key => $value){
                    $sidebar_options[] = $value;
                }
            }
        }
        // End Avada edit

		//Access the WordPress Categories via an Array
		$of_categories 		= array();
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");

		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");

		//Testing
		$of_options_select 	= array("one","two","three","four","five");
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

		// Begin Avada edit
		// Social Icon default order
		$of_options_social_links_ordering = array
		(
			"default" => array (
				'facebook' => 'Facebook',
				'flickr' => 'Flickr',
				'rss' => 'RSS',
				'twitter' => 'Twitter',
				'vimeo' => 'Vimeo',
				'youtube' => 'Youtube',
				'instagram' => 'Instagram',
				'pinterest' => 'Pinerest',
				'tumblr' => 'Tumblr',
				'google' => 'Googleplus',
				'dribbble' => 'Dribble',
				'digg' => 'Digg',
				'linkedin' => 'LinkedIn',
				'blogger' => 'Blogger',
				'skype' => 'Skype',
				'forrst' => 'Forrst',
				'myspace' => 'Myspace',
				'deviantart' => 'Deviantart',
				'yahoo' => 'Yahoo',
				'reddit' => 'Reddit',
				'paypal' => 'Paypal',
				'dropbox' => 'Dropbox',
				'soundcloud' => 'Soundcloud',
				'vk' => 'VK',
			),
			"custom" => array (
			),
		);
		// End Avada edit


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) )
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
		    {
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) {
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }
		    }
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

// Avada Edit

        $font_sizes = array(
            '10' => '10',
            '11' => '11',
            '12' => '12',
            '13' => '13',
            '14' => '14',
            '15' => '15',
            '16' => '16',
            '17' => '17',
            '18' => '18',
            '19' => '19',
            '20' => '20',
            '21' => '21',
            '22' => '22',
            '23' => '23',
            '24' => '24',
            '25' => '25',
            '26' => '26',
            '27' => '27',
            '28' => '28',
            '29' => '29',
            '30' => '30',
            '31' => '31',
            '32' => '32',
            '33' => '33',
            '34' => '34',
            '35' => '35',
            '36' => '36',
            '37' => '37',
            '38' => '38',
            '39' => '39',
            '40' => '40',
            '41' => '41',
            '42' => '42',
            '43' => '43',
            '44' => '44',
            '45' => '45',
            '46' => '46',
            '47' => '47',
            '48' => '48',
            '49' => '49',
            '50' => '50',
        );

        $google_fonts = array(
            "Select Font" => "Select Font",
            "ABeeZee" => "ABeeZee",
            "Abel" => "Abel",
            "Abril Fatface" => "Abril Fatface",
            "Aclonica" => "Aclonica",
            "Acme" => "Acme",
            "Actor" => "Actor",
            "Adamina" => "Adamina",
            "Advent Pro" => "Advent Pro",
            "Aguafina Script" => "Aguafina Script",
            "Akronim" => "Akronim",
            "Aladin" => "Aladin",
            "Aldrich" => "Aldrich",
            "Alef" => "Alef",
            "Alegreya" => "Alegreya",
            "Alegreya SC" => "Alegreya SC",
            "Alegreya Sans" => "Alegreya Sans",
            "Alegreya Sans SC" => "Alegreya Sans SC",
            "Alex Brush" => "Alex Brush",
            "Alfa Slab One" => "Alfa Slab One",
            "Alice" => "Alice",
            "Alike" => "Alike",
            "Alike Angular" => "Alike Angular",
            "Allan" => "Allan",
            "Allerta" => "Allerta",
            "Allerta Stencil" => "Allerta Stencil",
            "Allura" => "Allura",
            "Almendra" => "Almendra",
            "Almendra Display" => "Almendra Display",
            "Almendra SC" => "Almendra SC",
            "Amarante" => "Amarante",
            "Amaranth" => "Amaranth",
            "Amatic SC" => "Amatic SC",
            "Amethysta" => "Amethysta",
            "Anaheim" => "Anaheim",
            "Andada" => "Andada",
            "Andika" => "Andika",
            "Angkor" => "Angkor",
            "Annie Use Your Telescope" => "Annie Use Your Telescope",
            "Anonymous Pro" => "Anonymous Pro",
            "Antic" => "Antic",
            "Antic Didone" => "Antic Didone",
            "Antic Slab" => "Antic Slab",
            "Anton" => "Anton",
            "Arapey" => "Arapey",
            "Arbutus" => "Arbutus",
            "Arbutus Slab" => "Arbutus Slab",
            "Architects Daughter" => "Architects Daughter",
            "Archivo Black" => "Archivo Black",
            "Archivo Narrow" => "Archivo Narrow",
            "Arimo" => "Arimo",
            "Arizonia" => "Arizonia",
            "Armata" => "Armata",
            "Artifika" => "Artifika",
            "Arvo" => "Arvo",
            "Asap" => "Asap",
            "Asset" => "Asset",
            "Astloch" => "Astloch",
            "Asul" => "Asul",
            "Atomic Age" => "Atomic Age",
            "Aubrey" => "Aubrey",
            "Audiowide" => "Audiowide",
            "Autour One" => "Autour One",
            "Average" => "Average",
            "Average Sans" => "Average Sans",
            "Averia Gruesa Libre" => "Averia Gruesa Libre",
            "Averia Libre" => "Averia Libre",
            "Averia Sans Libre" => "Averia Sans Libre",
            "Averia Serif Libre" => "Averia Serif Libre",
            "Bad Script" => "Bad Script",
            "Balthazar" => "Balthazar",
            "Bangers" => "Bangers",
            "Basic" => "Basic",
            "Battambang" => "Battambang",
            "Baumans" => "Baumans",
            "Bayon" => "Bayon",
            "Belgrano" => "Belgrano",
            "Belleza" => "Belleza",
            "BenchNine" => "BenchNine",
            "Bentham" => "Bentham",
            "Berkshire Swash" => "Berkshire Swash",
            "Bevan" => "Bevan",
            "Bigelow Rules" => "Bigelow Rules",
            "Bigshot One" => "Bigshot One",
            "Bilbo" => "Bilbo",
            "Bilbo Swash Caps" => "Bilbo Swash Caps",
            "Bitter" => "Bitter",
            "Black Ops One" => "Black Ops One",
            "Bokor" => "Bokor",
            "Bonbon" => "Bonbon",
            "Boogaloo" => "Boogaloo",
            "Bowlby One" => "Bowlby One",
            "Bowlby One SC" => "Bowlby One SC",
            "Brawler" => "Brawler",
            "Bree Serif" => "Bree Serif",
            "Bubblegum Sans" => "Bubblegum Sans",
            "Bubbler One" => "Bubbler One",
            "Buda" => "Buda",
            "Buenard" => "Buenard",
            "Butcherman" => "Butcherman",
            "Butterfly Kids" => "Butterfly Kids",
            "Cabin" => "Cabin",
            "Cabin Condensed" => "Cabin Condensed",
            "Cabin Sketch" => "Cabin Sketch",
            "Caesar Dressing" => "Caesar Dressing",
            "Cagliostro" => "Cagliostro",
            "Calligraffitti" => "Calligraffitti",
            "Cambo" => "Cambo",
            "Candal" => "Candal",
            "Cantarell" => "Cantarell",
            "Cantata One" => "Cantata One",
            "Cantora One" => "Cantora One",
            "Capriola" => "Capriola",
            "Cardo" => "Cardo",
            "Carme" => "Carme",
            "Carrois Gothic" => "Carrois Gothic",
            "Carrois Gothic SC" => "Carrois Gothic SC",
            "Carter One" => "Carter One",
            "Caudex" => "Caudex",
            "Cedarville Cursive" => "Cedarville Cursive",
            "Ceviche One" => "Ceviche One",
            "Changa One" => "Changa One",
            "Chango" => "Chango",
            "Chau Philomene One" => "Chau Philomene One",
            "Chela One" => "Chela One",
            "Chelsea Market" => "Chelsea Market",
            "Chenla" => "Chenla",
            "Cherry Cream Soda" => "Cherry Cream Soda",
            "Cherry Swash" => "Cherry Swash",
            "Chewy" => "Chewy",
            "Chicle" => "Chicle",
            "Chivo" => "Chivo",
            "Cinzel" => "Cinzel",
            "Cinzel Decorative" => "Cinzel Decorative",
            "Clicker Script" => "Clicker Script",
            "Coda" => "Coda",
            "Coda Caption" => "Coda Caption",
            "Codystar" => "Codystar",
            "Combo" => "Combo",
            "Comfortaa" => "Comfortaa",
            "Coming Soon" => "Coming Soon",
            "Concert One" => "Concert One",
            "Condiment" => "Condiment",
            "Content" => "Content",
            "Contrail One" => "Contrail One",
            "Convergence" => "Convergence",
            "Cookie" => "Cookie",
            "Copse" => "Copse",
            "Corben" => "Corben",
            "Courgette" => "Courgette",
            "Cousine" => "Cousine",
            "Coustard" => "Coustard",
            "Covered By Your Grace" => "Covered By Your Grace",
            "Crafty Girls" => "Crafty Girls",
            "Creepster" => "Creepster",
            "Crete Round" => "Crete Round",
            "Crimson Text" => "Crimson Text",
            "Croissant One" => "Croissant One",
            "Crushed" => "Crushed",
            "Cuprum" => "Cuprum",
            "Cutive" => "Cutive",
            "Cutive Mono" => "Cutive Mono",
            "Damion" => "Damion",
            "Dancing Script" => "Dancing Script",
            "Dangrek" => "Dangrek",
            "Dawning of a New Day" => "Dawning of a New Day",
            "Days One" => "Days One",
            "Delius" => "Delius",
            "Delius Swash Caps" => "Delius Swash Caps",
            "Delius Unicase" => "Delius Unicase",
            "Della Respira" => "Della Respira",
            "Denk One" => "Denk One",
            "Devonshire" => "Devonshire",
            "Didact Gothic" => "Didact Gothic",
            "Diplomata" => "Diplomata",
            "Diplomata SC" => "Diplomata SC",
            "Domine" => "Domine",
            "Donegal One" => "Donegal One",
            "Doppio One" => "Doppio One",
            "Dorsa" => "Dorsa",
            "Dosis" => "Dosis",
            "Dr Sugiyama" => "Dr Sugiyama",
            "Droid Sans" => "Droid Sans",
            "Droid Sans Mono" => "Droid Sans Mono",
            "Droid Serif" => "Droid Serif",
            "Duru Sans" => "Duru Sans",
            "Dynalight" => "Dynalight",
            "EB Garamond" => "EB Garamond",
            "Eagle Lake" => "Eagle Lake",
            "Eater" => "Eater",
            "Economica" => "Economica",
            "Electrolize" => "Electrolize",
            "Elsie" => "Elsie",
            "Elsie Swash Caps" => "Elsie Swash Caps",
            "Emblema One" => "Emblema One",
            "Emilys Candy" => "Emilys Candy",
            "Engagement" => "Engagement",
            "Englebert" => "Englebert",
            "Enriqueta" => "Enriqueta",
            "Erica One" => "Erica One",
            "Esteban" => "Esteban",
            "Euphoria Script" => "Euphoria Script",
            "Ewert" => "Ewert",
            "Exo" => "Exo",
            "Exo 2" => "Exo 2",
            "Expletus Sans" => "Expletus Sans",
            "Fanwood Text" => "Fanwood Text",
            "Fascinate" => "Fascinate",
            "Fascinate Inline" => "Fascinate Inline",
            "Faster One" => "Faster One",
            "Fasthand" => "Fasthand",
            "Fauna One" => "Fauna One",
            "Federant" => "Federant",
            "Federo" => "Federo",
            "Felipa" => "Felipa",
            "Fenix" => "Fenix",
            "Finger Paint" => "Finger Paint",
            "Fjalla One" => "Fjalla One",
            "Fjord One" => "Fjord One",
            "Flamenco" => "Flamenco",
            "Flavors" => "Flavors",
            "Fondamento" => "Fondamento",
            "Fontdiner Swanky" => "Fontdiner Swanky",
            "Forum" => "Forum",
            "Francois One" => "Francois One",
            "Freckle Face" => "Freckle Face",
            "Fredericka the Great" => "Fredericka the Great",
            "Fredoka One" => "Fredoka One",
            "Freehand" => "Freehand",
            "Fresca" => "Fresca",
            "Frijole" => "Frijole",
            "Fruktur" => "Fruktur",
            "Fugaz One" => "Fugaz One",
            "GFS Didot" => "GFS Didot",
            "GFS Neohellenic" => "GFS Neohellenic",
            "Gabriela" => "Gabriela",
            "Gafata" => "Gafata",
            "Galdeano" => "Galdeano",
            "Galindo" => "Galindo",
            "Gentium Basic" => "Gentium Basic",
            "Gentium Book Basic" => "Gentium Book Basic",
            "Geo" => "Geo",
            "Geostar" => "Geostar",
            "Geostar Fill" => "Geostar Fill",
            "Germania One" => "Germania One",
            "Gilda Display" => "Gilda Display",
            "Give You Glory" => "Give You Glory",
            "Glass Antiqua" => "Glass Antiqua",
            "Glegoo" => "Glegoo",
            "Gloria Hallelujah" => "Gloria Hallelujah",
            "Goblin One" => "Goblin One",
            "Gochi Hand" => "Gochi Hand",
            "Gorditas" => "Gorditas",
            "Goudy Bookletter 1911" => "Goudy Bookletter 1911",
            "Graduate" => "Graduate",
            "Grand Hotel" => "Grand Hotel",
            "Gravitas One" => "Gravitas One",
            "Great Vibes" => "Great Vibes",
            "Griffy" => "Griffy",
            "Gruppo" => "Gruppo",
            "Gudea" => "Gudea",
            "Habibi" => "Habibi",
            "Hammersmith One" => "Hammersmith One",
            "Hanalei" => "Hanalei",
            "Hanalei Fill" => "Hanalei Fill",
            "Handlee" => "Handlee",
            "Hanuman" => "Hanuman",
            "Happy Monkey" => "Happy Monkey",
            "Headland One" => "Headland One",
            "Henny Penny" => "Henny Penny",
            "Herr Von Muellerhoff" => "Herr Von Muellerhoff",
            "Holtwood One SC" => "Holtwood One SC",
            "Homemade Apple" => "Homemade Apple",
            "Homenaje" => "Homenaje",
            "IM Fell DW Pica" => "IM Fell DW Pica",
            "IM Fell DW Pica SC" => "IM Fell DW Pica SC",
            "IM Fell Double Pica" => "IM Fell Double Pica",
            "IM Fell Double Pica SC" => "IM Fell Double Pica SC",
            "IM Fell English" => "IM Fell English",
            "IM Fell English SC" => "IM Fell English SC",
            "IM Fell French Canon" => "IM Fell French Canon",
            "IM Fell French Canon SC" => "IM Fell French Canon SC",
            "IM Fell Great Primer" => "IM Fell Great Primer",
            "IM Fell Great Primer SC" => "IM Fell Great Primer SC",
            "Iceberg" => "Iceberg",
            "Iceland" => "Iceland",
            "Imprima" => "Imprima",
            "Inconsolata" => "Inconsolata",
            "Inder" => "Inder",
            "Indie Flower" => "Indie Flower",
            "Inika" => "Inika",
            "Irish Grover" => "Irish Grover",
            "Istok Web" => "Istok Web",
            "Italiana" => "Italiana",
            "Italianno" => "Italianno",
            "Jacques Francois" => "Jacques Francois",
            "Jacques Francois Shadow" => "Jacques Francois Shadow",
            "Jim Nightshade" => "Jim Nightshade",
            "Jockey One" => "Jockey One",
            "Jolly Lodger" => "Jolly Lodger",
            "Josefin Sans" => "Josefin Sans",
            "Josefin Slab" => "Josefin Slab",
            "Joti One" => "Joti One",
            "Judson" => "Judson",
            "Julee" => "Julee",
            "Julius Sans One" => "Julius Sans One",
            "Junge" => "Junge",
            "Jura" => "Jura",
            "Just Another Hand" => "Just Another Hand",
            "Just Me Again Down Here" => "Just Me Again Down Here",
            "Kameron" => "Kameron",
            "Kantumruy" => "Kantumruy",
            "Karla" => "Karla",
            "Kaushan Script" => "Kaushan Script",
            "Kavoon" => "Kavoon",
            "Kdam Thmor" => "Kdam Thmor",
            "Keania One" => "Keania One",
            "Kelly Slab" => "Kelly Slab",
            "Kenia" => "Kenia",
            "Khmer" => "Khmer",
            "Kite One" => "Kite One",
            "Knewave" => "Knewave",
            "Kotta One" => "Kotta One",
            "Koulen" => "Koulen",
            "Kranky" => "Kranky",
            "Kreon" => "Kreon",
            "Kristi" => "Kristi",
            "Krona One" => "Krona One",
            "La Belle Aurore" => "La Belle Aurore",
            "Lancelot" => "Lancelot",
            "Lato" => "Lato",
            "League Script" => "League Script",
            "Leckerli One" => "Leckerli One",
            "Ledger" => "Ledger",
            "Lekton" => "Lekton",
            "Lemon" => "Lemon",
            "Libre Baskerville" => "Libre Baskerville",
            "Life Savers" => "Life Savers",
            "Lilita One" => "Lilita One",
            "Lily Script One" => "Lily Script One",
            "Limelight" => "Limelight",
            "Linden Hill" => "Linden Hill",
            "Lobster" => "Lobster",
            "Lobster Two" => "Lobster Two",
            "Londrina Outline" => "Londrina Outline",
            "Londrina Shadow" => "Londrina Shadow",
            "Londrina Sketch" => "Londrina Sketch",
            "Londrina Solid" => "Londrina Solid",
            "Lora" => "Lora",
            "Love Ya Like A Sister" => "Love Ya Like A Sister",
            "Loved by the King" => "Loved by the King",
            "Lovers Quarrel" => "Lovers Quarrel",
            "Luckiest Guy" => "Luckiest Guy",
            "Lusitana" => "Lusitana",
            "Lustria" => "Lustria",
            "Macondo" => "Macondo",
            "Macondo Swash Caps" => "Macondo Swash Caps",
            "Magra" => "Magra",
            "Maiden Orange" => "Maiden Orange",
            "Mako" => "Mako",
            "Marcellus" => "Marcellus",
            "Marcellus SC" => "Marcellus SC",
            "Marck Script" => "Marck Script",
            "Margarine" => "Margarine",
            "Marko One" => "Marko One",
            "Marmelad" => "Marmelad",
            "Marvel" => "Marvel",
            "Mate" => "Mate",
            "Mate SC" => "Mate SC",
            "Maven Pro" => "Maven Pro",
            "McLaren" => "McLaren",
            "Meddon" => "Meddon",
            "MedievalSharp" => "MedievalSharp",
            "Medula One" => "Medula One",
            "Megrim" => "Megrim",
            "Meie Script" => "Meie Script",
            "Merienda" => "Merienda",
            "Merienda One" => "Merienda One",
            "Merriweather" => "Merriweather",
            "Merriweather Sans" => "Merriweather Sans",
            "Metal" => "Metal",
            "Metal Mania" => "Metal Mania",
            "Metamorphous" => "Metamorphous",
            "Metrophobic" => "Metrophobic",
            "Michroma" => "Michroma",
            "Milonga" => "Milonga",
            "Miltonian" => "Miltonian",
            "Miltonian Tattoo" => "Miltonian Tattoo",
            "Miniver" => "Miniver",
            "Miss Fajardose" => "Miss Fajardose",
            "Modern Antiqua" => "Modern Antiqua",
            "Molengo" => "Molengo",
            "Molle" => "Molle",
            "Monda" => "Monda",
            "Monofett" => "Monofett",
            "Monoton" => "Monoton",
            "Monsieur La Doulaise" => "Monsieur La Doulaise",
            "Montaga" => "Montaga",
            "Montez" => "Montez",
            "Montserrat" => "Montserrat",
            "Montserrat Alternates" => "Montserrat Alternates",
            "Montserrat Subrayada" => "Montserrat Subrayada",
            "Moul" => "Moul",
            "Moulpali" => "Moulpali",
            "Mountains of Christmas" => "Mountains of Christmas",
            "Mouse Memoirs" => "Mouse Memoirs",
            "Mr Bedfort" => "Mr Bedfort",
            "Mr Dafoe" => "Mr Dafoe",
            "Mr De Haviland" => "Mr De Haviland",
            "Mrs Saint Delafield" => "Mrs Saint Delafield",
            "Mrs Sheppards" => "Mrs Sheppards",
            "Muli" => "Muli",
            "Mystery Quest" => "Mystery Quest",
            "Neucha" => "Neucha",
            "Neuton" => "Neuton",
            "New Rocker" => "New Rocker",
            "News Cycle" => "News Cycle",
            "Niconne" => "Niconne",
            "Nixie One" => "Nixie One",
            "Nobile" => "Nobile",
            "Nokora" => "Nokora",
            "Norican" => "Norican",
            "Nosifer" => "Nosifer",
            "Nothing You Could Do" => "Nothing You Could Do",
            "Noticia Text" => "Noticia Text",
            "Noto Sans" => "Noto Sans",
            "Noto Serif" => "Noto Serif",
            "Nova Cut" => "Nova Cut",
            "Nova Flat" => "Nova Flat",
            "Nova Mono" => "Nova Mono",
            "Nova Oval" => "Nova Oval",
            "Nova Round" => "Nova Round",
            "Nova Script" => "Nova Script",
            "Nova Slim" => "Nova Slim",
            "Nova Square" => "Nova Square",
            "Numans" => "Numans",
            "Nunito" => "Nunito",
            "Odor Mean Chey" => "Odor Mean Chey",
            "Offside" => "Offside",
            "Old Standard TT" => "Old Standard TT",
            "Oldenburg" => "Oldenburg",
            "Oleo Script" => "Oleo Script",
            "Oleo Script Swash Caps" => "Oleo Script Swash Caps",
            "Open Sans" => "Open Sans",
            "Open Sans Condensed" => "Open Sans Condensed",
            "Oranienbaum" => "Oranienbaum",
            "Orbitron" => "Orbitron",
            "Oregano" => "Oregano",
            "Orienta" => "Orienta",
            "Original Surfer" => "Original Surfer",
            "Oswald" => "Oswald",
            "Over the Rainbow" => "Over the Rainbow",
            "Overlock" => "Overlock",
            "Overlock SC" => "Overlock SC",
            "Ovo" => "Ovo",
            "Oxygen" => "Oxygen",
            "Oxygen Mono" => "Oxygen Mono",
            "PT Mono" => "PT Mono",
            "PT Sans" => "PT Sans",
            "PT Sans Caption" => "PT Sans Caption",
            "PT Sans Narrow" => "PT Sans Narrow",
            "PT Serif" => "PT Serif",
            "PT Serif Caption" => "PT Serif Caption",
            "Pacifico" => "Pacifico",
            "Paprika" => "Paprika",
            "Parisienne" => "Parisienne",
            "Passero One" => "Passero One",
            "Passion One" => "Passion One",
            "Pathway Gothic One" => "Pathway Gothic One",
            "Patrick Hand" => "Patrick Hand",
            "Patrick Hand SC" => "Patrick Hand SC",
            "Patua One" => "Patua One",
            "Paytone One" => "Paytone One",
            "Peralta" => "Peralta",
            "Permanent Marker" => "Permanent Marker",
            "Petit Formal Script" => "Petit Formal Script",
            "Petrona" => "Petrona",
            "Philosopher" => "Philosopher",
            "Piedra" => "Piedra",
            "Pinyon Script" => "Pinyon Script",
            "Pirata One" => "Pirata One",
            "Plaster" => "Plaster",
            "Play" => "Play",
            "Playball" => "Playball",
            "Playfair Display" => "Playfair Display",
            "Playfair Display SC" => "Playfair Display SC",
            "Podkova" => "Podkova",
            "Poiret One" => "Poiret One",
            "Poller One" => "Poller One",
            "Poly" => "Poly",
            "Pompiere" => "Pompiere",
            "Pontano Sans" => "Pontano Sans",
            "Port Lligat Sans" => "Port Lligat Sans",
            "Port Lligat Slab" => "Port Lligat Slab",
            "Prata" => "Prata",
            "Preahvihear" => "Preahvihear",
            "Press Start 2P" => "Press Start 2P",
            "Princess Sofia" => "Princess Sofia",
            "Prociono" => "Prociono",
            "Prosto One" => "Prosto One",
            "Puritan" => "Puritan",
            "Purple Purse" => "Purple Purse",
            "Quando" => "Quando",
            "Quantico" => "Quantico",
            "Quattrocento" => "Quattrocento",
            "Quattrocento Sans" => "Quattrocento Sans",
            "Questrial" => "Questrial",
            "Quicksand" => "Quicksand",
            "Quintessential" => "Quintessential",
            "Qwigley" => "Qwigley",
            "Racing Sans One" => "Racing Sans One",
            "Radley" => "Radley",
            "Raleway" => "Raleway",
            "Raleway Dots" => "Raleway Dots",
            "Rambla" => "Rambla",
            "Rammetto One" => "Rammetto One",
            "Ranchers" => "Ranchers",
            "Rancho" => "Rancho",
            "Rationale" => "Rationale",
            "Redressed" => "Redressed",
            "Reenie Beanie" => "Reenie Beanie",
            "Revalia" => "Revalia",
            "Ribeye" => "Ribeye",
            "Ribeye Marrow" => "Ribeye Marrow",
            "Righteous" => "Righteous",
            "Risque" => "Risque",
            "Roboto" => "Roboto",
            "Roboto Condensed" => "Roboto Condensed",
            "Roboto Slab" => "Roboto Slab",
            "Rochester" => "Rochester",
            "Rock Salt" => "Rock Salt",
            "Rokkitt" => "Rokkitt",
            "Romanesco" => "Romanesco",
            "Ropa Sans" => "Ropa Sans",
            "Rosario" => "Rosario",
            "Rosarivo" => "Rosarivo",
            "Rouge Script" => "Rouge Script",
            "Rubik Mono One" => "Rubik Mono One",
            "Rubik One" => "Rubik One",
            "Ruda" => "Ruda",
            "Rufina" => "Rufina",
            "Ruge Boogie" => "Ruge Boogie",
            "Ruluko" => "Ruluko",
            "Rum Raisin" => "Rum Raisin",
            "Ruslan Display" => "Ruslan Display",
            "Russo One" => "Russo One",
            "Ruthie" => "Ruthie",
            "Rye" => "Rye",
            "Sacramento" => "Sacramento",
            "Sail" => "Sail",
            "Salsa" => "Salsa",
            "Sanchez" => "Sanchez",
            "Sancreek" => "Sancreek",
            "Sansita One" => "Sansita One",
            "Sarina" => "Sarina",
            "Satisfy" => "Satisfy",
            "Scada" => "Scada",
            "Schoolbell" => "Schoolbell",
            "Seaweed Script" => "Seaweed Script",
            "Sevillana" => "Sevillana",
            "Seymour One" => "Seymour One",
            "Shadows Into Light" => "Shadows Into Light",
            "Shadows Into Light Two" => "Shadows Into Light Two",
            "Shanti" => "Shanti",
            "Share" => "Share",
            "Share Tech" => "Share Tech",
            "Share Tech Mono" => "Share Tech Mono",
            "Shojumaru" => "Shojumaru",
            "Short Stack" => "Short Stack",
            "Siemreap" => "Siemreap",
            "Sigmar One" => "Sigmar One",
            "Signika" => "Signika",
            "Signika Negative" => "Signika Negative",
            "Simonetta" => "Simonetta",
            "Sintony" => "Sintony",
            "Sirin Stencil" => "Sirin Stencil",
            "Six Caps" => "Six Caps",
            "Skranji" => "Skranji",
            "Slackey" => "Slackey",
            "Smokum" => "Smokum",
            "Smythe" => "Smythe",
            "Sniglet" => "Sniglet",
            "Snippet" => "Snippet",
            "Snowburst One" => "Snowburst One",
            "Sofadi One" => "Sofadi One",
            "Sofia" => "Sofia",
            "Sonsie One" => "Sonsie One",
            "Sorts Mill Goudy" => "Sorts Mill Goudy",
            "Source Code Pro" => "Source Code Pro",
            "Source Sans Pro" => "Source Sans Pro",
            "Special Elite" => "Special Elite",
            "Spicy Rice" => "Spicy Rice",
            "Spinnaker" => "Spinnaker",
            "Spirax" => "Spirax",
            "Squada One" => "Squada One",
            "Stalemate" => "Stalemate",
            "Stalinist One" => "Stalinist One",
            "Stardos Stencil" => "Stardos Stencil",
            "Stint Ultra Condensed" => "Stint Ultra Condensed",
            "Stint Ultra Expanded" => "Stint Ultra Expanded",
            "Stoke" => "Stoke",
            "Strait" => "Strait",
            "Sue Ellen Francisco" => "Sue Ellen Francisco",
            "Sunshiney" => "Sunshiney",
            "Supermercado One" => "Supermercado One",
            "Suwannaphum" => "Suwannaphum",
            "Swanky and Moo Moo" => "Swanky and Moo Moo",
            "Syncopate" => "Syncopate",
            "Tangerine" => "Tangerine",
            "Taprom" => "Taprom",
            "Tauri" => "Tauri",
            "Telex" => "Telex",
            "Tenor Sans" => "Tenor Sans",
            "Text Me One" => "Text Me One",
            "The Girl Next Door" => "The Girl Next Door",
            "Tienne" => "Tienne",
            "Tinos" => "Tinos",
            "Titan One" => "Titan One",
            "Titillium Web" => "Titillium Web",
            "Trade Winds" => "Trade Winds",
            "Trocchi" => "Trocchi",
            "Trochut" => "Trochut",
            "Trykker" => "Trykker",
            "Tulpen One" => "Tulpen One",
            "Ubuntu" => "Ubuntu",
            "Ubuntu Condensed" => "Ubuntu Condensed",
            "Ubuntu Mono" => "Ubuntu Mono",
            "Ultra" => "Ultra",
            "Uncial Antiqua" => "Uncial Antiqua",
            "Underdog" => "Underdog",
            "Unica One" => "Unica One",
            "UnifrakturCook" => "UnifrakturCook",
            "UnifrakturMaguntia" => "UnifrakturMaguntia",
            "Unkempt" => "Unkempt",
            "Unlock" => "Unlock",
            "Unna" => "Unna",
            "VT323" => "VT323",
            "Vampiro One" => "Vampiro One",
            "Varela" => "Varela",
            "Varela Round" => "Varela Round",
            "Vast Shadow" => "Vast Shadow",
            "Vibur" => "Vibur",
            "Vidaloka" => "Vidaloka",
            "Viga" => "Viga",
            "Voces" => "Voces",
            "Volkhov" => "Volkhov",
            "Vollkorn" => "Vollkorn",
            "Voltaire" => "Voltaire",
            "Waiting for the Sunrise" => "Waiting for the Sunrise",
            "Wallpoet" => "Wallpoet",
            "Walter Turncoat" => "Walter Turncoat",
            "Warnes" => "Warnes",
            "Wellfleet" => "Wellfleet",
            "Wendy One" => "Wendy One",
            "Wire One" => "Wire One",
            "Yanone Kaffeesatz" => "Yanone Kaffeesatz",
            "Yellowtail" => "Yellowtail",
            "Yeseva One" => "Yeseva One",
            "Yesteryear" => "Yesteryear",
            "Zeyada" => "Zeyada",
        );

        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

// Set the Options Array
        global $of_options;
        $of_options = array();

        $of_options[] = array( "name" => "General",
            "type" => "heading");

        $of_options[] = array( "name" => "Import Demo Content",
            "desc" => "Importing demo content will give you sliders, pages, posts, theme options, widgets, sidebars and other settings. This will replicate the live demo.  Please make sure you have the Fusion Core, Layer Slider, Revolution Slider and WooCommerce plugins installed and activated to receive that portion of the content. WARNING: clicking this button will replace your current theme options, sliders and widgets. It can also take a minute to complete.",
            "id" => "demo_data",
            "std" => admin_url('themes.php?page=optionsframework') . "&import_data_content=true",
            "btntext" => 'Import Demo Content',
            "type" => "button");

        $of_options[] = array( "name" => "Responsive",
            "desc" => "",
            "id" => "responsive",
            "std" => "<h3 style='margin: 0;'>Responsive Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Responsive Design",
            "desc" => "Check this box to use the responsive design features. If left unchecked then the fixed layout is used.",
            "id" => "responsive",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Use Fixed Layout for iPad Portrait",
            "desc" => "Check this box to use the fixed layout for the iPad in portrait view.",
            "id" => "ipad_potrait",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Code",
            "desc" => "",
            "id" => "code",
            "std" => "<h3 style='margin: 0;'>Tracking / Space Before Head / Space Before Body Code</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Tracking Code",
            "desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. Please put code inside script tags.",
            "id" => "google_analytics",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array( "name" => "Space before &lt;/head&gt;",
            "desc" => "Add code before the &lt;/head&gt; tag.",
            "id" => "space_head",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array( "name" => "Space before &lt;/body&gt;",
            "desc" => "Add code before the &lt;/body&gt; tag.",
            "id" => "space_body",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array( "name" => "Header",
            "type" => "heading");

        $of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Header Content Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Select a Header Layout",
            "desc" => "",
            "id" => "header_layout",
            "std" => "v1",
            "type" => "images",
            "options" => array(
                "v1" => get_bloginfo('template_directory')."/images/patterns/header1.jpg",
                "v2" => get_bloginfo('template_directory')."/images/patterns/header2.jpg",
                "v3" => get_bloginfo('template_directory')."/images/patterns/header3.jpg",
                "v4" => get_bloginfo('template_directory')."/images/patterns/header4.jpg",
                "v5" => get_bloginfo('template_directory')."/images/patterns/header5.jpg"
            ));

        $of_options[] = array( "name" => "Transparent Header",
            "desc" => "Check this box to enable a transparent header that will display your slider behind it.",
            "id" => "header_transparent",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Slider Position",
            "desc" => "Select if the slider shows below or above the header. This only works for the slider assigned in page options, not with shortcodes.",
            "id" => "slider_position",
            "std" => "Below",
            "type" => "select",
            "options" => array('Below' => 'Below', 'Above' => 'Above'));

        $of_options[] = array( "name" => "Header Top Left Content",
            "desc" => "Select which content displays in the top left area of the header.",
            "id" => "header_left_content",
            "std" => "Contact Info",
            "type" => "select",
            "options" => array('Contact Info' => 'Contact Info', 'Social Links' => 'Social Links', 'Navigation' => 'Navigation', 'Leave Empty' => 'Leave Empty'));

        $of_options[] = array( "name" => "Header Top Right Content",
            "desc" => "Select which content displays in the top right area of the header.",
            "id" => "header_right_content",
            "std" => "Navigation",
            "type" => "select",
             "options" => array('Contact Info' => 'Contact Info', 'Social Links' => 'Social Links', 'Navigation' => 'Navigation', 'Leave Empty' => 'Leave Empty'));

        $of_options[] = array( "name" => "Header Content Area For Header #4",
            "desc" => "Select which content displays in the right area of Header 4.",
            "id" => "header_v4_content",
            "std" => "Tagline + Search",
            "type" => "select",
            "options" => array('Tagline' => 'Tagline', 'Search' => 'Search', 'TaglineAndSearch' => 'Tagline + Search', 'Banner' => 'Banner'));

        $of_options[] = array( "name" => "Banner Code For Header #4",
            "desc" => "Add HTML banner code for Header #4. The banner or image will display in Header 4 as long as you have Banner selected for the Header Content Area For Header #4 option above.",
            "id" => "header_banner_code",
            "std" => '',
            "type" => "textarea");

        $of_options[] = array( "name" => "Header Phone Number",
            "desc" => "Phone number will display in the Contact Info section of your top header.",
            "id" => "header_number",
            "std" => "Call Us Today! 1.555.555.555",
            "type" => "text");

        $of_options[] = array( "name" => "Header Email Address",
            "desc" => "Email address will display in the Contact Info section of your top header.",
            "id" => "header_email",
            "std" => "info@yourdomain.com",
            "type" => "text");

        $of_options[] = array( "name" => "Header Tagline",
            "desc" => "Tagline will display on Header 4 as long as you have Tagline selected for the Header Content Area For Header #4 option above.",
            "id" => "header_tagline",
            "std" => "Insert Any Headline Or Link You Want Here",
            "type" => "text");

        $of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Header Background</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Background Image For Header Area",
            "desc" => "Select an image or insert an image url to use for the header background.",
            "id" => "header_bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "100% Background Image",
            "desc" => "Check this box to have the header background image display at 100% in width and height and scale according to the browser size.",
            "id" => "header_bg_full",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Parallax Background Image",
            "desc" => "Check this box to enable parallax background image when scrolling.",
            "id" => "header_bg_parallax",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "header_bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

        // this is for padding, the id is wrong but there for legacy users
        $of_options[] = array( "name" => "Header Top Padding",
            "desc" => "In pixels, ex: 10px",
            "id" => "margin_header_top",
            "std" => "0px",
            "type" => "text");

        // this is for padding, the id is wrong but there for legacy users
        $of_options[] = array( "name" => "Header Bottom Padding",
            "desc" => "In pixels, ex: 10px",
            "id" => "margin_header_bottom",
            "std" => "0px",
            "type" => "text");

        $of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Header Social Icons</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" =>  "Header Social Icons Custom Color",
            "desc" => "Select a custom social icon color.",
            "id" => "header_social_links_icon_color",
            "std" => "#bebdbd",
            "type" => "color");

        $of_options[] = array( "name" => "Header Social Icons Boxed",
            "desc" => "Controls the color of the social icons in the footer.",
            "id" => "header_social_links_boxed",
            "std" => "No",
            "type" => "select",
            "options" => array('No' => 'No', 'Yes' => 'Yes'));

        $of_options[] = array( "name" =>  "Header Social Icons Custom Box Color",
            "desc" => "Select a custom social icon box color.",
            "id" => "header_social_links_box_color",
            "std" => "#e8e8e8",
            "type" => "color");

        $of_options[] = array( "name" => "Header Social Icons Boxed Radius",
            "desc" => "Boxradius for the social icons. In pixels, ex: 4px.",
            "id" => "header_social_links_boxed_radius",
            "std" => "4px",
            "type" => "text");

        $of_options[] = array( "name" => "Header Social Icons Tooltip Position",
            "desc" => "Controls the tooltip position of the social icons in the footer.",
            "id" => "header_social_links_tooltip_placement",
            "std" => "Bottom",
            "type" => "select",
            "options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

        $of_options[] = array( "name" => "Sticky Header",
            "type" => "heading");

        $of_options[] = array( "name" => "Sticky Header Info",
            "desc" => "",
            "id" => "sticky_header_info",
            "std" => "<h3 style='margin: 0;'>Sticky Header Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Enable Sticky Header",
            "desc" => "Check to enable a fixed header when scrolling, uncheck to disable.",
            "id" => "header_sticky",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable Sticky Header on Tablets",
            "desc" => "Check to enable a fixed header when scrolling on tablets, uncheck to disable.",
            "id" => "header_sticky_tablet",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable Sticky Header on Mobiles",
            "desc" => "Check to enable a fixed header when scrolling on mobiles, uncheck to disable.",
            "id" => "header_sticky_mobile",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Sticky Header Opacity",
            "desc" => "Header v2 - v5 only. Set the opacity of background, <br />0.1 (lowest) to 1 (highest).",
            "id" => "header_sticky_opacity",
            "std" => "0.97",
            "type" => "text");

        $of_options[] = array( "name" => "Sticky Header Menu Item Padding",
            "desc" => "Controls the space between each menu item in the sticky header. Use a number without 'px', default is 35. ex: 35",
            "id" => "header_sticky_nav_padding",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Sticky Header Navigation Font Size",
            "desc" => "Controls the font size of the menu items in the sticky header. Use a number without 'px', default is 14. ex: 14",
            "id" => "header_sticky_nav_font_size",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Sticky Header Logo Width",
            "desc" => "Controls the max-width of the sticky header logo. If your logo is too large and does not allow the menu to fit on one line, then use this option and insert a smaller width for your logo. ex: 120",
            "id" => "header_sticky_logo_max_width",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Logo",
            "type" => "heading");

        $of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Logo Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Logo",
            "desc" => "Select an image file for your logo.",
            "id" => "logo",
            "std" => get_bloginfo('template_directory')."/images/logo.png",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "Logo (Retina Version @2x)",
            "desc" => "Select an image file for the retina version of the logo. It should be exactly 2x the size of main logo.",
            "id" => "logo_retina",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "Standard Logo Width for Retina Logo",
            "desc" => "If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width.",
            "id" => "retina_logo_width",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Standard Logo Height for Retina Logo",
            "desc" => "If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height.",
            "id" => "retina_logo_height",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Logo Alignment",
            "desc" => "Note: center only works on Header 5.",
            "id" => "logo_alignment",
            "std" => "Left",
            "type" => "select",
            "options" => array('Left' => 'Left', 'Center' => 'Center', 'Right' => 'Right',));

        $of_options[] = array( "name" => "Logo Left Margin",
            "desc" => "In pixels, ex: 10px",
            "id" => "margin_logo_left",
            "std" => "0px",
            "type" => "text");

        $of_options[] = array( "name" => "Logo Right Margin",
            "desc" => "In pixels, ex: 10px",
            "id" => "margin_logo_right",
            "std" => "0px",
            "type" => "text");

        $of_options[] = array( "name" => "Logo Top Margin",
            "desc" => "In pixels, ex: 10px",
            "id" => "margin_logo_top",
            "std" => "31px",
            "type" => "text");

        $of_options[] = array( "name" => "Logo Bottom Margin",
            "desc" => "In pixels, ex: 10px",
            "id" => "margin_logo_bottom",
            "std" => "31px",
            "type" => "text");

        $of_options[] = array( "name" => "Favicon Options",
            "desc" => "",
            "id" => "favicons",
            "std" => "<h3 style='margin: 0;'>Favicon Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Favicon",
            "desc" => "Favicon for your website (16px x 16px).",
            "id" => "favicon",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Apple iPhone Icon Upload",
            "desc" => "Favicon for Apple iPhone (57px x 57px).",
            "id" => "iphone_icon",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Apple iPhone Retina Icon Upload",
            "desc" => "Favicon for Apple iPhone Retina Version (114px x 114px).",
            "id" => "iphone_icon_retina",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Apple iPad Icon Upload",
            "desc" => "Favicon for Apple iPad (72px x 72px).",
            "id" => "ipad_icon",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Apple iPad Retina Icon Upload",
            "desc" => "Favicon for Apple iPad Retina Version (144px x 144px).",
            "id" => "ipad_icon_retina",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Menu",
            "type" => "heading");

        $of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Menu Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Main Nav Height",
            "desc" => "Use a number without 'px', default is 83. ex: 83",
            "id" => "nav_height",
            "std" => "83",
            "type" => "text");

        $of_options[] = array( "name" => "Menu Item Padding",
            "desc" => "Use a number without 'px', default is 35. ex: 35",
            "id" => "nav_padding",
            "std" => "35",
            "type" => "text");

        $of_options[] = array( "name" => "Main Menu Dropdown Width",
            "desc" => "In pixels, ex: 170px",
            "id" => "dropdown_menu_width",
            "std" => "170px",
            "type" => "text");
            
        $of_options[] = array( "name" => "Top Menu Dropdown Width",
            "desc" => "In pixels, ex: 100px",
            "id" => "topmenu_dropwdown_width",
            "std" => "100px",
            "type" => "text");               

        $of_options[] = array( "name" => "Mega Menu Column Title Size",
            "desc" => "Set the font size for mega menu column titles (menu 2nd level labels). In pixels, ex: 18px",
            "id" => "megamenu_title_size",
            "std" => "18px",
            "type" => "text");

        $of_options[] = array( "name" => "Show Search Icon in Main Nav?",
            "desc" => "Check to enable the search icon in the menu, uncheck to disable.",
            "id" => "main_nav_search_icon",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable Circle Border On Menu Icons",
            "desc" => "Check to enable a circle border on the main menu cart and search icons.",
            "id" => "main_nav_icon_circle",
            "std" => 0,
            "type" => "checkbox");
            
        $of_options[] = array( "name" => "Mobile Menu Submenu Slide Outs",
            "desc" => "Check to group submenu to slideout elements on mobile menu.",
            "id" => "mobile_nav_submenu_slideout",
            "std" => 0,
            "type" => "checkbox");              

        $of_options[] = array( "name" => "Page Title Bar",
            "type" => "heading");

 		$of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Page Title Bar Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Page Title Bar",
            "desc" => "Check the box to show the page title bar. This is a global option for every page or post, and this can be overridden by individual page/post options.",
            "id" => "page_title_bar",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Page Title Bar Height",
            "desc" => "In pixels, ex: 10px",
            "id" => "page_title_height",
            "std" => "87px",
            "type" => "text");

        $of_options[] = array( "name" => "Page Title Bar Background",
            "desc" => "Select an image or insert an image url to use for the page title bar background.",
            "id" => "page_title_bg",
            "std" => get_bloginfo('template_directory')."/images/page_title_bg.png",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "Page Title Bar Background (Retina Version @2x)",
            "desc" => "Select an image or insert an image url to use for the retina page title bar background.",
            "id" => "page_title_bg_retina",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "100% Background Image",
            "desc" => "Check this box to have the page title bar background image display at 100% in width and height and scale according to the browser size.",
            "id" => "page_title_bg_full",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Parallax Background Image",
            "desc" => "Check to enable parallax background image when scrolling.",
            "id" => "page_title_bg_parallax",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Breadcrumb Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Display Breadcrumbs/Search Bar",
            "desc" => "Check to display the breadcrumbs or search bar in general. Uncheck to hide them.",
            "id" => "breadcrumb",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Breadcrumbs or Search Box?",
            "desc" => "Choose to display breadcrumbs or search box in the page title bar.",
            "id" => "page_title_bar_bs",
            "std" => "Breadcrumbs",
            "options" => array('Breadcrumbs' => 'Breadcrumbs', 'Search Box' => 'Search Box'),
            "type" => "select");

        $of_options[] = array( "name" => "Breadcrumbs on Mobile Devices",
            "desc" => "Check to display breadcrumbs on mobile devices.",
            "id" => "breadcrumb_mobile",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Breadcrumb Menu Prefix",
            "desc" => "The text before the breadcrumb menu.",
            "id" => "breacrumb_prefix",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Sliding Bar",
            "type" => "heading");

        $of_options[] = array( "name" => "Sliding Bar",
            "desc" => "",
            "id" => "sliding_bar",
            "std" => "<h3 style='margin: 0;'>Sliding Bar Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Enable Sliding Bar",
            "desc" => "Check to enable the top Sliding Bar.",
            "id" => "slidingbar_widgets",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Sliding Bar On Mobile",
            "desc" => "Check to disable the top Sliding Bar on mobile devices.",
            "id" => "mobile_slidingbar_widgets",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable Top Border on Sliding Bar",
            "desc" => "Check to enable a top border on the Sliding Bar.",
            "id" => "slidingbar_top_border",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable Transparency on the Sliding Bar",
            "desc" => "Check the box to enable transparency on the Sliding Bar.",
            "id" => "slidingbar_bg_color_transparency",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Sliding Bar Open On Page Load",
            "desc" => "Check the box to have the sliding bar open when the page loads.",
            "id" => "slidingbar_open_on_load",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Number of Sliding Bar Columns",
            "desc" => "Select the number of columns to display in the Sliding Bar.",
            "id" => "slidingbar_widgets_columns",
            "std" => "4",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'),
            "type" => "select");

        $of_options[] = array( "name" => "Footer",
            "type" => "heading");

        $of_options[] = array( "name" => "Footer Widgets Area",
            "desc" => "",
            "id" => "footer_widgets_area_title",
            "std" => "<h3 style='margin: 0;'>Footer Widgets Area Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Footer Widgets",
            "desc" => "Check the box to display footer widgets.",
            "id" => "footer_widgets",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Number of Footer Columns",
            "desc" => "Select the number of columns to display in the footer.",
            "id" => "footer_widgets_columns",
            "std" => "4",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'),
            "type" => "select");

        $of_options[] = array( "name" => "Background Image For Footer Area",
            "desc" => "Select an image or insert an image url to use for the footer widget area backgroud.",
            "id" => "footerw_bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "100% Background Image",
            "desc" => "Check this box to have the footer background image display at 100% in width and height and scale according to the browser size.",
            "id" => "footerw_bg_full",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Parallax Background Image",
            "desc" => "Check to enable parallax background image when scrolling.",
            "id" => "footer_area_bg_parallax",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "footerw_bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

        $of_options[] = array( "name" => "Background Position",
            "desc" => "Select the position from where background image starts.",
            "id" => "footerw_bg_pos",
            "std" => "center center",
            "type" => "select",
            "options" => $body_pos);

        $of_options[] = array( "name" => "Footer Top Padding",
            "desc" => "In pixels, ex: 20px",
            "id" => "footer_area_top_padding",
            "std" => "43px",
            "type" => "text");

        $of_options[] = array( "name" => "Footer Bottom Padding",
            "desc" => "In pixels, ex: 20px",
            "id" => "footer_area_bottom_padding",
            "std" => "40px",
            "type" => "text");

        $of_options[] = array( "name" => "Copyright Area / Social Icon Options",
            "desc" => "",
            "id" => "copyright_area_title",
            "std" => "<h3 style='margin: 0;'>Copyright Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Copyright Bar",
            "desc" => "Check the box to display the copyright bar.",
            "id" => "footer_copyright",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Copyright Text",
            "desc" => "Enter the text that displays in the copyright bar. HTML markup can be used.",
            "id" => "footer_text",
            "std" => 'Copyright 2012 Avada | All Rights Reserved | Powered by <a href="http://wordpress.org">WordPress</a>  |  <a href="http://theme-fusion.com">Theme Fusion</a>',
            "type" => "textarea");

        $of_options[] = array( "name" => "Copyright Top Padding",
            "desc" => "In pixels, ex: 18px",
            "id" => "copyright_top_padding",
            "std" => "18px",
            "type" => "text");

        $of_options[] = array( "name" => "Copyright Bottom Padding",
            "desc" => "In pixels, ex: 18px",
            "id" => "copyright_bottom_padding",
            "std" => "16px",
            "type" => "text");

        $of_options[] = array( "name" => "Social Icon Options",
            "desc" => "",
            "id" => "footer_social_icon_title",
            "std" => "<h3 style='margin: 0;'>Social Icon Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Display Social Icons on Footer of the Page",
            "desc" => "Select the checkbox to show social media icons on the footer of the page.",
            "id" => "icons_footer",
            "std" => 1,
            "type" => "checkbox");
        
        $of_options[] = array( "name" =>  "Footer Social Icons Custom Color",
            "desc" => "Select a custom social icon color.",
            "id" => "footer_social_links_icon_color",
            "std" => "#46494a",
            "type" => "color");

        $of_options[] = array( "name" => "Footer Social Icons Boxed",
            "desc" => "Controls the color of the social icons in the footer.",
            "id" => "footer_social_links_boxed",
            "std" => "No",
            "type" => "select",
            "options" => array('No' => 'No', 'Yes' => 'Yes'));

        $of_options[] = array( "name" =>  "Footer Social Icons Custom Box Color",
            "desc" => "Select a custom social icon box color.",
            "id" => "footer_social_links_box_color",
            "std" => "#222222",
            "type" => "color");

        $of_options[] = array( "name" => "Footer Social Icons Boxed Radius",
            "desc" => "Boxradius for the social icons. In pixels, ex: 4px.",
            "id" => "footer_social_links_boxed_radius",
            "std" => "4px",
            "type" => "text");

        $of_options[] = array( "name" => "Footer Social Icons Tooltip Position",
            "desc" => "Controls the tooltip position of the social icons in the footer.",
            "id" => "footer_social_links_tooltip_placement",
            "std" => "Top",
            "type" => "select",
            "options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

        $of_options[] = array( "name" => "Background",
            "type" => "heading");

        $of_options[] = array( "name" => "Layout",
            "desc" => "Select boxed or wide layout.",
            "id" => "layout",
            "std" => "Wide",
            "type" => "select",
            "options" => array(
                'Boxed' => 'Boxed',
                'Wide' => 'Wide',
            ));

        $of_options[] = array( "name" => "Boxed Mode Only",
            "desc" => "",
            "id" => "boxed_mode_only",
            "std" => "<h3 style='margin: 0;'>Background options below only work in boxed mode</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Background Image For Outer Areas In Boxed Mode",
            "desc" => "Select an image or insert an image url to use for the backgroud.",
            "id" => "bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "100% Background Image",
            "desc" => "Check this box to have the background image display at 100% in width and height and scale according to the browser size.",
            "id" => "bg_full",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

        $of_options[] = array( "name" =>  "Background Color For Outer Areas In Boxed Mode",
            "desc" => "Select a background color.",
            "id" => "bg_color",
            "std" => "#d7d6d6",
            "type" => "color");

        $of_options[] = array( "name" => "Background Pattern",
            "desc" => "Check the box to display a pattern in the background. If checked, select the pattern from below.",
            "id" => "bg_pattern_option",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Select a Background Pattern",
            "desc" => "",
            "id" => "bg_pattern",
            "std" => "pattern1",
            "type" => "images",
            "options" => array(
                "pattern1" => get_bloginfo('template_directory')."/images/patterns/pattern1.png",
                "pattern2" => get_bloginfo('template_directory')."/images/patterns/pattern2.png",
                "pattern3" => get_bloginfo('template_directory')."/images/patterns/pattern3.png",
                "pattern4" => get_bloginfo('template_directory')."/images/patterns/pattern4.png",
                "pattern5" => get_bloginfo('template_directory')."/images/patterns/pattern5.png",
                "pattern6" => get_bloginfo('template_directory')."/images/patterns/pattern6.png",
                "pattern7" => get_bloginfo('template_directory')."/images/patterns/pattern7.png",
                "pattern8" => get_bloginfo('template_directory')."/images/patterns/pattern8.png",
                "pattern9" => get_bloginfo('template_directory')."/images/patterns/pattern9.png",
                "pattern10" => get_bloginfo('template_directory')."/images/patterns/pattern10.png",
            ));

        $of_options[] = array( "name" => "Both Modes",
            "desc" => "",
            "id" => "both_modes_only",
            "std" => "<h3 style='margin: 0;'>Background Options Below Work For Boxed & Wide Mode</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Background Image For Main Content Area",
            "desc" => "Select an image or insert an image url to use for the main content area backgroud.",
            "id" => "content_bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "100% Background Image",
            "desc" => "Check this box to have the background image display at 100% in width and height and scale according to the browser size.",
            "id" => "content_bg_full",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "content_bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

        $of_options[] = array( "name" => "Typography",
            "type" => "heading");

       $of_options[] = array( "name" => "Custom Nav / Headings Font",
            "desc" => "",
            "id" => "custom_heading_font",
            "std" => "<h3 style='margin: 0;'>Custom Font For Menus And Headings.</h3><p style='margin-bottom:0;'>This will override the google / standard font options. All 4 files are required.</p>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Custom Font .woff",
            "desc" => "Upload the .woff font file.",
            "id" => "custom_font_woff",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Custom Font .ttf",
            "desc" => "Upload the .ttf font file.",
            "id" => "custom_font_ttf",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Custom Font .svg",
            "desc" => "Upload the .svg font file.",
            "id" => "custom_font_svg",
            "std" => "",
            "type" => "upload");

        $of_options[] = array( "name" => "Custom Font .eot",
            "desc" => "Upload the .eot font file.",
            "id" => "custom_font_eot",
            "std" => "",
            "type" => "upload");

       $of_options[] = array( "name" => "Custom Nav / Headings Font",
            "desc" => "",
            "id" => "custom_heading_font",
            "std" => "<h3 style='margin: 0;'>Custom Font For Menus And Headings.</h3><p style='margin-bottom:0;'>This will override the google / standard font options. All 4 files are required.</p>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Google Fonts",
            "desc" => "",
            "id" => "google_fonts_intro",
            "std" => "<h3 style='margin: 0;'>Google Fonts</h3><p style='margin-bottom:0;'>This will override standard font options.</p>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Select Body Font Family",
            "desc" => "Select a font family for body text",
            "id" => "google_body",
            "std" => "PT Sans",
            "type" => "select",
            "options" => $google_fonts);

        $of_options[] = array( "name" => "Select Menu Font",
            "desc" => "Select a font family for navigation",
            "id" => "google_nav",
            "std" => "Antic Slab",
            "type" => "select",
            "options" => $google_fonts);

        $of_options[] = array( "name" => "Select Headings Font",
            "desc" => "Select a font family for headings",
            "id" => "google_headings",
            "std" => "Antic Slab",
            "type" => "select",
            "options" => $google_fonts);

        $of_options[] = array( "name" => "Select Footer Headings Font",
            "desc" => "Select a font family for footer headings",
            "id" => "google_footer_headings",
            "std" => "Antic Slab",
            "type" => "select",
            "options" => $google_fonts);

       $of_options[] = array( "name" => "Google Fonts",
            "desc" => "",
            "id" => "google_fonts_intro",
            "std" => "<h3 style='margin: 0;'>Google Fonts</h3><p style='margin-bottom:0;'>This will override standard font options.</p>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Standard Fonts",
            "desc" => "",
            "id" => "standard_fonts_intro",
            "std" => "<h3 style='margin: 0;'>Standards</h3>",
            "position" => "start",
            "type" => "accordion");

        $standard_fonts = array(
            '0' => 'Select Font',
            'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
            "'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
            "'Bookman Old Style', serif" => "'Bookman Old Style', serif",
            "'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
            "Courier, monospace" => "Courier, monospace",
            "Garamond, serif" => "Garamond, serif",
            "Georgia, serif" => "Georgia, serif",
            "Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
            "'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
            "'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
            "'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
            "'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
        );

        $of_options[] = array( "name" => "Select Body Font Family",
            "desc" => "Select a font family for body text",
            "id" => "standard_body",
            "std" => "",
            "type" => "select",
            "options" => $standard_fonts);

        $of_options[] = array( "name" => "Select Menu Font Family",
            "desc" => "Select a font family for menu / navigation",
            "id" => "standard_nav",
            "std" => "",
            "type" => "select",
            "options" => $standard_fonts);

        $of_options[] = array( "name" => "Select Headings Font Family",
            "desc" => "Select a font family for headings",
            "id" => "standard_headings",
            "std" => "",
            "type" => "select",
            "options" => $standard_fonts);

        $of_options[] = array( "name" => "Select Footer Headings Font Family",
            "desc" => "Select a font family for footer headings",
            "id" => "standard_footer_headings",
            "std" => "",
            "type" => "select",
            "options" => $standard_fonts);

        $of_options[] = array( "name" => "Standard Fonts",
            "desc" => "",
            "id" => "standard_fonts_intro",
            "std" => "<h3 style='margin: 0;'>Standards</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Font Size",
            "desc" => "",
            "id" => "font_size_intro",
            "std" => "<h3 style='margin: 0;'>Font Sizes</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Body Font Size",
            "desc" => "In pixels, default is 13",
            "id" => "body_font_size",
            "std" => "13",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Main Menu Font Size",
            "desc" => "In pixels, default is 14",
            "id" => "nav_font_size",
            "std" => "14",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Main Menu Dropdown Font Size",
            "desc" => "In pixels, default is 13",
            "id" => "nav_dropdown_font_size",
            "std" => "13",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Secondary Menu & Top Contact Info Font Size",
            "desc" => "In pixels, default is 12",
            "id" => "snav_font_size",
            "std" => "12",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Side Menu Font Size",
            "desc" => "In pixels, default is 14",
            "id" => "side_nav_font_size",
            "std" => "14",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Breadcrumbs Font Size",
            "desc" => "In pixels, default is 10",
            "id" => "breadcrumbs_font_size",
            "std" => "10",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Sidebar Widget Heading Font Size",
            "desc" => "In pixels, default is 13",
            "id" => "sidew_font_size",
            "std" => "13",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Sliding Bar Widget Heading Font Size",
            "desc" => "In pixels, default is 13",
            "id" => "slidingbar_font_size",
            "std" => "13",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Footer Widget Heading Font Size",
            "desc" => "In pixels, default is 13",
            "id" => "footw_font_size",
            "std" => "13",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Copyright Font Size",
            "desc" => "In pixels, default is 12",
            "id" => "copyright_font_size",
            "std" => "12",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Size H1",
            "desc" => "In pixels, default is 32",
            "id" => "h1_font_size",
            "std" => "32",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Size H2",
            "desc" => "In pixels, default is 18",
            "id" => "h2_font_size",
            "std" => "18",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Size H3",
            "desc" => "In pixels, default is 16",
            "id" => "h3_font_size",
            "std" => "16",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Size H4",
            "desc" => "In pixels, default is 13",
            "id" => "h4_font_size",
            "std" => "13",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Size H5",
            "desc" => "In pixels, default is 12",
            "id" => "h5_font_size",
            "std" => "12",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Size H6",
            "desc" => "In pixels, default is 11",
            "id" => "h6_font_size",
            "std" => "11",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "Header Tagline Font Size",
            "desc" => "In pixels, default is 16",
            "id" => "tagline_font_size",
            "std" => "16",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "Meta Data Font Size",
            "desc" => "In pixels, default is 12",
            "id" => "meta_font_size",
            "std" => "12",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "Page Title Font Size",
            "desc" => "In pixels, default is 18",
            "id" => "page_title_font_size",
            "std" => "18",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "Page Title Subheader Font Size",
            "desc" => "In pixels, default is 14",
            "id" => "page_title_subheader_font_size",
            "std" => "14",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "Pagination Font Size",
            "desc" => "In pixels, default is 12",
            "id" => "pagination_font_size",
            "std" => "12",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "WooCommerce Icon Font Size",
            "desc" => "In pixels, default is 12",
            "id" => "woo_icon_font_size",
            "std" => "12",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Font Size",
            "desc" => "",
            "id" => "font_size_intro",
            "std" => "<h3 style='margin: 0;'>Font Sizes</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Font Line Heights",
            "desc" => "",
            "id" => "font_line_heights_wrapper",
            "std" => "<h3 style='margin: 0;''>Font Line Heights</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Body Font Line Height",
            "desc" => "In pixels, default is 20",
            "id" => "body_font_lh",
            "std" => "20",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Line Height H1",
            "desc" => "In pixels, default is 48",
            "id" => "h1_font_lh",
            "std" => "48",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Line Height H2",
            "desc" => "In pixels, default is 27",
            "id" => "h2_font_lh",
            "std" => "27",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Line Height H3",
            "desc" => "In pixels, default is 24",
            "id" => "h3_font_lh",
            "std" => "24",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Line Height H4",
            "desc" => "In pixels, default is 20",
            "id" => "h4_font_lh",
            "std" => "20",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Line Height H5",
            "desc" => "In pixels, default is 18",
            "id" => "h5_font_lh",
            "std" => "18",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Heading Font Line Height H6",
            "desc" => "In pixels, default is 17",
            "id" => "h6_font_lh",
            "std" => "17",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Font Line Heights",
            "desc" => "",
            "id" => "font_line_heights_wrapper",
            "std" => "<h3 style='margin: 0;''>Font Line Heights</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Styling",
            "type" => "heading");

        $of_options[] = array( "name" => "Select Theme Skin",
            "desc" => "Select a skin, all color options will automatically change to the defined skin.",
            "id" => "scheme_type",
            "std" => "Light",
            "type" => "select",
            "options" => array('Light' => 'Light', 'Dark' => 'Dark'));

        $of_options[] = array( "name" => "Predefined Color Scheme",
            "desc" => "Select a scheme, all color options will automatically change to the defined scheme.",
            "id" => "color_scheme",
            "std" => "Green",
            "type" => "select",
            "options" => array('Red' => 'Red', 'Light Red' => 'Light Red', 'Blue' => 'Blue', 'Light Blue' => 'Light Blue', 'Green' => 'Green', 'Dark Green' => 'Dark Green', 'Orange' => 'Orange', 'Pink' => 'Pink', 'Brown' => 'Brown', 'Light Grey' => 'Light Grey'));

       $of_options[] = array( "name" => "Background Colors",
            "desc" => "",
            "id" => "bg_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Background Colors</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Primary Color",
            "desc" => "Controls several items, ex: link hovers, highlights, and more.",
            "id" => "primary_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sliding Bar Background Color",
            "desc" => "Controls the color of the top sliding bar.",
            "id" => "slidingbar_bg_color",
            "std" => "#363839",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sticky Header Background Color",
            "desc" => "Controls the background color for the sticky header.",
            "id" => "header_sticky_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "Header Background Color",
            "desc" => "Controls the background color for the header.",
            "id" => "header_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" => "Header Border Color",
            "desc" => "Controls the border colors for the header.",
            "id" => "header_border_color",
            "std" => "#e5e5e5",
            "type" => "color");

        $of_options[] = array( "name" =>  "Header Top Background Color",
            "desc" => "Controls the background color of the top header section used in Headers 2-5.",
            "id" => "header_top_bg_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" => "Page Title Bar Background Color",
            "desc" => "Select a color for the page title bar background.",
            "id" => "page_title_bg_color",
            "std" => "#F6F6F6",
            "type" => "color");

        $of_options[] = array( "name" =>  "Page Title Bar Borders Color",
            "desc" => "Select a color for the page title bar borders.",
            "id" => "page_title_border_color",
            "std" => "#d2d3d4",
            "type" => "color");

        $of_options[] = array( "name" =>  "Content Background Color",
            "desc" => "Controls the background color of the main content area.",
            "id" => "content_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "Footer Background Color",
            "desc" => "Controls the background color of the footer.",
            "id" => "footer_bg_color",
            "std" => "#363839",
            "type" => "color");

        $of_options[] = array( "name" =>  "Footer Border Color",
            "desc" => "Controls the border colors for the footer.",
            "id" => "footer_border_color",
            "std" => "#e9eaee",
            "type" => "color");

        $of_options[] = array( "name" =>  "Copyright Background Color",
            "desc" => "Controls the background color of the footer copyright.",
            "id" => "copyright_bg_color",
            "std" => "#282a2b",
            "type" => "color");

        $of_options[] = array( "name" =>  "Copyright Border Color",
            "desc" => "Controls the border colors for the footer copyright.",
            "id" => "copyright_border_color",
            "std" => "#4b4c4d",
            "type" => "color");

       $of_options[] = array( "name" => "Background Colors",
            "desc" => "",
            "id" => "bg_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Background Colors</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Element Colors",
            "desc" => "",
            "id" => "element_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Element Colors</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Rollover Image Gradient Top Color",
            "desc" => "Controls the top color of the image rollover gradients.",
            "id" => "image_gradient_top_color",
            "std" => "#D1E990",
            "type" => "color");

        $of_options[] = array( "name" =>  "Rollover Image Gradient Bottom Color",
            "desc" => "Controls the bottom color of the image rollover gradients.",
            "id" => "image_gradient_bottom_color",
            "std" => "#AAD75B",
            "type" => "color");

        $of_options[] = array( "name" =>  "Rollover Image Element Color",
            "desc" => "This option controls the color of image rollover text and the icon circle backgrounds.",
            "id" => "image_rollover_text_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sliding Bar Item Divider Color",
            "desc" => "Controls the divider color in the sliding bar.",
            "id" => "slidingbar_divider_color",
            "std" => "#282A2B",
            "type" => "color");

        $of_options[] = array( "name" =>  "Footer Widget Divider Color",
            "desc" => "Controls the divider color in the footer.",
            "id" => "footer_divider_color",
            "std" => "#505152",
            "type" => "color");

        $of_options[] = array( "name" =>  "Form Background Color",
            "desc" => "Controls the background color of form fields.",
            "id" => "form_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "Form Text Color",
            "desc" => "Controls the text color for forms.",
            "id" => "form_text_color",
            "std" => "#aaa9a9",
            "type" => "color");

        $of_options[] = array( "name" =>  "Form Border Color",
            "desc" => "Controls the border color of form fields.",
            "id" => "form_border_color",
            "std" => "#d2d2d2",

            "type" => "color");

        $of_options[] = array( "name" =>  "Grid Box Color",
            "desc" => "Controls blog grid, timeline and WooCommerce post box background color.",
            "id" => "timeline_bg_color",
            "std" => "transparent",
            "type" => "color");

        $of_options[] = array( "name" =>  "Grid Element Color",
            "desc" => "Controls blog grid, timeline and WooCommerce post box border, divider lines, date box and border, timeline dots, timeline icon, timeline arrow.",
            "id" => "timeline_color",
            "std" => "#ebeaea",
            "type" => "color");

        $of_options[] = array( "name" =>  "Woo Quantity Box Background Color",
            "desc" => "Controls the background color of the woocommerce quantity box.",
            "id" => "qty_bg_color",
            "std" => "#fbfaf9",
            "type" => "color");

        $of_options[] = array( "name" =>  "Woo Quantity Box Hover Background Color",
            "desc" => "Controls the hover color of the woocommerce quantity box.",
            "id" => "qty_bg_hover_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "bbPress Forum Header Background Color",
            "desc" => "Controls the background color for forum header rows.",
            "id" => "bbp_forum_header_bg",
            "std" => "#ebeaea",
            "type" => "color");

        $of_options[] = array( "name" =>  "bbPress Forum Border Color",
            "desc" => "Controls the border color for all forum surrounding borders.",
            "id" => "bbp_forum_border_color",
            "std" => "#ebeaea",
            "type" => "color");

       $of_options[] = array( "name" => "Element Colors",
            "desc" => "",
            "id" => "element_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Element Colors</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Layout Options",
            "desc" => "",
            "id" => "element_options_wrapper",
            "std" => "<h3 style='margin: 0;'>Layout Options</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Page Content Top Padding",
            "desc" => "(in pixels ex: 20px)",
            "id" => "main_top_padding",
            "std" => "55px",
            "type" => "text");

        $of_options[] = array( "name" => "Page Content Bottom Padding",
            "desc" => "(in pixels ex: 20px)",
            "id" => "main_bottom_padding",
            "std" => "40px",
            "type" => "text");

        $of_options[] = array( "name" => "100% Width Template Left/Right Padding",
            "desc" => "Select the left and right padding for the 100% width template main content area. Enter value in px. ex: 20px",
            "id" => "hundredp_padding",
            "std" => "20px",
            "type" => "text");
            
        $of_options[] = array( "name" => "Disable Sliding Bar Text Shadow",
            "desc" => "Check to disable the text shadow in the Sliding Bar.",
            "id" => "slidingbar_text_shadow",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Footer Text Shadow",
            "desc" => "Check to disable the text shadow in the footer.",
            "id" => "footer_text_shadow",
            "std" => 0,
            "type" => "checkbox");

       $of_options[] = array( "name" => "Layout Options",
            "desc" => "",
            "id" => "element_options_wrapper",
            "std" => "<h3 style='margin: 0;'>Layout Options</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Font Colors",
            "desc" => "",
            "id" => "font_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Font Colors</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Header Tagline Font Color",
            "desc" => "Controls the text color of the header tagline font.",
            "id" => "tagline_font_color",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" =>  "Page Title Font Color",
            "desc" => "Controls the text color of the page title font.",
            "id" => "page_title_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Heading 1 (H1) Font Color",
            "desc" => "Controls the text color of H1 headings.",
            "id" => "h1_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Heading 2 (H2) Font Color",
            "desc" => "Controls the text color of H2 headings.",
            "id" => "h2_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Heading 3 (H3) Font Color",
            "desc" => "Controls the text color of H3 headings.",
            "id" => "h3_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Heading 4 (H4) Font Color",
            "desc" => "Controls the text color of H4 headings.",
            "id" => "h4_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Heading 5 (H5) Font Color",
            "desc" => "Controls the text color of H5 headings.",
            "id" => "h5_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Heading 6 (H6) Font Color",
            "desc" => "Controls the text color of H6 headings.",
            "id" => "h6_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Body Text Color",
            "desc" => "Controls the text color of body font.",
            "id" => "body_text_color",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" =>  "Link Color",
            "desc" => "Controls the color of all text links as well as the '>' in certain areas.",
            "id" => "link_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Breadcrumbs Text Color",
            "desc" => "Controls the text color of the breadcrumb font.",
            "id" => "breadcrumbs_text_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sliding Bar Headings Color",
            "desc" => "Controls the text color of the sliding bar heading font.",
            "id" => "slidingbar_headings_color",
            "std" => "#DDDDDD",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sliding Bar Font Color",
            "desc" => "Controls the font color of the sliding bar font.",
            "id" => "slidingbar_text_color",
            "std" => "#8C8989",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sliding Bar Link Color",
            "desc" => "Controls the text color of the sliding bar link font.",
            "id" => "slidingbar_link_color",
            "std" => "#BFBFBF",
            "type" => "color");

        $of_options[] = array( "name" =>  "Sidebar Widget Headings Color",
            "desc" => "Controls the text color of the sidebar widget headings.",
            "id" => "sidebar_heading_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Footer Headings Color",
            "desc" => "Controls the text color of the footer heading font.",
            "id" => "footer_headings_color",
            "std" => "#DDDDDD",
            "type" => "color");

        $of_options[] = array( "name" =>  "Footer Font Color",
            "desc" => "Controls the text color of the footer font.",
            "id" => "footer_text_color",
            "std" => "#8C8989",
            "type" => "color");

        $of_options[] = array( "name" =>  "Footer Link Color",
            "desc" => "Controls the text color of the footer link font.",
            "id" => "footer_link_color",
            "std" => "#BFBFBF",
            "type" => "color");

       $of_options[] = array( "name" => "Font Colors",
            "desc" => "",
            "id" => "font_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Font Colors</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Main Menu Colors",
            "desc" => "",
            "id" => "main_menu_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Main Menu Colors</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Main Menu Background Color For Header 4 & 5",
            "desc" => "Controls the background color of the menu when using header 4 or 5.",
            "id" => "menu_h45_bg_color",
            "std" => "#FFFFFF",
            "type" => "color");

        $of_options[] = array( "name" =>  "Main Menu Font Color - First Level",
            "desc" => "Controls the text color of first level menu items.",
            "id" => "menu_first_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Main Menu Font Hover Color - First Level",
            "desc" => "Controls the main menu hover, hover border & dropdown border color.",
            "id" => "menu_hover_first_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" =>  "Main Menu Background Color - Sublevels",
            "desc" => "Controls the color of the menu sublevel background.",
            "id" => "menu_sub_bg_color",
            "std" => "#f2efef",
            "type" => "color");

        $of_options[] = array( "name" =>  "Main Menu Background Hover Color - Sublevels",
            "desc" => "Controls the hover color of the menu sublevel background.",
            "id" => "menu_bg_hover_color",
            "std" => "#f8f8f8",
            "type" => "color");

        $of_options[] = array( "name" =>  "Main Menu Font Color - Sublevels",
            "desc" => "Controls the color of the menu font sublevels.",
            "id" => "menu_sub_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Main Menu Separator - Sublevels",
            "desc" => "Controls the color of the menu separator sublevels.",
            "id" => "menu_sub_sep_color",
            "std" => "#dcdadb",
            "type" => "color");

        $of_options[] = array( "name" =>  "Woo Cart Menu Background Color",
            "desc" => "Controls the bottom section background color of the woocommerce cart dropdown.",
            "id" => "woo_cart_bg_color",
            "std" => "#fafafa",
            "type" => "color");

       $of_options[] = array( "name" => "Main Menu Colors",
            "desc" => "",
            "id" => "main_menu_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Main Menu Colors</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Secondary Menu Colors",
            "desc" => "",
            "id" => "menu_colors_intro",
            "std" => "<h3 style='margin: 0;'>Secondary Menu Colors</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Secondary Menu Font Color - First Level & Top Contact Info",
            "desc" => "Controls the color of the secondary menu first level and contact info font.",
            "id" => "snav_color",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" =>  "Secondary Menu Divider Color - First Level",
            "desc" => "Controls the divider color of the first level secondary menu.",
            "id" => "header_top_first_border_color",
            "std" => "#e5e5e5",
            "type" => "color");

        $of_options[] = array( "name" =>  "Secondary Menu Background Color - Sublevels",
            "desc" => "Controls the background color of the secondary menu sublevels.",
            "id" => "header_top_sub_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "Secondary Menu Font Color - Sublevels",
            "desc" => "Controls the text color of the secondary menu font sublevels.",
            "id" => "header_top_menu_sub_color",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" =>  "Secondary Menu Hover Background Color - Sublevels",
            "desc" => "Controls the hover color of the secondary menu background sublevels.",
            "id" => "header_top_menu_bg_hover_color",
            "std" => "#fafafa",
            "type" => "color");

        $of_options[] = array( "name" =>  "Secondary Menu Hover Font Color - Sublevels",
            "desc" => "Controls the hover text color of the secondary menu font sublevels.",
            "id" => "header_top_menu_sub_hover_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Secondary Menu Border  - Sublevels",
            "desc" => "Controls the border color of the secondary menu sublevels.",
            "id" => "header_top_menu_sub_sep_color",
            "std" => "#e5e5e5",
            "type" => "color");

        $of_options[] = array( "name" => "Secondary Menu Colors",
            "desc" => "",
            "id" => "menu_colors_intro",
            "std" => "<h3 style='margin: 0;'>Secondary Menu Colors</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Mobile Menu Colors",
            "desc" => "",
            "id" => "mobile_menu_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Mobile Menu Colors</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Mobile Menu Background Color",
            "desc" => "Controls the background color of the mobile menu box and dropdown.",
            "id" => "mobile_menu_background_color",
            "std" => "#f9f9f9",
            "type" => "color");

        $of_options[] = array( "name" =>  "Mobile Menu Border Color",
            "desc" => "Controls the border, divider and icon colors of the mobile menu.",
            "id" => "mobile_menu_border_color",
            "std" => "#dadada",
            "type" => "color");            

        $of_options[] = array( "name" =>  "Mobile Menu Hover Color",
            "desc" => "Controls the hover color of the mobile menu items.",
            "id" => "mobile_menu_hover_color",
            "std" => "#f6f6f6",
            "type" => "color");

       $of_options[] = array( "name" => "Mobile Menu Colors",
            "desc" => "",
            "id" => "mobile_menu_colors_wrapper",
            "std" => "<h3 style='margin: 0;'>Mobile Menu Colors</h3>",
            "position" => "end",
            "type" => "accordion");  

        $of_options[] = array( "name" => "Shortcode Styling",
            "type" => "heading");

       $of_options[] = array( "name" => "Accordion Shortcode",
            "desc" => "",
            "id" => "accordion_shortcode",
            "std" => "<h3 style='margin: 0;'>Accordion Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Accordion Inactive Box Color",
            "desc" => "Controls the color of the inactive boxes behind the '+' icons.",
            "id" => "accordian_inactive_color",
            "std" => "#333333",
            "type" => "color");

       $of_options[] = array( "name" => "Accordion Shortcode",
            "desc" => "",
            "id" => "accordion_shortcode",
            "std" => "<h3 style='margin: 0;'>Accordion Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Blog Shortcode",
            "desc" => "",
            "id" => "blog_shortcode",
            "std" => "<h3 style='margin: 0;'>Blog Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Blog Date Box Color",
            "desc" => "Controls the color of the date box in blog alternate and recent posts layouts.",
            "id" => "dates_box_color",
            "std" => "#eef0f2",
            "type" => "color");

       $of_options[] = array( "name" => "Blog Shortcode",
            "desc" => "",
            "id" => "blog_shortcode",
            "std" => "<h3 style='margin: 0;'>Blog Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Button Shortcode",
            "desc" => "",
            "id" => "button_shortcode",
            "std" => "<h3 style='margin: 0;'>Button Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");          
            
        $of_options[] = array( "name" => "Button Size",
            "desc" => "Select the default button size.",
            "id" => "button_size",
            "std" => "Large",
            "type" => "select",
            "options" => array('Small' => 'Small', 'Medium' => 'Medium', 'Large' => 'Large', 'XLarge' => 'XLarge'));

        $of_options[] = array( "name" => "Button Shape",
            "desc" => "Select the default shape for buttons.",
            "id" => "button_shape",
            "std" => "Round",
            "type" => "select",
            "options" => array('Square' => 'Square', 'Round' => 'Round', 'Pill' => 'Pill'));

        $of_options[] = array( "name" => "Button Type",
            "desc" => "Select the default button type.",
            "id" => "button_type",
            "std" => "Flat",
            "type" => "select",
            "options" => array('Flat' => 'Flat', '3d' => '3d'));                        
            
        $of_options[] = array( "name" =>  "Button Gradient Top Color",
            "desc" => "Set the top color of the button background.",
            "id" => "button_gradient_top_color",
            "std" => "#D1E990",
            "type" => "color");

        $of_options[] = array( "name" =>  "Button Gradient Bottom Color",
            "desc" => "Set the bottom color of the button background or leave empty for solid color.",
            "id" => "button_gradient_bottom_color",
            "std" => "#AAD75B",
            "type" => "color");

        $of_options[] = array( "name" =>  "Button Gradient Top Hover Color",
            "desc" => "Set the top hover color of the button background.",
            "id" => "button_gradient_top_color_hover",
            "std" => "#AAD75B",
            "type" => "color");

        $of_options[] = array( "name" =>  "Button Gradient Bottom Hover Color",
            "desc" => "Set the bottom hover color of the button background or leave empty for solid color. ",
            "id" => "button_gradient_bottom_color_hover",
            "std" => "#D1E990",
            "type" => "color");
            
        $of_options[] = array( "name" =>  "Button Accent Color",
            "desc" => "This option controls the color of the button border, divider, text and icon.",
            "id" => "button_accent_color",
            "std" => "#6e9a1f",
            "type" => "color");

        $of_options[] = array( "name" =>  "Button Accent Hover Color",
            "desc" => "This option controls the hover color of the button border, divider, text and icon.",
            "id" => "button_accent_hover_color",
            "std" => "#638e1a",
            "type" => "color");        

        $of_options[] = array( "name" =>  "Button Bevel Color (3D Mode only)",
            "desc" => "Controls the default bevel color of the buttons.",
            "id" => "button_bevel_color",
            "std" => "#54770F",
            "type" => "color");            

        $of_options[] = array( "name" => "Button Border Width",
            "desc" => "Select the border width for buttons. Enter value in px. ex: 1px",
            "id" => "button_border_width",
            "std" => "1px",
            "type" => "text");

        $of_options[] = array( "name" => "Button Shadow",
            "desc" => "Select the box to disable the bottom button shadow and text shadow.",
            "id" => "button_text_shadow",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Button Shortcode",
            "desc" => "",
            "id" => "button_shortcode",
            "std" => "<h3 style='margin: 0;'>Button Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Carousel Shortcode",
            "desc" => "",
            "id" => "carousel_shortcode",
            "std" => "<h3 style='margin: 0;'>Carousel Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Carousel Default Nav Box Color",
            "desc" => "Controls the color of the default navigation box for carousel sliders.",
            "id" => "carousel_nav_color",
            "std" => "#999999",
            "type" => "color");

        $of_options[] = array( "name" =>  "Carousel Hover Nav Box Color",
            "desc" => "Controls the color of the hover navigation box for carousel sliders.",
            "id" => "carousel_hover_color",
            "std" => "#808080",
            "type" => "color");

        $of_options[] = array( "name" => "Carousel Shortcode",
            "desc" => "",
            "id" => "carousel_shortcode",
            "std" => "<h3 style='margin: 0;'>Carousel Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Content Box Shortcode",
            "desc" => "",
            "id" => "cb_shortcode",
            "std" => "<h3 style='margin: 0;'>Content Box Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Content Box Background Color",
            "desc" => "Controls the color of the background for content boxes. Only use for 'icon-boxed' style. Leave transparent for other styles.",
            "id" => "content_box_bg_color",
            "std" => "transparent",
            "type" => "color");

        $of_options[] = array( "name" => "Content Box Shortcode",
            "desc" => "",
            "id" => "cb_shortcode",
            "std" => "<h3 style='margin: 0;'>Content Box Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Checklist Shortcode",
            "desc" => "",
            "id" => "checklist_shortcode",
            "std" => "<h3 style='margin: 0;'>Checklist Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");
            
        $of_options[] = array( "name" => "Checklist Circle",
            "desc" => "Check the box if you want to use circles on checklists.",
            "id" => "checklist_circle",
            "std" => 1,
            "type" => "checkbox");            

        $of_options[] = array( "name" => "Checklist Circle Color",
            "desc" => "Controls the color of the checklist circle.",
            "id" => "checklist_circle_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" => "Checklist Icon Color",
            "desc" => "Controls the color of the checklist icon.",
            "id" => "checklist_icons_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" => "Checklist Shortcode",
            "desc" => "",
            "id" => "checklist_shortcode",
            "std" => "<h3 style='margin: 0;'>Checklist Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Counter Circle Shortcode",
            "desc" => "",
            "id" => "cc_shortcode",
            "std" => "<h3 style='margin: 0;'>Counter Circles Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Counter Circle Filled Color",
            "desc" => "Controls the color of the counter text and icon.",
            "id" => "counter_filled_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" =>  "Counter Circle Unfilled Color",
            "desc" => "Controls the color of the counter text and icon.",
            "id" => "counter_unfilled_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" => "Counter Circle Shortcode",
            "desc" => "",
            "id" => "cc_shortcode",
            "std" => "<h3 style='margin: 0;'>Counter Circle Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Counter Boxes Shortcode",
            "desc" => "",
            "id" => "counterb_shortcode",
            "std" => "<h3 style='margin: 0;'>Counter Boxes Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Counter Box Text Color",
            "desc" => "Controls the color of the counter text and icon.",
            "id" => "counter_box_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" => "Counter Boxes Shortcode",
            "desc" => "",
            "id" => "counterb_shortcode",
            "std" => "<h3 style='margin: 0;'>Counter Boxes Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Dropcap Shortcode",
            "desc" => "",
            "id" => "dropcap_shortcode",
            "std" => "<h3 style='margin: 0;'>Dropcap Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Dropcap Color",
            "desc" => "Controls the color of the dropcap text, or the dropcap box is a box is used.",
            "id" => "dropcap_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" => "Dropcap Shortcode",
            "desc" => "",
            "id" => "dropcap_shortcode",
            "std" => "<h3 style='margin: 0;'>Dropcap Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Flip Boxes Shortcode",
            "desc" => "",
            "id" => "flipb_shortcode",
            "std" => "<h3 style='margin: 0;'>Flip Boxes Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Flip Box Background Color Frontside",
            "desc" => "Controls the color of frontside background color.",
            "id" => "flip_boxes_front_bg",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" => "Flip Box Heading Color Frontside",
            "desc" => "Controls the color of frontside heading color.",
            "id" => "flip_boxes_front_heading",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" => "Flip Box Text Color Frontside",
            "desc" => "Controls the color of frontside text color.",
            "id" => "flip_boxes_front_text",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" => "Flip Box Background Color Backside",
            "desc" => "Controls the color of backside background color.",
            "id" => "flip_boxes_back_bg",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" => "Flip Box Heading Color Backside",
            "desc" => "Controls the color of backside heading color.",
            "id" => "flip_boxes_back_heading",
            "std" => "#eeeded",
            "type" => "color");

        $of_options[] = array( "name" => "Flip Box Text Color Backside",
            "desc" => "Controls the color of backside text color.",
            "id" => "flip_boxes_back_text",
            "std" => "#ffffff",
            "type" => "color");


        $of_options[] = array( "name" => "Flip Box Border Size",
            "desc" => "Controls the border size of flip boxes.",
            "id" => "flip_boxes_border_size",
            "std" => "1px",
            "type" => "text");

        $of_options[] = array( "name" => "Flip Box Border Color",
            "desc" => "Controls the border color of flip boxes.",
            "id" => "flip_boxes_border_color",
            "std" => "transparent",
            "type" => "color");

        $of_options[] = array( "name" => "Flip Box Border Radius",
            "desc" => "Controls the border radius (roundness) of flip boxes.",
            "id" => "flip_boxes_border_radius",
            "std" => "4px",
            "type" => "text");

        $of_options[] = array( "name" => "Flip Boxes Shortcode",
            "desc" => "",
            "id" => "flipb_shortcode",
            "std" => "<h3 style='margin: 0;'>Flip Boxes Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Full Width Shortcode",
            "desc" => "",
            "id" => "fullwidth_shortcode",
            "std" => "<h3 style='margin: 0;'>Full Width Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

       $of_options[] = array( "name" => "Full Width Background Color",
            "desc" => "Controls the background color of the full width section.",
            "id" => "full_width_bg_color",
            "std" => "#ffffff",
            "type" => "color");

       $of_options[] = array( "name" => "Full Width Border Size",
            "desc" => "Controls the border size of the full width section.",
            "id" => "full_width_border_size",
            "std" => "0px",
            "type" => "text");

       $of_options[] = array( "name" => "Full Width Border Color",
            "desc" => "Controls the border color of the full width section.",
            "id" => "full_width_border_color",
            "std" => "#eae9e9",
            "type" => "color");

        $of_options[] = array( "name" => "Full Width Shortcode",
            "desc" => "",
            "id" => "fullwidth_shortcode",
            "std" => "<h3 style='margin: 0;'>Full Width Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Icon Shortcode",
            "desc" => "",
            "id" => "icon_shortcode",
            "std" => "<h3 style='margin: 0;'>Icon Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Icon Circle Background Color",
            "desc" => "Controls the color of the circle when used with icons.",
            "id" => "icon_circle_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Icon Circle Border Color",
            "desc" => "Controls the color of the circle border when used with icons.",
            "id" => "icon_border_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Icon Color",
            "desc" => "Controls the color of the icons.",
            "id" => "icon_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" => "Icon Shortcode",
            "desc" => "",
            "id" => "icon_shortcode",
            "std" => "<h3 style='margin: 0;'>Icon Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Image Frame Shortcode",
            "desc" => "",
            "id" => "imgf_shortcode",
            "std" => "<h3 style='margin: 0;'>Image Frame Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Image Frame Border Color",
            "desc" => "Controls the border color of the image frame.",
            "id" => "imgframe_border_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" => "Image Frame Border Size",
            "desc" => "Controls the border size of the image.",
            "id" => "imageframe_border_size",
            "std" => "0",
            "type" => "text");

        $of_options[] = array( "name" =>  "Image Frame Style Color",
            "desc" => "Controls the style color of the image frame. Only works for glow and dropshadow style.",
            "id" => "imgframe_style_color",
            "std" => "#000000",
            "type" => "color");

        $of_options[] = array( "name" => "Image Frame Shortcode",
            "desc" => "",
            "id" => "imgf_shortcode",
            "std" => "<h3 style='margin: 0;'>Image Frame Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Modal Shortcode",
            "desc" => "",
            "id" => "modal_shortcode",
            "std" => "<h3 style='margin: 0;'>Modal Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

       $of_options[] = array( "name" => "Modal Background Color",
            "desc" => "Controls the background color of the modal popup box",
            "id" => "modal_bg_color",
            "std" => "#f6f6f6",
            "type" => "color");

       $of_options[] = array( "name" => "Modal Border Color",
            "desc" => "Controls the border color of the modal popup box",
            "id" => "modal_border_color",
            "std" => "#ebebeb",
            "type" => "color");

        $of_options[] = array( "name" => "Modal Shortcode",
            "desc" => "",
            "id" => "modal_shortcode",
            "std" => "<h3 style='margin: 0;'>Modal Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Person Shortcode",
            "desc" => "",
            "id" => "person_shortcode",
            "std" => "<h3 style='margin: 0;'>Person Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Person Border Size",
            "desc" => "Controls the border size of the image.",
            "id" => "person_border_size",
            "std" => "0",
            "type" => "text");

        $of_options[] = array( "name" => "Person Border Color",
            "desc" => "Controls the border color of the of the image.",
            "id" => "person_border_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" => "Person Style Color",
            "desc" => "For all style types except border. Controls the style color. ",
            "id" => "person_style_color",
            "std" => "#000000",
            "type" => "color");

        $of_options[] = array( "name" => "Person Shortcode",
            "desc" => "",
            "id" => "person_shortcode",
            "std" => "<h3 style='margin: 0;'>Person Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Popover Shortcode",
            "desc" => "",
            "id" => "popover_shortcode",
            "std" => "<h3 style='margin: 0;'>Popover Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Popover Heading Background Color",
            "desc" => "Controls the background color of popover heading area.",
            "id" => "popover_heading_bg_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" => "Popover Content Background Color",
            "desc" => "Controls the background color of popover content area.",
            "id" => "popover_content_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" => "Popover Border Color",
            "desc" => "Controls the border color of popover box.",
            "id" => "popover_border_color",
            "std" => "#ebebeb",
            "type" => "color");

        $of_options[] = array( "name" => "Popover Text Color",
            "desc" => "Controls the text color inside the popover box. ",
            "id" => "popover_text_color",
            "std" => "#747474",
            "type" => "color");
            
        $of_options[] = array( "name" => "Popover Position",
            "desc" => "Controls the position of the popover in reference to the triggering text.",
            "id" => "popover_placement",
            "std" => "Top",
            "type" => "select",
            "options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left' ));            

        $of_options[] = array( "name" => "Popover Shortcode",
            "desc" => "",
            "id" => "popover_shortcode",
            "std" => "<h3 style='margin: 0;'>Popover Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Pricing Table Shortcode",
            "desc" => "",
            "id" => "pricingtable_shortcode",
            "std" => "<h3 style='margin: 0;'>Pricing Table Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Pricing Box Style 1 Heading Color",
            "desc" => "Controls the heading color of full boxed pricing tables.",
            "id" => "full_boxed_pricing_box_heading_color",
            "std" => "#333333",
            "type" => "color");
        
        $of_options[] = array( "name" =>  "Pricing Box Style 2 Heading Color",
            "desc" => "Controls the heading color of separate pricing boxes.",
            "id" => "sep_pricing_box_heading_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Pricing Box Color",
            "desc" => "Controls the color portions of pricing boxes.",
            "id" => "pricing_box_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" =>  "Pricing Box Bg Color",
            "desc" => "Controls the color of main background and title background.",
            "id" => "pricing_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "Pricing Box Border Color",
            "desc" => "Controls the color of the outer border, pricing row and footer row backgrounds.",
            "id" => "pricing_border_color",
            "std" => "#f8f8f8",
            "type" => "color");

        $of_options[] = array( "name" =>  "Pricing Box Divider Color",
            "desc" => "Controls the color of the dividers in-between pricing rows.",
            "id" => "pricing_divider_color",
            "std" => "#ededed",
            "type" => "color");

        $of_options[] = array( "name" => "Pricing Table Shortcode",
            "desc" => "",
            "id" => "pricingtable_shortcode",
            "std" => "<h3 style='margin: 0;'>Pricing Table Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Progress Bar Shortcode",
            "desc" => "",
            "id" => "progressbar_shortcode",
            "std" => "<h3 style='margin: 0;'>Progress Bar Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Progress Bar Filled Color",
            "desc" => "Controls the color of the filled area in progress bars.",
            "id" => "progressbar_filled_color",
            "std" => "#a0ce4e",
            "type" => "color");

        $of_options[] = array( "name" =>  "Progress Bar Unfilled Color",
            "desc" => "Controls the color of the unfilled area in progress bars.",
            "id" => "progressbar_unfilled_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" =>  "Progress Bar Text Color",
            "desc" => "Controls the color of the text in progress bars.",
            "id" => "progressbar_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" => "Progress Bar Shortcode",
            "desc" => "",
            "id" => "progressbar_shortcode",
            "std" => "<h3 style='margin: 0;'>Progress Bar Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Separator Shortcode",
            "desc" => "",
            "id" => "separator_shortcode",
            "std" => "<h3 style='margin: 0;'>Separator Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Separators Color",
            "desc" => "Controls the color of all separators, divider lines and borders for meta, previous & next, filters, category page, boxes around number pagination, sidebar widgets, accordion divider lines, counter boxes and more.",
            "id" => "sep_color",
            "std" => "#e0dede",
            "type" => "color");

        $of_options[] = array( "name" => "Separator Shortcode",
            "desc" => "",
            "id" => "separator_shortcode",
            "std" => "<h3 style='margin: 0;'>Separator Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Section Separator Shortcode",
            "desc" => "",
            "id" => "sectionseparator_shortcode",
            "std" => "<h3 style='margin: 0;'>Section Separator Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Section Separator Border Size",
            "desc" => "Controls the border size of the section separator.",
            "id" => "section_sep_border_size",
            "std" => "1px",
            "type" => "text");


        $of_options[] = array( "name" =>  "Section Separator Background Color of Divider Candy",
            "desc" => "Controls the background color of the divider candy.",
            "id" => "section_sep_bg",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" =>  "Section Separator Border Color",
            "desc" => "Controls the border color of the separator.",
            "id" => "section_sep_border_color",
            "std" => '#f6f6f6',
            "type" => "color");

       $of_options[] = array( "name" => "Section Separator Shortcode",
            "desc" => "",
            "id" => "sectionseparator_shortcode",
            "std" => "<h3 style='margin: 0;'>Section Separator Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Sharing Box Shortcode",
            "desc" => "",
            "id" => "sharingbox_shortcode",
            "std" => "<h3 style='margin: 0;'>Sharing Box Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Sharing Box Background Color",
            "desc" => "Controls the background color of the sharing box.",
            "id" => "sharing_box_bg_color",
            "std" => '#f6f6f6',
            "type" => "color");

        $of_options[] = array( "name" =>  "Sharing Box Tagline Text Color",
            "desc" => "Controls the text color of the tagline text.",
            "id" => "sharing_box_tagline_text_color",
            "std" => '#333333',
            "type" => "color");

       $of_options[] = array( "name" => "Sharing Box Shortcode",
            "desc" => "",
            "id" => "sharingbox_shortcode",
            "std" => "<h3 style='margin: 0;'>Sharing Box Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Social Links Shortcode",
            "desc" => "",
            "id" => "sociallinks_shortcode",
            "std" => "<h3 style='margin: 0;'>Social Links Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Social Links Custom Icons Color",
            "desc" => "Select a custom social icon color.",
            "id" => "social_links_icon_color",
            "std" => "#bebdbd",
            "type" => "color");

        $of_options[] = array( "name" => "Social Links Icons Boxed",
            "desc" => "Controls the color of the social icons in the sharing box.",
            "id" => "social_links_boxed",
            "std" => "No",
            "type" => "select",
            "options" => array('No' => 'No', 'Yes' => 'Yes'));

        $of_options[] = array( "name" =>  "Social Links Icons Custom Box Color",
            "desc" => "Select a custom social icon box color.",
            "id" => "social_links_box_color",
            "std" => "#e8e8e8",
            "type" => "color");

        $of_options[] = array( "name" => "Social Links Icons Boxed Radius",
            "desc" => "Boxradius for the social icons. In pixels, ex: 4px.",
            "id" => "social_links_boxed_radius",
            "std" => "4px",
            "type" => "text");

        $of_options[] = array( "name" => "Social Links Icons Tooltip Position",
            "desc" => "Controls the tooltip position of the social icons in the sharing box.",
            "id" => "social_links_tooltip_placement",
            "std" => "Top",
            "type" => "select",
            "options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

       $of_options[] = array( "name" => "Social Links Shortcode",
            "desc" => "",
            "id" => "sociallinks_shortcode",
            "std" => "<h3 style='margin: 0;'>Social Links Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Tabs Shortcode",
            "desc" => "",
            "id" => "tabs_shortcode",
            "std" => "<h3 style='margin: 0;'>Tabs Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Tabs Background Color + Hover Color",
            "desc" => "Controls the color of the active tab, content background color and tab hover.",
            "id" => "tabs_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array( "name" =>  "Tabs Inactive Color",
            "desc" => "Controls the color of the inactive tabs and the outer tab border.",
            "id" => "tabs_inactive_color",
            "std" => "#ebeaea",
            "type" => "color");

       $of_options[] = array( "name" => "Tabs Shortcode",
            "desc" => "",
            "id" => "tabs_shortcode",
            "std" => "<h3 style='margin: 0;'>Tabs Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Tagline Shortcode",
            "desc" => "",
            "id" => "tagline_shortcode",
            "std" => "<h3 style='margin: 0;'>Tagline Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" => "Tagline Box Background Color",
            "desc" => "Controls the background color of the tagline box.",
            "id" => "tagline_bg",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" =>  "Tagline Box Border Color",
            "desc" => "Controls the border color of the tagline box.",
            "id" => "tagline_border_color",
            "std" => "#f6f6f6",
            "type" => "color");

       $of_options[] = array( "name" => "Tagline Shortcode",
            "desc" => "",
            "id" => "tagline_shortcode",
            "std" => "<h3 style='margin: 0;'>Tagline Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

       $of_options[] = array( "name" => "Testimonials Shortcode",
            "desc" => "",
            "id" => "testimonials_shortcode",
            "std" => "<h3 style='margin: 0;'>Testimonials Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Testimonial Background Color",
            "desc" => "Controls the background color of the testimonial.",
            "id" => "testimonial_bg_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" =>  "Testimonial Text Color",
            "desc" => "Controls the text color of the testimonial font.",
            "id" => "testimonial_text_color",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" => "Testimonials Speed",
            "desc" => "Select the slideshow speed, 1000 = 1 second.",
            "id" => "testimonials_speed",
            "std" => "4000",
            "type" => "text");
        
       $of_options[] = array( "name" => "Testimonials Shortcode",
            "desc" => "",
            "id" => "testimonials_shortcode",
            "std" => "<h3 style='margin: 0;'>Testimonials Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Title Shortcode",
            "desc" => "",
            "id" => "title_shortcode",
            "std" => "<h3 style='margin: 0;'>Title Shortcode</h3>",
            "position" => "start",
            "type" => "accordion");

        $of_options[] = array( "name" =>  "Title Separator Color",
            "desc" => "Controls the color of the title separators",
            "id" => "title_border_color",
            "std" => "#e0dede",
            "type" => "color");

        $of_options[] = array( "name" => "Title Shortcode",
            "desc" => "",
            "id" => "title_shortcode",
            "std" => "<h3 style='margin: 0;'>Title Shortcode</h3>",
            "position" => "end",
            "type" => "accordion");

        $of_options[] = array( "name" => "Blog",
            "type" => "heading");

        $of_options[] = array( "name" => "General Blog Options",
            "desc" => "",
            "id" => "blog_single_post",
            "std" => "<h3 style='margin: 0;'>General Blog Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Blog Page Title",
            "desc" => "This text will display in the page title bar of the assigned blog page.",
            "id" => "blog_title",
            "std" => "Blog",
            "type" => "text");

        $of_options[] = array( "name" => "Blog Page Subtitle",
            "desc" => "This text will display as subheading in the page title bar of the assigned blog page.",
            "id" => "blog_subtitle",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Blog Layout",
            "desc" => "Select the layout for the assigned blog page in settings > reading.",
            "id" => "blog_layout",
            "std" => "Large",
            "type" => "select",
            "options" => array(
                'Large' => 'Large',
                'Medium' => 'Medium',
                'Large Alternate' => 'Large Alternate',
                'Medium Alternate' => 'Medium Alternate',
                'Grid' => 'Grid',
                'Timeline' => 'Timeline'
            ));

        $of_options[] = array( "name" => "Blog Sidebar Position",
            "desc" => "Select the sidebar position for the blog pages.",
            "id" => "blog_sidebar_position",
            "std" => "Right",
            "type" => "select",
            "options" => array(
                'Right' => 'Right',
                'Left' => 'Left',
            ));

        $of_options[] = array( "name" => "Blog Archive/Category Layout",
            "desc" => "Select the layout for the blog archive/category pages.",
            "id" => "blog_archive_layout",
            "std" => "Large",
            "type" => "select",
            "options" => array(
                'Large' => 'Large',
                'Medium' => 'Medium',
                'Large Alternate' => 'Large Alternate',
                'Medium Alternate' => 'Medium Alternate',
                'Grid' => 'Grid',
                'Timeline' => 'Timeline'
            ));

        $of_options[] = array( "name" => "Blog Archive/Author/Category Sidebar",
            "desc" => "Select the sidebar that will display on the archive/category pages.",
            "id" => "blog_archive_sidebar",
            "std" => "None",
            "type" => "select",
            "options" => $sidebar_options
        );

        $of_options[] = array( "name" => "Pagination Type",
            "desc" => "Select the pagination type for the assigned blog page in settings > reading.",
            "id" => "blog_pagination_type",
            "std" => "pagination",
            "type" => "select",
            "options" => array(
                'Pagination' => 'Pagination',
                'Infinite Scroll' => 'Infinite Scroll',
            ));

        $of_options[] = array( "name" => "Grid Layout # of Columns",
            "desc" => "Select whether to display the grid layout in 2, 3 or 4 columns.",
            "id" => "blog_grid_columns",
            "std" => "3",
            "type" => "select",
            "options" => array(
            	'2' => '2',
                '3' => '3',
                '4' => '4',
            ));

        $of_options[] = array( "name" => "Excerpt or Full Blog Content",
            "desc" => "Choose to display an excerpt or full content on blog pages.",
            "id" => "content_length",
            "std" => "Excerpt",
            "type" => "select",
            "options" => array('Excerpt' => 'Excerpt', 'Full Content' => 'Full Content'));

        $of_options[] = array( "name" => "Excerpt Length",
            "desc" => "Insert the number of words you want to show in the post excerpts.",
            "id" => "excerpt_length_blog",
            "std" => "55",
            "type" => "text");

        $of_options[] = array( "name" => "Strip HTML from Excerpt",
            "desc" => "Check the box if you want to strip HTML from the excerpt content only.",
            "id" => "strip_html_excerpt",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Full Width",
            "desc" => "Check the box to turn the blog into full width with no sidebar.",
            "id" => "blog_full_width",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Set All Post Items Full Width",
            "desc" => "Check the box to turn all single post items to full width with no sidebar.",
            "id" => "single_post_full_width",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Featured Image On Blog Archive Page",
            "desc" => "Check the box to display featured images on blog archive page.",
            "id" => "featured_images",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Blog Alternate Date Format - Month and Year",
            "desc" => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
            "id" => "alternate_date_format_month_year",
            "std" => "m, Y",
            "type" => "text");

        $of_options[] = array( "name" => "Blog Alternate Date Format - Day",
            "desc" => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
            "id" => "alternate_date_format_day",
            "std" => "j",
            "type" => "text");

        $of_options[] = array( "name" => "Blog Timeline Date Format - Timeline Labels",
            "desc" => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date</a>",
            "id" => "timeline_date_format",
            "std" => "F Y",
            "type" => "text");

        $of_options[] = array( "name" => "Blog Single Post",
            "desc" => "",
            "id" => "blog_single_post",
            "std" => "<h3 style='margin: 0;'>Blog Single Post Page Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Featured Image / Video on Single Post Page",
            "desc" => "Check the box to display featured images and videos on single post pages.",
            "id" => "featured_images_single",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Previous/Next Pagination",
            "desc" => "Check the box to disable previous/next pagination.",
            "id" => "blog_pn_nav",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Post Title",
            "desc" => "Check the box to display the post title that goes below the featured images.",
            "id" => "blog_post_title",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Author Info Box",
            "desc" => "Check the box to display the author info box below posts.",
            "id" => "author_info",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Social Sharing Box",
            "desc" => "Check the box to display the social sharing box.",
            "id" => "social_sharing_box",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Related Posts",
            "desc" => "Check the box to display related posts.",
            "id" => "related_posts",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Comments",
            "desc" => "Check the box to display comments.",
            "id" => "blog_comments",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Blog Meta",
            "desc" => "",
            "id" => "blog_meta",
            "std" => "<h3 style='margin: 0;'>Blog Meta Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Post Meta",
            "desc" => "Check the box to display post meta on blog posts.",
            "id" => "post_meta",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Post Meta Author",
            "desc" => "Check the box to hide the author name from post meta.",
            "id" => "post_meta_author",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Post Meta Date",
            "desc" => "Check the box to hide the date from post meta.",
            "id" => "post_meta_date",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Post Meta Categories",
            "desc" => "Check the box to hide the categories from post meta.",
            "id" => "post_meta_cats",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Post Meta Comments",
            "desc" => "Check the box to hide the comments from post meta.",
            "id" => "post_meta_comments",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Post Meta Read More Link",
            "desc" => "Check the box to hide the read more link from post meta.",
            "id" => "post_meta_read",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Post Meta Tags",
            "desc" => "Check the box to hide the tags from post meta.",
            "id" => "post_meta_tags",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Date Format",
            "desc" => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
            "id" => "date_format",
            "std" => "F jS, Y",
            "type" => "text");

        $of_options[] = array( "name" => "Portfolio",
            "type" => "heading");

        $of_options[] = array( "name" => "General Portfolio Options",
            "desc" => "",
            "id" => "blog_single_post",
            "std" => "<h3 style='margin: 0;'>General Portfolio Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Number of Portfolio Items Per Page",
            "desc" => "Insert the number of posts to display per page.",
            "id" => "portfolio_items",
            "std" => "10",
            "type" => "text");

        $of_options[] = array( "name" => "Portfolio Archive/Category Layout",
            "desc" => "Select the layout for only the archive/category pages.",
            "id" => "portfolio_archive_layout",
            "std" => "Portfolio One Column",
            "type" => "select",
            "options" => array(
                'Portfolio One Column' => 'Portfolio One Column',
                'Portfolio Two Column' => 'Portfolio Two Column',
                'Portfolio Three Column' => 'Portfolio Three Column',
                'Portfolio Four Column' => 'Portfolio Four Column',
                'Portfolio One Column Text' => 'Portfolio One Column Text',
                'Portfolio Two Column Text' => 'Portfolio Two Column Text',
                'Portfolio Three Column Text' => 'Portfolio Three Column Text',
                'Portfolio Four Column Text' => 'Portfolio Four Column Text',
                'Portfolio Grid' => 'Portfolio Grid',
            ));

        $of_options[] = array( "name" => "Portfolio Archive/Category Sidebar",
            "desc" => "Select the sidebar that will be added to the archive/category pages.",
            "id" => "portfolio_archive_sidebar",
            "std" => "None",
            "type" => "select",
            "options" => $sidebar_options
        );

        $of_options[] = array( "name" => "Excerpt or Full Portfolio Content",
            "desc" => "Choose to display an excerpt or full portfolio content on archive / portfolio pages. Note: The \"Full Content\" option will override the page excerpt settings.",
            "id" => "portfolio_content_length",
            "std" => "Excerpt",
            "type" => "select",
            "options" => array('Excerpt' => 'Excerpt', 'Full Content' => 'Full Content'));

        $of_options[] = array( "name" => "Excerpt Length",
            "desc" => "Insert the number of words you want to show in the post excerpts.",
            "id" => "excerpt_length_portfolio",
            "std" => "55",
            "type" => "text");

        $of_options[] = array( "name" => "Grid Pagination Type",
            "desc" => "Select the pagination type for Portfolio Grid layouts.",
            "id" => "grid_pagination_type",
            "std" => "pagination",
            "type" => "select",
            "options" => array(
                'Pagination' => 'Pagination',
                'Infinite Scroll' => 'Infinite Scroll',
            ));

        $of_options[] = array( "name" => "Portfolio Slug",
            "desc" => "Change/Rewrite the permalink when you use the permalink type as %postname%. <strong>Make sure to regenerate permalinks.</strong>",
            "id" => "portfolio_slug",
            "std" => "portfolio-items",
            "type" => "text");

        $of_options[] = array( "name" => "Portfolio Single Post Page Options",
            "desc" => "",
            "id" => "blog_single_post",
            "std" => "<h3 style='margin: 0;'>Portfolio Single Post Page Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Featured Image / Video on Single Post Page",
            "desc" => "Check the box to display featured images and videos on single post pages.",
            "id" => "portfolio_featured_images",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Previous/Next Pagination",
            "desc" => "Check the box to disable previous/next pagination.",
            "id" => "portfolio_pn_nav",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Comments",
            "desc" => "Check the box to enable comments on portfolio items.",
            "id" => "portfolio_comments",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Author",
            "desc" => "Check the box to enable Author on portfolio items.",
            "id" => "portfolio_author",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Social Sharing Box",
            "desc" => "Check the box to display the social sharing box.",
            "id" => "portfolio_social_sharing_box",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Related Posts",
            "desc" => "Check the box to display related posts.",
            "id" => "portfolio_related_posts",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Social Sharing Box",
            "type" => "heading");

        $of_options[] = array( "name" => "Social Share Box Icon Options",
            "desc" => "",
            "id" => "social_share_box_icon_options_title",
            "std" => "<h3 style='margin: 0;'>Social Share Box Icon Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" =>  "Social Share Box Background Color",
            "desc" => "Controls the background color of the social share box.",
            "id" => "social_bg_color",
            "std" => "#f6f6f6",
            "type" => "color");

        $of_options[] = array( "name" =>  "Social Sharing Box Custom Icons Color",
            "desc" => "Select a custom social icon color.",
            "id" => "sharing_social_links_icon_color",
            "std" => "#bebdbd",
            "type" => "color");

        $of_options[] = array( "name" => "Social Sharing Box Icons Boxed",
            "desc" => "Controls the color of the social icons in the sharing box.",
            "id" => "sharing_social_links_boxed",
            "std" => "No",
            "type" => "select",
            "options" => array('No' => 'No', 'Yes' => 'Yes'));

        $of_options[] = array( "name" =>  "Social Sharing Box Icons Custom Box Color",
            "desc" => "Select a custom social icon box color.",
            "id" => "sharing_social_links_box_color",
            "std" => "#e8e8e8",
            "type" => "color");

        $of_options[] = array( "name" => "Social Sharing Box Icons Boxed Radius",
            "desc" => "Boxradius for the social icons. In pixels, ex: 4px.",
            "id" => "sharing_social_links_boxed_radius",
            "std" => "4px",
            "type" => "text");

        $of_options[] = array( "name" => "Social Sharing Box Icons Tooltip Position",
            "desc" => "Controls the tooltip position of the social icons in the sharing box.",
            "id" => "sharing_social_links_tooltip_placement",
            "std" => "Top",
            "type" => "select",
            "options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

        $of_options[] = array( "name" => "Social Share Box Links",
            "desc" => "",
            "id" => "social_share_box_links_title",
            "std" => "<h3 style='margin: 0;'>Social Share Box Links</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Facebook",
            "desc" => "Check the box to show the facebook sharing icon in blog posts.",
            "id" => "sharing_facebook",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Twitter",
            "desc" => "Check the box to show the twitter sharing icon in blog posts.",
            "id" => "sharing_twitter",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Reddit",
            "desc" => "Check the box to show the reddit sharing icon in blog posts.",
            "id" => "sharing_reddit",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "LinkedIn",
            "desc" => "Check the box to show the linkedin sharing icon in blog posts.",
            "id" => "sharing_linkedin",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Google Plus",
            "desc" => "Check the box to show the g+ sharing icon in blog posts.",
            "id" => "sharing_google",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Tumblr",
            "desc" => "Check the box to show the tumblr sharing icon in blog posts.",
            "id" => "sharing_tumblr",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Pinterest",
            "desc" => "Check the box to show the pinterest sharing icon in blog posts.",
            "id" => "sharing_pinterest",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Email",
            "desc" => "Check the box to show the email sharing icon in blog posts.",
            "id" => "sharing_email",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Social Media",
            "type" => "heading");

        $social_links[] = array( "name" => "Facebook",
            "desc" => "Insert your custom link to show the Facebook icon. Leave blank to hide icon.",
            "id" => "facebook_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Flickr",
            "desc" => "Insert your custom link to show the Flickr icon. Leave blank to hide icon.",
            "id" => "flickr_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "RSS",
            "desc" => "Insert your custom link to show the RSS icon. Leave blank to hide icon.",
            "id" => "rss_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Twitter",
            "desc" => "Insert your custom link to show the Twitter icon. Leave blank to hide icon.",
            "id" => "twitter_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Vimeo",
            "desc" => "Insert your custom link to show the Vimeo icon. Leave blank to hide icon.",
            "id" => "vimeo_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Youtube",
            "desc" => "Insert your custom link to show the Youtube icon. Leave blank to hide icon.",
            "id" => "youtube_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Instagram",
            "desc" => "Insert your custom link to show the Instagram icon. Leave blank to hide icon.",
            "id" => "instagram_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Pinterest",
            "desc" => "Insert your custom link to show the Pinterest icon. Leave blank to hide icon.",
            "id" => "pinterest_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Tumblr",
            "desc" => "Insert your custom link to show the Tumblr icon. Leave blank to hide icon.",
            "id" => "tumblr_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Google+",
            "desc" => "Insert your custom link to show the Google+ icon. Leave blank to hide icon.",
            "id" => "google_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Dribbble",
            "desc" => "Insert your custom link to show the Dribbble icon. Leave blank to hide icon.",
            "id" => "dribbble_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Digg",
            "desc" => "Insert your custom link to show the Digg icon. Leave blank to hide icon.",
            "id" => "digg_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "LinkedIn",
            "desc" => "Insert your custom link to show the LinkedIn icon. Leave blank to hide icon.",
            "id" => "linkedin_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Blogger",
            "desc" => "Insert your custom link to show the Blogger icon. Leave blank to hide icon.",
            "id" => "blogger_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Skype",
            "desc" => "Insert your custom link to show the Skype icon. Leave blank to hide icon.",
            "id" => "skype_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Forrst",
            "desc" => "Insert your custom link to show the Forrst icon. Leave blank to hide icon.",
            "id" => "forrst_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Myspace",
            "desc" => "Insert your custom link to show the Myspace icon. Leave blank to hide icon.",
            "id" => "myspace_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Deviantart",
            "desc" => "Insert your custom link to show the Deviantart icon. Leave blank to hide icon.",
            "id" => "deviantart_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Yahoo",
            "desc" => "Insert your custom link to show the Yahoo icon. Leave blank to hide icon.",
            "id" => "yahoo_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Reddit",
            "desc" => "Insert your custom link to show the Redditt icon. Leave blank to hide icon.",
            "id" => "reddit_link",
            "std" => "",
            "type" => "text");
            
        $social_links[] = array( "name" => "Paypal",
            "desc" => "Insert your custom link to show the Paypal icon. Leave blank to hide icon.",
            "id" => "paypal_link",
            "std" => "",
            "type" => "text");    
            
        $social_links[] = array( "name" => "Dropbox",
            "desc" => "Insert your custom link to show the Dropbox icon. Leave blank to hide icon.",
            "id" => "dropbox_link",
            "std" => "",
            "type" => "text");    
            
        $social_links[] = array( "name" => "Soundclound",
            "desc" => "Insert your custom link to show the Soundcloud icon. Leave blank to hide icon.",
            "id" => "soundcloud_link",
            "std" => "",
            "type" => "text");                
            
        $social_links[] = array( "name" => "VK",
            "desc" => "Insert your custom link to show the VK icon. Leave blank to hide icon.",
            "id" => "vk_link",
            "std" => "",
            "type" => "text");

        $social_links[] = array( "name" => "Email Address",
            "desc" => "Insert your custom link to show the mail icon. Leave blank to hide icon.",
            "id" => "email_link",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "",
            "desc" => "",
            "id" => "social_sorter",
            "std" => "",
            "type" => "fusion_sorter",
            "fields" => $social_links,
        );

        $of_options[] = array( "name" => "Custom Social Icon",
            "desc" => "",
            "id" => "custom_color_scheme_element",
            "std" => "<h3 style='margin: 0;'>Custom Social Icon</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Custom Icon Name",
            "desc" => "This is the icon name that shows in the hover tooltip.",
            "id" => "custom_icon_name",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Custom Icon Image",
            "desc" => "Select an image file for your custom icon.",
            "id" => "custom_icon_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "Custom Icon Image Retina",
            "desc" => "Select an image file for the retina version of the icon. It should be 2x the size of main icon.",
            "id" => "custom_icon_image_retina",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array( "name" => "Standard Icon Width for Retina Icon",
            "desc" => "If retina icon is added, enter the standard icon (1x) version width, do not enter the retina icon width.",
            "id" => "retina_icon_width",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Standard Icon Height for Retina Icon",
            "desc" => "If retina icon is added, enter the standard icon (1x) version height, do not enter the retina icon height.",
            "id" => "retina_icon_height",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Custom Icon Link",
            "desc" => "Insert a link for your custom icon.",
            "id" => "custom_icon_link",
            "std" => "",
            "type" => "text");        

        $of_options[] = array( "name" => "Slideshows",
            "type" => "heading");

        $of_options[] = array( "name" => "Posts Slideshow Images",
            "desc" => "This option controls the number of featured image boxes for blog/portfolio slideshows.",
            "id" => "posts_slideshow_number",
            "std" => "5",
            "type" => "text");

        $of_options[] = array( "name" => "Autoplay",
            "desc" => "Check the box to autoplay the slideshow.",
            "id" => "slideshow_autoplay",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable Smooth Height",
            "desc" => "Check the box to enable smooth height on slideshows when using images with different heights. Please note, smooth height is disabled on blog grid layout.",
            "id" => "slideshow_smooth_height",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Slideshow speed",
            "desc" => "Controls the speed of slideshows for the [slider] shortcode and sliders within posts. ex: 1000 = 1 second.",
            "id" => "slideshow_speed",
            "std" => "7000",
            "type" => "text");

        $of_options[] = array( "name" => "Pagination circles below video slides",
            "desc" => "Check the box if you want to show pagination circles below a video slide for the slider shortcode. Leave it unchecked to hide them on video slides.",
            "id" => "pagination_video_slide",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "<strong>Deprecated</strong>: Legacy Posts Slideshow",
            "desc" => "Check the box to enable posts slideshow in legacy mode. Only recommended for v.1 users, this option will disable the multiple featured image method.<strong>This option will be removed in next update.</strong>",
            "id" => "legacy_posts_slideshow",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Deprecated: Posts Slideshow",
            "desc" => "Check the box to show post slideshows in blog/portfolio pages. <strong>This option will be removed in next update.</strong>",
            "id" => "posts_slideshow",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Elastic Slider",
            "type" => "heading");

        $of_options[] = array( "name" => "Slider Width",
            "desc" => "In pixels or percentage, ex: 100% or 100.",
            "id" => "tfes_slider_width",
            "std" => "100%",
            "type" => "text");

        $of_options[] = array( "name" => "Slider Height",
            "desc" => "In pixels, ex: 100px.",
            "id" => "tfes_slider_height",
            "std" => "400px",
            "type" => "text");

        $of_options[] = array( "name" => "Animation",
            "desc" => "Slides animate from sides or center.",
            "id" => "tfes_animation",
            "std" => "sides",
            "options" => array('sides' => 'sides', 'center' => 'center'),
            "type" => "select");

        $of_options[] = array( "name" => "Autoplay",
            "desc" => "Check the box to autoplay the slides.",
            "id" => "tfes_autoplay",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Slideshow Interval",
            "desc" => "Select the slideshow speed, 1000 = 1 second.",
            "id" => "tfes_interval",
            "std" => "3000",
            "type" => "text");

        $of_options[] = array( "name" => "Sliding Speed",
            "desc" => "Select the animation speed, 1000 = 1 second.",
            "id" => "tfes_speed",
            "std" => "800",
            "type" => "text");

        $of_options[] = array( "name" => "Thumbnail Width",
            "desc" => "Enter the width for thumbnail without 'px' ex: 100.",
            "id" => "tfes_width",
            "std" => "150",
            "type" => "text");

        $of_options[] = array( "name" => "Title Font Size (px)",
            "desc" => "Default is 42",
            "id" => "es_title_font_size",
            "std" => "42",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" => "Caption Font Size (px)",
            "desc" => "Default is 20",
            "id" => "es_caption_font_size",
            "std" => "20",
            "type" => "select",
            "options" => $font_sizes);

        $of_options[] = array( "name" =>  "Title Color",
            "desc" => "Controls the text color of the title font.",
            "id" => "es_title_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array( "name" =>  "Caption Color",
            "desc" => "Controls the text color of the caption font.",
            "id" => "es_caption_color",
            "std" => "#747474",
            "type" => "color");

        $of_options[] = array( "name" => "Lightbox",
            "type" => "heading");

        $of_options[] = array( "name" => "Animation Speed",
            "desc" => "Set the speed of the animation.",
            "id" => "lightbox_animation_speed",
            "std" => "fast",
            "type" => "select",
            "options" => array('Fast' => 'Fast', 'Slow' => 'Slow', 'Normal' => 'Normal'));

        $of_options[] = array( "name" => "Show gallery",
            "desc" => "Check the box to show the gallery.",
            "id" => "lightbox_gallery",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Autoplay the Lightbox Gallery",
            "desc" => "Check the box to autoplay the lightbox gallery.",
            "id" => "lightbox_autoplay",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Slideshow Speed",
            "desc" => "If autoplay is enabled, set the slideshow speed, 1000 = 1 second.",
            "id" => "lightbox_slideshow_speed",
            "std" => "5000",
            "type" => "text");

        $of_options[] = array( "name" => "Background Opacity",
            "desc" => "Set the opacity of background, <br />0.1 (lowest) to 1 (highest).",
            "id" => "lightbox_opacity",
            "std" => "0.8",
            "type" => "text");

        $of_options[] = array( "name" => "Show Caption",
            "desc" => "Check the box to show the image caption.",
            "id" => "lightbox_title",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Description",
            "desc" => "Check the box to show the image description. The Alternative text field is used for the description.",
            "id" => "lightbox_desc",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Social Sharing",
            "desc" => "Check the box to show social sharing buttons on lightbox.",
            "id" => "lightbox_social",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Post Images in Lightbox",
            "desc" => "Check the box to show post images that are inside the post content area in the lightbox.",
            "id" => "lightbox_post_images",
            "std" => 0,
            "type" => "checkbox");

// Theme Specific Options
        $of_options[] = array( "name" => "Contact",
            "type" => "heading");

        $of_options[] = array( "name" => "Google Map",
            "desc" => "",
            "id" => "google_map",
            "std" => "<h3 style='margin: 0;'>Google Map Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Google Map Type",
            "desc" => "Select the type of google map to show on the contact page.",
            "id" => "gmap_type",
            "std" => "roadmap",
            "options" => array('roadmap' => 'roadmap', 'satellite' => 'satellite', 'hybrid' => 'hybrid', 'terrain' => 'terrain'),
            "type" => "select");

        $of_options[] = array( "name" => "Google Map Width",
            "desc" => "In pixels or percentage, ex: 100% or 100px.",
            "id" => "gmap_width",
            "std" => "100%",
            "type" => "text");

        $of_options[] = array( "name" => "Google Map Height",
            "desc" => "In pixels, ex: 100px.",
            "id" => "gmap_height",
            "std" => "415px",
            "type" => "text");

        $of_options[] = array( "name" => "Google Map Top Margin",
            "desc" => "This will only be applied to maps that are not 100% width. It controls the distance to menu/page title. In pixels, ex: 100px.",
            "id" => "gmap_topmargin",
            "std" => "55px",
            "type" => "text");

        $of_options[] = array( "name" => "Google Map Address",
            "desc" => "Single address ex: 775 New York Ave, Brooklyn, Kings, New York 11203. <br />For multiple markers, separate the addresses with the | symbol.<br /> ex: Address 1|Address 2|Address 3.",
            "id" => "gmap_address",
            "std" => "775 New York Ave, Brooklyn, Kings, New York 11203",
            "type" => "textarea");

        $of_options[] = array( "name" => "Email Address",
            "desc" => "Enter the email adress the form will be sent to.",
            "id" => "email_address",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "Map Zoom Level",
            "desc" => "Higher number will be more zoomed in.",
            "id" => "map_zoom_level",
            "std" => "8",
            "type" => "text");

        $of_options[] = array( "name" => "Hide Address Pin",
            "desc" => "Check the box to hide the address pin.",
            "id" => "map_pin",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Map Popup On Click",
            "desc" => "Check the box to keep the popup graphic with address info hidden when the google map loads. It will only show when the pin on the map is clicked.",
            "id" => "map_popup",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Map Scrollwheel",
            "desc" => "Check the box to disable scrollwheel on google maps.",
            "id" => "map_scrollwheel",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Map Scale",
            "desc" => "Check the box to disable scale on google maps.",
            "id" => "map_scale",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Map Zoom & Pan Control Icons",
            "desc" => "Check the box to disable zoom control icon and pan control icon on google maps.",
            "id" => "map_zoomcontrol",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Google Map Design Styling",
            "desc" => "",
            "id" => "google_map",
            "std" => "<h3 style='margin: 0;'>Google Map Design Styling</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Select the Map Styling",
            "desc" => "Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.",
            "id" => "map_styling",
            "std" => "default",
            "options" => array('default' => 'Default Styling', 'theme' => 'Theme Styling', 'custom' => 'Custom Styling'),
            "type" => "select");

        $of_options[] = array( "name" =>  "Map Overlay Color",
            "desc" => "Custom styling setting only. Pick an overlaying color for the map. Works best with \"roadmap\" type.",
            "id" => "map_overlay_color",
            "std" => "",
            "type" => "color");

        $of_options[] = array( "name" => "Info Box Styling",
            "desc" => "Custom styling setting only. Choose between default or custom info box.",
            "id" => "map_infobox_styling",
            "std" => "default",
            "options" => array('default' => 'Default Infobox', 'custom' => 'Custom Infobox'),
            "type" => "select");

        $of_options[] = array( "name" => "Info Box Content",
            "desc" => "Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3",
            "id" => "map_infobox_content",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array( "name" =>  "Info Box Background Color",
            "desc" => "Custom styling setting only. Pick a color for the info box background.",
            "id" => "map_infobox_bg_color",
            "std" => "",
            "type" => "color");

        $of_options[] = array( "name" =>  "Info Box Text Color",
            "desc" => "Custom styling setting only. Pick a color for the info box text.",
            "id" => "map_infobox_text_color",
            "std" => "",
            "type" => "color");

        $of_options[] = array( "name" => "Custom Marker Icon",
            "desc" => "Custom styling setting only. Use full image urls for custom marker icons or input \"theme\" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3",
            "id" => "map_custom_marker_icon",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array( "name" => "ReCaptcha",
            "desc" => "",
            "id" => "recaptcha",
            "std" => "<h3 style='margin: 0;'>ReCaptcha Spam Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "ReCaptcha Public Key",
            "desc" => "Follow the steps in <a href='http://theme-fusion.com/avada-doc/pages/setting-up-contact-page/'> our docs</a> to get key.",
            "id" => "recaptcha_public",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "ReCaptcha Private Key",
            "desc" => "Follow the steps in <a href='http://theme-fusion.com/avada-doc/pages/setting-up-contact-page/'> our docs</a> to get key.",
            "id" => "recaptcha_private",
            "std" => "",
            "type" => "text");

        $of_options[] = array( "name" => "ReCaptcha Color Scheme",
            "desc" => "Select the recaptcha color scheme.",
            "id" => "recaptcha_color_scheme",
            "std" => "Clean",
            "type" => "select",
            "options" => array('red' => 'red', 'blackglass' => 'blackglass', 'clean' => 'clean', 'white' => 'white'));

        $of_options[] = array( "name" => "Sidebar",
            "type" => "heading");

        $of_options[] = array( "name" =>  "Sidebar Background Color",
            "desc" => "Controls the background color of the sidebar.",
            "id" => "sidebar_bg_color",
            "std" => "transparent",
            "type" => "color");

        $of_options[] = array( "name" => "Content Area Width",
            "desc" => "Enter a value (based on percentage) without % sign, ex: 71.",
            "id" => "content_width",
            "std" => "71.1702128",
            "type" => "text");

        $of_options[] = array( "name" => "Sidebar Width",
            "desc" => "Enter a value (based on percentage) without % sign, ex: 23.",
            "id" => "sidebar_width",
            "std" => "23.4042553",
            "type" => "text");

        $of_options[] = array( "name" => "Sidebar Padding",
            "desc" => "Enter a value (based on percentage) without % sign, ex: 0.",
            "id" => "sidebar_padding",
            "std" => "0",
            "type" => "text");

        $of_options[] = array( "name" => "Sidebar Info",
            "desc" => "",
            "id" => "sidebar_info",
            "std" => "<h3 style='margin-top:0;'>Important Instructions For These Options:</h3><b>1.  100% </b>- Your values added up cannot go over 100% or your sidebar will not show.<br /></br />
<b>2. PADDING </b>-  Is always multiplied by 2 because it adds left and right padding. So a padding value of 5, actually equals 10.  And you should only use padding if you are using a background color that is different than your main background color.<br /></br />

<b>3.  UNSEEN SPACE</b> - You need to factor in the space between the Content Width &amp; Sidebar Width. This space does not have a field.<br /></br />

<b>EXAMPLE 1:</b> Content Width = 65 + Sidebar Width = 30  + Padding = 0
* this example adds up to 95% which leaves you 5% in between the content and sidebar sections. This is good to use if your sidebar background is the same color as your main background<br /></br />

<b>EXAMPLE 2:</b> Content Width = 60 + Sidebar Width = 30  + Padding = 2.5
* this example adds up to 95% which leaves you 5% in between the content and sidebar sections. This is good to use if your sidebar background is a different color than your main background",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Search Page",
            "type" => "heading");

        $of_options[] = array( "name" => "Search",
            "desc" => "",
            "id" => "search",
            "std" => "<h3 style='margin: 0;'>Search Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Search Results Layout",
            "desc" => "Select the layout for the search results page.",
            "id" => "search_layout",
            "std" => "Large",
            "type" => "select",
            "options" => array(
                'Large' => 'Large',
                'Medium' => 'Medium',
                'Large Alternate' => 'Large Alternate',
                'Medium Alternate' => 'Medium Alternate',
                'Grid' => 'Grid',
                'Timeline' => 'Timeline'
            ));

        $of_options[] = array( "name" => "Search Page Sidebar",
            "desc" => "Select the sidebar that will display on the search page.",
            "id" => "search_sidebar",
            "std" => "None",
            "type" => "select",
            "options" => $sidebar_options
        );

        $of_options[] = array( "name" => "Search Sidebar Position",
            "desc" => "Select the sidebar position for the search page.",
            "id" => "search_sidebar_position",
            "std" => "Right",
            "type" => "select",
            "options" => array(
                'Right' => 'Right',
                'Left' => 'Left',
            ));

        $of_options[] = array( "name" => "Search Results Content",
            "desc" => "Select the type of content to display in search results.",
            "id" => "search_content",
            "std" => "Posts and Pages",
            "type" => "select",
            "options" => array('Posts and Pages' => 'Posts and Pages', 'Only Posts' => 'Only Posts', 'Only Pages' => 'Only Pages'));

        $of_options[] = array( "name" => "Hide Search Results Excerpt",
            "desc" => "Check the box if you want to hide excerpt for search results.",
            "id" => "search_excerpt",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Number of Search Results Per Page",
            "desc" => "Set the number of search results per page.",
            "id" => "search_results_per_page",
            "std" => "10",
            "type" => "text");

        $of_options[] = array( "name" => "Hide Featured Images from Search Results",
            "desc" => "Check the box if you want to hide featured images for search results.",
            "id" => "search_featured_images",
            "std" => 0,
            "type" => "checkbox");

// Theme Specific Options
        $of_options[] = array( "name" => "Extra",
            "type" => "heading");

        $of_options[] = array( "name" => "Misc Options",
            "desc" => "",
            "id" => "misc_options",
            "std" => "<h3 style='margin: 0;'>Miscellaneous Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Default Sidebar Position",
            "desc" => "Select the default position of the sidebar. This will take effect for new pages/posts.",
            "id" => "default_sidebar_pos",
            "std" => "right",
            "options" => array('Right' => 'Right', 'Left' => 'Left'),
            "type" => "select");

        $of_options[] = array( "name" => "Sidenav Behavior",
            "desc" => "Controls the side navigation animation for child pages, on click or hover.",
            "id" => "sidenav_behavior",
            "std" => "hover",
            "options" => array('Hover' => 'Hover', 'Click' => 'Click'),
            "type" => "select");

        $of_options[] = array( "name" => "Number of Related Posts / Projects",
            "desc" => "This option controls the amount of related projects / posts that show up on each single portfolio and blog post. ex: 5",
            "id" => "number_related_posts",
            "std" => "5",
            "type" => "text");

        $of_options[] = array( "name" => "Basis for Excerpt Length",
            "desc" => "Choose if the excerpt length should be based on words or characters.",
            "id" => "excerpt_base",
            "std" => "words",
            "options" => array('Words' => 'Words', 'Characters' => 'Characters'),
            "type" => "select");

        $of_options[] = array( "name" => "Disable [...] on Excerpts",
            "desc" => "Check the box to disable the read more sign [...] on excerpts throughout the site.",
            "id" => "disable_excerpts",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Make [...] Link to Single Post Page",
            "desc" => "Check the box to have the read more sign [...] on excerpts link to single post page.",
            "id" => "link_read_more",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Allow Comments on Pages",
            "desc" => "Check the box to allow comments on regular pages.",
            "id" => "comments_pages",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Featured Images on Pages",
            "desc" => "Check the box to disable featured images on regular pages.",
            "id" => "featured_images_pages",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "FAQ Featured Images",
            "desc" => "Check the box to show featured images on FAQ archive page.",
            "id" => "faq_featured_image",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Add rel=\"nofollow\" to social links",
            "desc" => "Check the box to add rel=\"nofollow\" attribute to all social links.",
            "id" => "nofollow_social_links",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Open Social Icons in a New Window",
            "desc" => "Select the checkbox to allow social icons to open in a new window.",
            "id" => "social_icons_new",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Rollover",
            "desc" => "",
            "id" => "rollovers",
            "std" => "<h3 style='margin: 0;'>Image Rollover Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Image Rollover",
            "desc" => "Check the box to show the rollover box on images.",
            "id" => "image_rollover",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Link Icon From Image Rollover",
            "desc" => "Check the box to disable the link icon from image rollovers. Note: This option will override the post settings.",
            "id" => "link_image_rollover",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Image Icon From Image Rollover",
            "desc" => "Check the box to disable the image icon from image rollovers. Note: This option will override the post settings.",
            "id" => "zoom_image_rollover",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Title From Image Rollover",
            "desc" => "Check the box to disable the title from image rollovers.",
            "id" => "title_image_rollover",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Categories From Image Rollover",
            "desc" => "Check the box to disable the categories from image rollovers.",
            "id" => "cats_image_rollover",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Image Rollover Opacity",
            "desc" => "Select the opacity of the rollover. <br />0.1 (lowest) to 1 (highest).",
            "id" => "image_rollover_opacity",
            "std" => "1",
            "type" => "text");

        $of_options[] = array( "name" => "BBPress",
            "desc" => "",
            "id" => "bbpress_only",
            "std" => "<h3 style='margin: 0;'>BBPress Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "BBPress Use Global Sidebar",
            "desc" => "Check the box if you want to use one global sidebar on all forum pages.",
            "id" => "bbpress_global_sidebar",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "BBPress Global Sidebar",
            "desc" => "Select the sidebar that will display on forum pages globally.",
            "id" => "ppbress_sidebar",
            "std" => "None",
            "type" => "select",
            "options" => $sidebar_options
        );

        $of_options[] = array( "name" => "Advanced",
            "type" => "heading");

        $of_options[] = array( "name" => "enable_disable_heading",
            "desc" => "",
            "id" => "enable_disable_heading",
            "std" => "<h3 style='margin: 0;'>Enable / Disable Theme Features & Plugin Support</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Disable Mega Menu",
            "desc" => "Check to disable the theme's mega menu.",
            "id" => "disable_megamenu",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Avada Styles For Revolution Slider",
            "desc" => "Check the box to disable the Avada styles and use the default Revolution Slider styles.",
            "id" => "avada_rev_styles",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "UberMenu Plugin Support",
            "desc" => "Check the box if you are are using UberMenu, this option adds UberMenu support without editing any code.",
            "id" => "ubermenu",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable CSS Animations",
            "desc" => "Check the box to disable CSS animations on shortcode items.",
            "id" => "use_animate_css",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable CSS Animations on Mobiles Only",
            "desc" => "Check the box to disable CSS animations on mobiles only.",
            "id" => "disable_mobile_animate_css",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Lightbox",
            "desc" => "Check the box to disable Lightbox.",
            "id" => "status_lightbox",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Lightbox On Single Posts Pages Only",
            "desc" => "Check the box to disable Lightbox only on single posts and portfolio pages..",
            "id" => "status_lightbox_single",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Youtube API Scripts",
            "desc" => "Check the box to disable Youtube API scripts.",
            "id" => "status_yt",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Vimeo API Scripts",
            "desc" => "Check the box to disable Vimeo API scripts.",
            "id" => "status_vimeo",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Google Map Scripts",
            "desc" => "Check the box to disable google map.",
            "id" => "status_gmap",
            "std" => 0,
            "type" => "checkbox");
        
        $of_options[] = array( "name" => "Disable ToTop Script",
            "desc" => "Check the box to disable the ToTop script which adds the scrolling to top functionality.",
            "id" => "status_totop",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Enable ToTop Script on mobile",
            "desc" => "Check the box to enable the ToTop script on mobile devices.",
            "id" => "status_totop_mobile",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Fusion Slider",
            "desc" => "Check the box to disable fusion slider.",
            "id" => "status_fusion_slider",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable Elastic Slider",
            "desc" => "Check the box to disable elastic slider.",
            "id" => "status_eslider",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Disable FontAwesome",
            "desc" => "Check the box to disable font awesome.",
            "id" => "status_fontawesome",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Woocommerce",
            "type" => "heading");

        $of_options[] = array( "name" => "Number of Products per Page",
            "desc" => "Insert the number of posts to display per page.",
            "id" => "woo_items",
            "std" => "12",
            "type" => "text");

        $of_options[] = array( "name" => "Woocommerce Archive/Category Sidebar",
            "desc" => "Select the sidebar that will be added to the archive/category pages.",
            "id" => "woocommerce_archive_sidebar",
            "std" => "None",
            "type" => "select",
            "options" => $sidebar_options
        );

        $of_options[] = array( "name" => "Disable Woocommerce Shop Page Ordering Boxes",
            "desc" => "Check the box to disable the ordering boxes displayed on the shop page.",
            "id" => "woocommerce_avada_ordering",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Use Woocommerce One Page Checkout",
            "desc" => "Check the box to use Avada's one page checkout template.",
            "id" => "woocommerce_one_page_checkout",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Woocommerce Order Notes on Checkout",
            "desc" => "Check the box to show the order notes on the checkout page..",
            "id" => "woocommerce_enable_order_notes",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Woocommerce My Account Link in Secondary Menu",
            "desc" => "Check the box to show My Account link, uncheck to disable. Please note this will not show with Ubermenu.",
            "id" => "woocommerce_acc_link_top_nav",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Woocommerce Cart Icon in Secondary Menu",
            "desc" => "Check the box to show the Cart icon, uncheck to disable. Please note this will not show with Ubermenu.",
            "id" => "woocommerce_cart_link_top_nav",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Woocommerce My Account Link in Main Menu",
            "desc" => "Check the box to show My Account link, uncheck to disable. Please note these will not show with Ubermenu.",
            "id" => "woocommerce_acc_link_main_nav",
            "std" => 0,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Woocommerce Cart Link in Main Menu",
            "desc" => "Check the box to show the Cart icon, uncheck to disable. Please note these will not show with Ubermenu.",
            "id" => "woocommerce_cart_link_main_nav",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Show Woocommerce Social Icons",
            "desc" => "Check the box to show the social icons on product pages, uncheck to disable.",
            "id" => "woocommerce_social_links",
            "std" => 1,
            "type" => "checkbox");

        $of_options[] = array( "name" => "Account Area Message 1",
            "desc" => "Insert your text and it will appear in the first message box on the acount page.",
            "id" => "woo_acc_msg_1",
            "std" => "Need Assistance? Call customer service at 888-555-5555.",
            "type" => "textarea");

        $of_options[] = array( "name" => "Account Area Message 2",
            "desc" => "Insert your text and it will appear in the second message box on the acount page.",
            "id" => "woo_acc_msg_2",
            "std" => "E-mail them at info@yourshop.com",
            "type" => "textarea");

        $of_options[] = array( "name" => "Custom CSS",
            "type" => "heading");

        $of_options[] = array( "name" => "Advanced CSS Customizations",
            "desc" => "",
            "id" => "advanced_css_intro",
            "std" => "<h3 style='margin: 0;'>Advanced CSS Customizations</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "CSS Code",
            "desc" => "Paste your CSS code, do not include any tags or HTML in thie field. Any custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed.",
            "id" => "custom_css",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array( "name" => "Backup",
            "type" => "heading");

        $of_options[] = array( "name" => "Backup and Restore Options",
            "id" => "of_backup",
            "std" => "",
            "type" => "backup",
            "desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
        );

        $of_options[] = array( "name" => "Transfer Theme Options Data",
            "id" => "of_transfer",
            "std" => "",
            "type" => "transfer",
            "desc" => 'You can transfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
        );
        $of_options[] = array( "name" => "Auto Updates", "type" => "heading");
        $of_options[] = array( "name" => "Theme Updater",
      	"desc" => "",
      	"id" => "theme_updater",
      	"std" => "<h3 style='margin: 0;'>Enter all 3 required fields below!</h3>",
      	"icon" => true,
      	"type" => "info");
        $of_options[] = array( "name" => "ThemeForest Username",
      	"desc" => "",
      	"id" => "tf_username",
      	"std" => "",
      	"type" => "text");
        $of_options[] = array( "name" => "ThemeForest Secret API Key",
      	"desc" => "You can create one from ThemeForest's user settings page.",
      	"id" => "tf_api",
      	"std" => "",
      	"type" => "text");
        $of_options[] = array( "name" => "ThemeForest Purchase Code",
            "desc" => "",
            "id" => "tf_purchase_code",
            "std" => "",
            "type" => "text");
            // End Avada Edit
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
