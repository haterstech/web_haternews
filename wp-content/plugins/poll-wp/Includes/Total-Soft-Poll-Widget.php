<?php
	class Total_Soft_Poll extends WP_Widget
	{
		function __construct()
		{
			$params=array('name'=>'Total Soft Poll','description'=>'This is the widget of Total Soft Poll plugin');
			parent::__construct('Total_Soft_Poll','',$params);
		}
		function form($instance)
		{
			$defaults = array('Total_Soft_Poll'=>'');
			$instance = wp_parse_args((array)$instance, $defaults);

			$Total_Soft_Poll = $instance['Total_Soft_Poll'];
			$instance['Total_Soft_Poll_T'] = '';
			?>
			<div>
				<p>
					Select Question:
					<select name="<?php echo $this->get_field_name('Total_Soft_Poll'); ?>" class="widefat">
						<?php
							global $wpdb;

							$table_name1 = $wpdb->prefix . "totalsoft_poll_manager";
							$Total_Soft_Poll=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id > %d order by id", 0));
							
							foreach ($Total_Soft_Poll as $Total_Soft_Poll1)
							{
								?> <option value="<?php echo $Total_Soft_Poll1->id; ?>" <?php if($instance['Total_Soft_Poll'] == $Total_Soft_Poll1->id ){ print "selected"; } ?> > <?php echo $Total_Soft_Poll1->TotalSoftPoll_Question; ?> </option> <?php
							}
						?>
					</select>
				</p>
			</div>
			<?php
		}
		function widget($args,$instance)
		{
			extract($args);
			$Total_Soft_Poll = empty($instance['Total_Soft_Poll']) ? '' : $instance['Total_Soft_Poll'];
			$Total_Soft_PollT = empty($instance['Total_Soft_Poll_T']) ? '' : $instance['Total_Soft_Poll_T'];
			global $wpdb;
			require_once(dirname(__FILE__) . '/Total-Soft-Poll-Check.php');

			$table_name1 = $wpdb->prefix . "totalsoft_poll_manager";
			$table_name2 = $wpdb->prefix . "totalsoft_poll_answers";
			$table_name4 = $wpdb->prefix . "totalsoft_poll_dbt";
			$table_name5 = $wpdb->prefix . "totalsoft_poll_stpoll";
			$table_name6 = $wpdb->prefix . "totalsoft_poll_results";
			$table_name7 = $wpdb->prefix . "totalsoft_poll_inform";
			$table_name8 = $wpdb->prefix . "totalsoft_poll_stpoll_1";
			$table_name9 = $wpdb->prefix . "totalsoft_poll_impoll";
			$table_name10 = $wpdb->prefix . "totalsoft_poll_impoll_1";
			$table_name11 = $wpdb->prefix . "totalsoft_poll_stwibu";
			$table_name12 = $wpdb->prefix . "totalsoft_poll_stwibu_1";
			$table_name13 = $wpdb->prefix . "totalsoft_poll_imwibu";
			$table_name14 = $wpdb->prefix . "totalsoft_poll_imwibu_1";
			$table_name15 = $wpdb->prefix . "totalsoft_poll_quest_im";
			$table_name16 = $wpdb->prefix . "totalsoft_poll_iminqu";
			$table_name17 = $wpdb->prefix . "totalsoft_poll_iminqu_1";
			$table_name18 = $wpdb->prefix . "totalsoft_poll_setting";
			$table_namea01 = $wpdb->prefix . "totalsoft_poll_stpoll_01";
			$table_namea02 = $wpdb->prefix . "totalsoft_poll_stpoll_02";
			$table_namea03 = $wpdb->prefix . "totalsoft_poll_impoll_01";
			$table_namea04 = $wpdb->prefix . "totalsoft_poll_impoll_02";
			$table_namea05 = $wpdb->prefix . "totalsoft_poll_stwibu_01";
			$table_namea06 = $wpdb->prefix . "totalsoft_poll_stwibu_02";
			$table_namea07 = $wpdb->prefix . "totalsoft_poll_imwibu_01";
			$table_namea08 = $wpdb->prefix . "totalsoft_poll_imwibu_02";
			$table_namea09 = $wpdb->prefix . "totalsoft_poll_iminqu_01";
			$table_namea10 = $wpdb->prefix . "totalsoft_poll_iminqu_02";

			$Total_Soft_Poll_Man = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id = %d order by id", $Total_Soft_Poll));
			if($Total_Soft_PollT == '')
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id=%d order by id", $Total_Soft_Poll_Man[0]->TotalSoftPoll_Theme));
			}
			else if($Total_Soft_PollT == 'true1')
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea01 WHERE id > %d", 0));

				$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea01 WHERE id > %d", 0));
				$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea02 WHERE id > %d", 0));
			}
			else if($Total_Soft_PollT == 'true2')
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea03 WHERE id > %d", 0));

				$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea03 WHERE id > %d", 0));
				$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea04 WHERE id > %d", 0));
			}
			else if($Total_Soft_PollT == 'true3')
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea05 WHERE id > %d", 0));

				$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea05 WHERE id > %d", 0));
				$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea06 WHERE id > %d", 0));
			}
			else if($Total_Soft_PollT == 'true4')
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea07 WHERE id > %d", 0));

				$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea07 WHERE id > %d", 0));
				$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea08 WHERE id > %d", 0));
			}
			else if($Total_Soft_PollT == 'true5')
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea09 WHERE id > %d", 0));

				$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea09 WHERE id > %d", 0));
				$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea10 WHERE id > %d", 0));
			}
			else
			{
				$Total_Soft_Poll_Themes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id=%d order by id", $Total_Soft_PollT));
			}
			$Total_Soft_Poll_Q_M = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name15 WHERE Question_ID = %s order by id", $Total_Soft_Poll));
			$Total_Soft_Poll_Ans = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Question_ID = %s order by id", $Total_Soft_Poll));
			$Total_Soft_Poll_Res = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE Poll_ID = %s order by id", $Total_Soft_Poll));
			$Total_Soft_Poll_Res_Count = $wpdb->get_var($wpdb->prepare("SELECT SUM(Poll_A_Votes) FROM $table_name6 WHERE Poll_ID = %s", $Total_Soft_Poll));
			$Total_Soft_Poll_Set = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name18 WHERE id = %s order by id", $Total_Soft_Poll_Q_M[0]->TotalSoftPoll_Q_01));
			if( $Total_Soft_Poll_Res_Count == 0 ){ $Total_Soft_Poll_Res_Count = 1; $Total_Soft_Poll_Res_Count1 = 0; }else{ $Total_Soft_Poll_Res_Count1 = $Total_Soft_Poll_Res_Count; }

			if($Total_Soft_PollT != 'true1' && $Total_Soft_PollT != 'true2' && $Total_Soft_PollT != 'true3' && $Total_Soft_PollT != 'true4' && $Total_Soft_PollT != 'true5')
			{
				if( $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Standart Poll' )
				{
					$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
					$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
				}
				else if( $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image Poll' || $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll' )
				{
					$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
					$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
				}
				else if( $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Standart Without Button' )
				{
					$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
					$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
				}
				else if( $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image Without Button' || $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Without Button' )
				{
					$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
					$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
				}
				else if( $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image in Question' || $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video in Question' )
				{
					$Total_Soft_Poll_Theme = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name16 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
					$Total_Soft_Poll_Theme_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name17 WHERE TotalSoft_Poll_TID = %s order by id", $Total_Soft_Poll_Themes[0]->id));
				}
			}
			echo $before_widget;
			?>
				<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../CSS/totalsoft.css',__FILE__);?>">
				<link href="https://fonts.googleapis.com/css?family=ABeeZee|Abel|Abhaya+Libre|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Akronim|Aladin|Aldrich|Alef|Alegreya|Alegreya+SC|Alegreya+Sans|Alegreya+Sans+SC|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almendra|Almendra+Display|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amethysta|Amiko|Amiri|Amita|Anaheim|Andada|Andika|Angkor|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Arapey|Arbutus|Arbutus+Slab|Architects+Daughter|Archivo|Archivo+Black|Archivo+Narrow|Aref+Ruqaa|Arima+Madurai|Arimo|Arizonia|Armata|Arsenal|Artifika|Arvo|Arya|Asap|Asap+Condensed|Asar|Asset|Assistant|Astloch|Asul|Athiti|Atma|Atomic+Age|Aubrey|Audiowide|Autour+One|Average|Average+Sans|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|Bad+Script|Bahiana|Baloo|Baloo+Bhai|Baloo+Bhaijaan|Baloo+Bhaina|Baloo+Chettan|Baloo+Da|Baloo+Paaji|Baloo+Tamma|Baloo+Tammudu|Baloo+Thambi|Balthazar|Bangers|Barlow|Barlow+Condensed|Barlow+Semi+Condensed|Barrio|Basic|Battambang|Baumans|Bayon|Belgrano|Bellefair|Belleza|BenchNine|Bentham|Berkshire+Swash|Bevan|Bigelow+Rules|Bigshot+One|Bilbo|Bilbo+Swash+Caps|BioRhyme|BioRhyme+Expanded|Biryani|Bitter|Black+And+White+Picture|Black+Han+Sans|Black+Ops+One|Bokor|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Bubblegum+Sans|Bubbler+One|Buda:300|Buenard|Bungee|Bungee+Hairline|Bungee+Inline|Bungee+Outline|Bungee+Shade|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Cairo|Calligraffitti|Cambay|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carrois+Gothic|Carrois+Gothic+SC|Carter+One|Catamaran|Caudex|Caveat|Caveat+Brush|Cedarville+Cursive|Ceviche+One|Changa|Changa+One|Chango|Chathura|Chau+Philomene+One|Chela+One|Chelsea+Market|Chenla|Cherry+Cream+Soda|Cherry+Swash|Chewy|Chicle|Chivo|Chonburi|Cinzel|Cinzel+Decorative|Clicker+Script|Coda|Coda+Caption:800|Codystar|Coiny|Combo|Comfortaa|Coming+Soon|Concert+One|Condiment|Content|Contrail+One|Convergence|Cookie|Copse|Corben|Cormorant|Cormorant+Garamond|Cormorant+Infant|Cormorant+SC|Cormorant+Unicase|Cormorant+Upright|Courgette|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Text|Croissant+One|Crushed|Cuprum|Cute+Font|Cutive|Cutive+Mono|Damion|Dancing+Script|Dangrek|David+Libre|Dawning+of+a+New+Day|Days+One|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Denk+One|Devonshire|Dhurjati|Didact+Gothic|Diplomata|Diplomata+SC|Do+Hyeon|Dokdo|Domine|Donegal+One|Doppio+One|Dorsa|Dosis|Dr+Sugiyama|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|East+Sea+Dokdo|Eater|Economica|Eczar|El+Messiri|Electrolize|Elsie|Elsie+Swash+Caps|Emblema+One|Emilys+Candy|Encode+Sans|Encode+Sans+Condensed|Encode+Sans+Expanded|Encode+Sans+Semi+Condensed|Encode+Sans+Semi+Expanded|Engagement|Englebert|Enriqueta|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Expletus+Sans|Fanwood+Text|Farsan|Fascinate|Fascinate+Inline|Faster+One|Fasthand|Fauna+One|Faustina|Federant|Federo|Felipa|Fenix|Finger+Paint|Fira+Mono|Fira+Sans|Fira+Sans+Condensed|Fira+Sans+Extra+Condensed|Fjalla+One|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Frank+Ruhl+Libre|Freckle+Face|Fredericka+the+Great|Fredoka+One|Freehand|Fresca|Frijole|Fruktur|Fugaz+One|GFS+Didot|GFS+Neohellenic|Gabriela|Gaegu|Gafata|Galada|Galdeano|Galindo|Gamja+Flower|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Gidugu|Gilda+Display|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Gorditas|Gothic+A1|Graduate|Grand+Hotel|Gravitas+One|Great+Vibes|Griffy|Gruppo|Gudea|Gugi|Gurajada|Habibi|Halant|Hammersmith+One|Hanalei|Hanalei+Fill|Handlee|Hanuman|Happy+Monkey|Harmattan|Headland+One|Heebo|Henny+Penny|Herr+Von+Muellerhoff|Hi+Melody|Hind|Holtwood+One+SC|Homemade+Apple|Homenaje|IBM+Plex+Mono|IBM+Plex+Sans|IBM+Plex+Sans+Condensed|IBM+Plex+Serif|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Iceberg|Iceland|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Irish+Grover|Istok+Web|Italiana|Italianno|Itim|Jacques+Francois|Jacques+Francois+Shadow|Jaldi|Jim+Nightshade|Jockey+One|Jolly+Lodger|Jomhuria|Josefin+Sans|Josefin+Slab|Joti+One|Jua|Judson|Julee|Julius+Sans+One|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|Kadwa|Kalam|Kameron|Kanit|Kantumruy|Karla|Karma|Katibeh|Kaushan+Script|Kavivanar|Kavoon|Kdam+Thmor|Keania+One|Kelly+Slab|Kenia|Khand|Khmer|Khula|Kirang+Haerang|Kite+One|Knewave|Kotta+One|Koulen|Kranky|Kreon|Kristi|Krona+One|Kumar+One|Kumar+One+Outline|Kurale|La+Belle+Aurore|Laila|Lakki+Reddy|Lalezar|Lancelot|Lateef|Lato|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Lemonada|Libre+Baskerville|Libre+Franklin|Life+Savers|Lilita+One|Lily+Script+One|Limelight|Linden+Hill|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|Macondo|Macondo+Swash+Caps|Mada|Magra|Maiden+Orange|Maitree|Mako|Mallanna|Mandali|Manuale|Marcellus|Marcellus+SC|Marck+Script|Margarine|Marko+One|Marmelad|Martel|Martel+Sans|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Meera+Inimai|Megrim|Meie+Script|Merienda|Merienda+One|Merriweather|Merriweather+Sans|Metal|Metal+Mania|Metamorphous|Metrophobic|Michroma|Milonga|Miltonian|Miltonian+Tattoo|Mina|Miniver|Miriam+Libre|Mirza|Miss+Fajardose|Mitr|Modak|Modern+Antiqua|Mogra|Molengo|Molle:400i|Monda|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Montserrat+Alternates|Montserrat+Subrayada|Moul|Moulpali|Mountains+of+Christmas|Mouse+Memoirs|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Mukta|Muli|Mystery+Quest|NTR|Nanum+Brush+Script|Nanum+Gothic|Nanum+Gothic+Coding|Nanum+Myeongjo|Nanum+Pen+Script|Neucha|Neuton|New+Rocker|News+Cycle|Niconne|Nixie+One|Nobile|Nokora|Norican|Nosifer|Nothing+You+Could+Do|Noticia+Text|Noto+Sans|Noto+Serif|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Nunito+Sans|Odor+Mean+Chey|Offside|Old+Standard+TT|Oldenburg|Oleo+Script|Oleo+Script+Swash+Caps|Open+Sans|Open+Sans+Condensed:300|Oranienbaum|Orbitron|Oregano|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Overpass|Overpass+Mono|Ovo|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Padauk|Palanquin|Palanquin+Dark|Pangolin|Paprika|Parisienne|Passero+One|Passion+One|Pathway+Gothic+One|Patrick+Hand|Patrick+Hand+SC|Pattaya|Patua+One|Pavanam|Paytone+One|Peddana|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piedra|Pinyon+Script|Pirata+One|Plaster|Play|Playball|Playfair+Display|Playfair+Display+SC|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Poor+Story|Poppins|Port+Lligat+Sans|Port+Lligat+Slab|Pragati+Narrow|Prata|Preahvihear|Pridi|Princess+Sofia|Prociono|Prompt|Prosto+One|Proza+Libre|Puritan|Purple+Purse|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Quintessential|Qwigley|Racing+Sans+One|Radley|Rajdhani|Rakkas|Raleway|Raleway+Dots|Ramabhadra|Ramaraja|Rambla|Rammetto+One|Ranchers|Rancho|Ranga|Rasa|Rationale|Ravi+Prakash|Redressed|Reem+Kufi|Reenie+Beanie|Revalia|Rhodium+Libre|Ribeye|Ribeye+Marrow|Righteous|Risque|Roboto|Roboto+Condensed|Roboto+Mono|Roboto+Slab|Rochester|Rock+Salt|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Rozha+One|Rubik|Rubik+Mono+One|Ruda|Rufina|Ruge+Boogie|Ruluko|Rum+Raisin|Ruslan+Display|Russo+One|Ruthie|Rye|Sacramento|Sahitya|Sail|Saira|Saira+Condensed|Saira+Extra+Condensed|Saira+Semi+Condensed|Salsa|Sanchez|Sancreek|Sansita|Sarala|Sarina|Sarpanch|Satisfy|Scada|Scheherazade|Schoolbell|Scope+One|Seaweed+Script|Secular+One|Sedgwick+Ave|Sedgwick+Ave+Display|Sevillana|Seymour+One|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Share+Tech|Share+Tech+Mono|Shojumaru|Short+Stack|Shrikhand|Siemreap|Sigmar+One|Signika|Signika+Negative|Simonetta|Sintony|Sirin+Stencil|Six+Caps|Skranji|Slackey|Smokum|Smythe|Sniglet|Snippet|Snowburst+One|Sofadi+One|Sofia|Song+Myung|Sonsie+One|Sorts+Mill+Goudy|Source+Code+Pro|Source+Sans+Pro|Source+Serif+Pro|Space+Mono|Special+Elite|Spectral|Spectral+SC|Spicy+Rice|Spinnaker|Spirax|Squada+One|Sree+Krushnadevaraya|Sriracha|Stalemate|Stalinist+One|Stardos+Stencil|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Strait|Stylish|Sue+Ellen+Francisco|Suez+One|Sumana|Sunflower:300|Sunshiney|Supermercado+One|Sura|Suranna|Suravaram|Suwannaphum|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Taprom|Tauri|Taviraj|Teko|Telex|Tenali+Ramakrishna|Tenor+Sans|Text+Me+One|The+Girl+Next+Door|Tienne|Tillana|Timmana|Tinos|Titan+One|Titillium+Web|Trade+Winds|Trirong|Trocchi|Trochut|Trykker|Tulpen+One|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|Underdog|Unica+One|UnifrakturCook:700|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Vampiro+One|Varela|Varela+Round|Vast+Shadow|Vesper+Libre|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Vollkorn+SC|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wendy+One|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yantramanav|Yatra+One|Yellowtail|Yeon+Sung|Yeseva+One|Yesteryear|Yrsa|Zeyada|Zilla+Slab|Zilla+Slab+Highlight" rel="stylesheet">
				<?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Standart Poll'){ ?>
					<style type="text/css">
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							overflow: hidden;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
								float: left;
							<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
								float: right;
							<?php } else { ?>
								margin: 0 auto;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR;?>px;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Show == 'false' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'none'){ ?>
								-webkit-box-shadow: none;
								-moz-box-shadow: none;
								box-shadow: none;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'true'){ ?>
								-webkit-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'false'){ ?>
								-webkit-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh03'){ ?>
								box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh04'){ ?>
								box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?> inset;
								-webkit-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?> inset;
								-moz-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?> inset;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh05'){ ?>
								box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh06'){ ?>
								box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh07'){ ?>
								box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh08'){ ?>
								box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh09'){ ?>
								box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh10'){ ?>
								box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh_Type == 'sh11'){ ?>
								box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-moz-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
								-webkit-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxShC;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_BgC;?>;
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_C;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_FS;?>px;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_FF;?>;
							text-align: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_TA;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAQ_W;?>%;
							margin: 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAQ_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAQ_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAQ_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_A_MBgC;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
						{
							position:relative;
							display: inline-block;
							width: 100%;
							padding: 0px 5px;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_BgC;?>;
							margin-top: 3px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							display: inline-block;
							float: none;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover
						{
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_HBgC;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_HC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input
						{
							display: none;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_CTF == 'true'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_C;?> !important;
							<?php }?>
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_FS;?>px !important;
							cursor: pointer;
							margin-bottom: 0px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label:before
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_CBC;?>;
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_TBC;?>";
							margin: 0 .25em 0 0 !important;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_S=='big'){ ?>
								font-size: 32px !important;
								vertical-align: middle !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_S=='medium 2'){ ?>
								font-size: 26px !important;
								vertical-align: sub !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_S=='medium 1'){ ?>
								font-size: 22px !important;
								vertical-align: sub !important;
							<?php }else{ ?>
								font-size: 18px !important;
								vertical-align: initial !important;
							<?php }?>
							font-family: FontAwesome !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:before
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_CAC;?> !important;
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_TAC;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:after
						{
							font-weight: bold;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAA_W;?>%;
							margin: 5px auto 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAA_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAA_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_LAA_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_MBgC;?>;
							position: relative;
							float: left;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Pos=='right'){ ?>
								float: right;
								margin: 10px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Pos=='left'){ ?>
								margin: 10px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_RB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_RB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Pos=='right'){ ?>
								float: right;
								margin: 10px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Pos=='left'){ ?>
								margin: 10px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Vote_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Vote_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_IT;?>";
						}
						@media only screen and ( max-width: 820px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 74% !important; }
							/*.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> { width: 74% !important; left: 13% !important; }*/
						}
						@media only screen and ( max-width: 500px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; }
							/*.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; left: 0% !important; }*/
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
							{
								width: 98% !important;
								margin: 5px 1%;
							}
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus
						{
							outline: none !important;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> { 
							width: 100% !important;
    						left: 0% !important; 
    					}
						.Total_Soft_Poll_Main_Div .Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FTTB' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-webkit-transform: translateY(-12000px);
								-moz-transform: translateY(-12000px);
								-o-transform: translateY(-12000px);
								-ms-transform: translateY(-12000px);
								transform: translateY(-12000px);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
								opacity: 0;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FLTR' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-webkit-transform: translateX(-12000px);
								-moz-transform: translateX(-12000px);
								-o-transform: translateX(-12000px);
								-ms-transform: translateX(-12000px);
								transform: translateX(-12000px);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FRTL' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-webkit-transform: translateX(12000px);
								-moz-transform: translateX(12000px);
								-o-transform: translateX(12000px);
								-ms-transform: translateX(12000px);
								transform: translateX(12000px);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FCTA' ){ ?>
								position: absolute;
								width: 0%;
								height: 0%;
								top: 50%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: <?php echo 50-(100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: <?php echo 50-(100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php } else { ?>
									left: 50%;
								<?php }?>
								overflow: hidden;
								border: 0px;
								border-style: solid;
								border-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC;?>;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FTL' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-ms-transform: rotateY(-90deg); /* IE 9 */
								-moz-transform: rotateY(-90deg);
								-o-transform: rotateY(-90deg);
								-webkit-transform: rotateY(-90deg); /* Safari */
								transform: rotateY(-90deg); /* Standard syntax */
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FTR' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-ms-transform: rotateX(-90deg); /* IE 9 */
								-moz-transform: rotateX(-90deg);
								-o-transform: rotateX(-90deg);
								-webkit-transform: rotateX(-90deg); /* Safari */
								transform: rotateX(-90deg); /* Standard syntax */
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FBL' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								z-index: -1;
								-ms-transform: rotate(-180deg); /* IE 9 */
								-moz-transform: rotate(-180deg);
								-o-transform: rotate(-180deg);
								-webkit-transform: rotate(-180deg); /* Safari */
								transform: rotate(-180deg); /* Standard syntax */
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FBR' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-ms-transform: skewX(90deg); /* IE 9 */
								-moz-transform: skewX(90deg);
								-o-transform: skewX(90deg);
								-webkit-transform: skewX(90deg); /* Safari */
								transform: skewX(90deg); /* Standard syntax */
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FBTT' ){ ?>
								position: absolute;
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>%;
								height: 100%;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'left'){ ?>
									left: 0;
								<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos == 'right'){ ?>
									right: 0;
								<?php } else { ?>
									left: <?php echo (100-$Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW)/2;?>%;
								<?php }?>
								top: 0%;
								overflow: hidden;
								border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
								border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
								-ms-transform: skewY(90deg);
								-moz-transform: skewY(90deg);
								-o-transform: skewY(90deg);
								-webkit-transform: skewY(90deg);
								transform: skewY(90deg); 
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?>
						{
							<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShPop == 'true'){ ?>
								position: relative;
								margin: 12% auto 0;
								<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FTTB' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-webkit-transform: translateY(-12000px);
									-moz-transform: translateY(-12000px);
									-o-transform: translateY(-12000px);
									-ms-transform: translateY(-12000px);
									transform: translateY(-12000px);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
									opacity: 0;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FLTR' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-webkit-transform: translateX(-12000px);
									-moz-transform: translateX(-12000px);
									-o-transform: translateX(-12000px);
									-ms-transform: translateX(-12000px);
									transform: translateX(-12000px);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FRTL' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-webkit-transform: translateX(12000px);
									-moz-transform: translateX(12000px);
									-o-transform: translateX(12000px);
									-ms-transform: translateX(12000px);
									transform: translateX(12000px);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FCTA' ){ ?>
									position: absolute;
									width: 0%;
									height: 0%;
									overflow: hidden;
									border: 0px;
									border-style: solid;
									border-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC;?>;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FTL' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-ms-transform: rotateY(-90deg);
									-moz-transform: rotateY(-90deg);
									-o-transform: rotateY(-90deg);
									-webkit-transform: rotateY(-90deg);
									transform: rotateY(-90deg);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FTR' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-ms-transform: rotateX(-90deg);
									-moz-transform: rotateX(-90deg);
									-o-transform: rotateX(-90deg);
									-webkit-transform: rotateX(-90deg);
									transform: rotateX(-90deg); 
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FBL' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									opacity: 0;
									-ms-transform: rotate(-180deg);
									-moz-transform: rotate(-180deg);
									-o-transform: rotate(-180deg);
									-webkit-transform: rotate(-180deg);
									transform: rotate(-180deg);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FBR' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-ms-transform: skewX(90deg);
									-moz-transform: skewX(90deg);
									-o-transform: skewX(90deg);
									-webkit-transform: skewX(90deg);
									transform: skewX(90deg);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff == 'FBTT' ){ ?>
									width: 100%;
									max-width: 750px;
									height: inherit;
									overflow: hidden;
									border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW; ?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BC; ?>;
									border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR; ?>px;
									-ms-transform: skewY(90deg);
									-moz-transform: skewY(90deg);
									-o-transform: skewY(90deg);
									-webkit-transform: skewY(90deg);
									transform: skewY(90deg);
									-webkit-transition: all 0.5s ease-in-out 0.5s;
									-moz-transition: all 0.5s ease-in-out 0.5s;
									-o-transition: all 0.5s ease-in-out 0.5s;
									-ms-transition: all 0.5s ease-in-out 0.5s;
									transition: all 0.5s ease-in-out 0.5s;
									-webkit-transition-delay: 0s;
									-moz-transition-delay: 0s;
									-o-transition-delay: 0s;
									-ms-transition-delay: 0s;
									transition-delay: 0s;
								<?php }?>
							<?php } else { ?>
								display: none;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_Q_BgC;?>;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_Q_C;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_FS;?>px;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_FF;?>;
							text-align: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Q_TA;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> label, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> label, .Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> label
						{
							margin-bottom: 0px !important;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAQ_W;?>%;
							margin: 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAQ_H;?>px <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAQ_S;?> <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAQ_C;?>;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_MBgC;?>;
							padding: 0px 10px;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
						{
							position: relative;
							display: inline-block;
							width: 100%;
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_BgC;?> !important;
							margin-top: 3px;
							line-height: 1 !important
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							display: inline-block;
							float: none;
							width: 100%;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_FS;?>px !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VC;?> !important;
							position: relative;
							padding: 3px 0px;
							line-height: 1 !important;
							margin-bottom: 0px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_Sp2_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_Sp2_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							min-width: 10px;
							height: 100%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_CTF == 'true'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_C;?> !important;
							<?php }?>
							left: 0;
							top: 0;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VEff != '0'){ ?>
								background: url('<?php echo plugins_url("../Images/icon" . $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VEff . ".png" ,__FILE__);?>') 100% repeat-x;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_Sp3_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_Sp3_<?php echo $Total_Soft_Poll;?>
						{
							float: right;
							margin-right: 3px;
							position: inherit;
							z-index: 99999999999;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAA_W;?>%;
							margin: 5px auto 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAA_H;?>px <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAA_S;?> <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_LAA_C;?>;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_MBgC;?>;
							position: relative;
							float: left;
							width: 100%;
							height: inherit !important;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Pos=='right'){ ?>
								float: right;
								margin: 10px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Pos=='left'){ ?>
								margin: 10px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> span, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:hover, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon:before, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_IT;?>";
						}
						.Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>
						{
							position: fixed;
							width: 100%;
							height: 0%;
							background-color: rgba(0, 0, 0, 0.3);
							left: 0;
							top: 0;
							z-index: 99999999999;
						}
						.Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>
						{
							position: fixed;
							z-index: 9999999999999;
							width: 0%;
							left: 0;
							top: 0;
						}
						.TotalSoftPoll_Ans_loading
						{
							background: rgba(241, 241, 241, 0.85);
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 1;
							display: none;
						}
						.TotalSoftPoll_Ans_loading_Img
						{
							margin: 0;
							padding: 0;
							width: 20px;
							height: 20px;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
						}
						.TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>
						{
							background:<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_06;?>;
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 1;
							display: none;
						}
						.TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>
						{
							margin: 0;
							padding: 0;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
							line-height: 1;
							color: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_07;?>;
							font-size: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_08;?>px;
							font-family: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_09;?>;
							cursor: default;
						}
					</style>
					<form method="POST" onsubmit="">
						<div class="Total_Soft_Poll_Main_Div">
							<div class="Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>">
								<span class="TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>">
									<span class="TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>">
										<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>
									</span>
								</span>
								<span class="TotalSoftPoll_Ans_loading">
									<img class="TotalSoftPoll_Ans_loading_Img" src="<?php echo plugins_url( "../Images/loading.gif", __FILE__ ); ?>">
								</span>
								<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
									<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
									<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
									<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){
										if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_CM == 'true')
										{
											$Total_Soft_Poll_1_Check_Name = "Total_Soft_Poll_1_Ans_". $Total_Soft_Poll . "_" . $i+1;
										}
										else
										{
											$Total_Soft_Poll_1_Check_Name = "Total_Soft_Poll_1_Ans_". $Total_Soft_Poll;
										}
										?>
										<div class="Total_Soft_Poll_1_Ans_Check_Div">
											<input type="<?php if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_CM == 'true' ){ echo 'checkbox'; }else{ echo 'radio'; }?>" class="Total_Soft_Poll_1_Ans_CheckBox" id="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" name="<?php echo $Total_Soft_Poll_1_Check_Name;?>" value="<?php echo $Total_Soft_Poll_Ans[$i]->id;?>">
											<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> totalsoft totalsoft-question-circle-o" for="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_CTF == 'false'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>"><?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?></label>
										</div>
									<?php }?>
									<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
									<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Show == 'true'){ ?>
										<button class="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Text);?>" onclick="Total_Soft_Poll_1_Result(<?php echo $Total_Soft_Poll;?>)">
											<i class="totalsoft Total_Soft_Poll_1_Result_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_RB_Text);?></span>
											</i>
										</button>
									<?php }?>
									<?php
										$cookie = ( isset($_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll]) ) ? $_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll] : '';
									 if($cookie == ''){ ?>
										<button class="Total_Soft_Poll_1_But_Vote Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Text);?>" onclick="Total_Soft_Poll_1_But_Vote(<?php echo $Total_Soft_Poll;?>,event)" >
											<i class="totalsoft Total_Soft_Poll_1_Vote_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Text);?></span>
											</i>
										</button>
									<?php } ?>
									<?php if($cookie != '' && $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 != "true"){ ?>
										<button class="Total_Soft_Poll_1_But_Vote Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Text);?>" onclick="Total_Soft_Poll_1_But_Vote(<?php echo $Total_Soft_Poll;?>,event)" >
											<i class="totalsoft Total_Soft_Poll_1_Vote_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_VB_Text);?></span>
											</i>
										</button>
									<?php } ?>
								</div>

								<div class="Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?>">
								<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
									<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
									<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
									<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){ ?>
										<div class="Total_Soft_Poll_1_Ans_Check_Div">
											<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>">
												<span style="margin-left: 3px; position: inherit; z-index: 99999999999;">
													<?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?>
												</span>
												<span class="Total_Soft_Poll_1_Ans_Lab_Sp2_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Lab_Sp2_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>" style="width: <?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . '%'; ?>;<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_CTF == 'false'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>">
												</span>
												<span class="Total_Soft_Poll_1_Ans_Lab_Sp3_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Lab_Sp3_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>">
													<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VT == 'percent' ){ ?>
														<?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' %'; ?>
													<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VT == 'count' ){ ?>
														<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes; ?>
													<?php } else { ?>
														<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes . ' ( ' . round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' % )'; ?>
													<?php } ?>
												</span>
											</label>
										</div>
									<?php }?>
									<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
									<button class="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Text);?>" onclick="Total_Soft_Poll_1_Back(<?php echo $Total_Soft_Poll;?>)">
										<i class="totalsoft Total_Soft_Poll_1_Back_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Text);?></span>
										</i>
									</button>
								</div>
							</div>


							</div>
							
							<input type="text" style="display: none;" id="TotalSoft_Poll_1_P_ShPop_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShPop;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_1_P_ShEff_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_ShEff;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_1_MW_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_MW;?>">

							<input type="text" style="display: none;" id="TotalSoft_Poll_1_ID" value="<?php echo $Total_Soft_Poll;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_1_Vote" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10; ?>">

							<input type="text" style="display: none;" id="TotalSoft_Poll_1_BR_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_BR;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_1_P_BW_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BW;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_1_Pos_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_Pos;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_01_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_01;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_02_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_03_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_04_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_05_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_05);?>">
						</div>
					</form>
					<div class="Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>" onclick="Total_Soft_Poll_1_Ans_Fix_Close(this,'Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>')" style="cursor:pointer;"></div>
					<div class="Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>" style="cursor:pointer;" onclick="Total_Soft_Poll_1_Ans_Fix_Close2(this,'Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>')">
						<div class="Total_Soft_Poll_1_Main_Ans_Div_Fix Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?>">
							<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
								<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
								<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
							</div>
							<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
								<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){ ?>
									<div class="Total_Soft_Poll_1_Ans_Check_Div">
										<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>">
											<span style="margin-left: 3px; position: inherit; z-index: 99999999999;">
												<?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?>
											</span>
											<span class="Total_Soft_Poll_1_Ans_Lab_Sp2_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Lab_Sp2_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>" style="width: <?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . '%'; ?>;<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_A_CTF == 'false'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>">
											</span>
											<span class="Total_Soft_Poll_1_Ans_Lab_Sp3_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Lab_Sp3_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>">
												<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VT == 'percent' ){ ?>
													<?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' %'; ?>
												<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_A_VT == 'count' ){ ?>
													<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes; ?>
												<?php } else { ?>
													<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes . ' ( ' . round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' % )'; ?>
												<?php } ?>
											</span>
										</label>
									</div>
								<?php }?>
								<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
							</div>
							<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
								<button class="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Text);?>" onclick="Total_Soft_Poll_1_Back(<?php echo $Total_Soft_Poll;?>)">
									<i class="totalsoft Total_Soft_Poll_1_Back_But_Icon">
										<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_1_P_BB_Text);?></span>
									</i>
								</button>
							</div>
						</div>
					</div>
					<?php
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02 != '')
						{
							?>
								<script type="text/javascript">
									Total_Soft_Poll_Upcoming(<?php echo $Total_Soft_Poll;?>);
								</script>
							<?php
						}
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03 != '')
						{
							?>
								<script type="text/javascript">
									Total_Soft_Poll_End_Poll(<?php echo $Total_Soft_Poll;?>, 'Standart');
								</script>
							<?php
						}
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 == 'true')
						{
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'phpcookie')
							{
								if(isset($_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll]))
								{
									if( $_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll] == 'Standart' )
									{
										?>
											<script type="text/javascript">
												Total_Soft_Poll_Ans_Div1(<?php echo $Total_Soft_Poll;?>,'IPCookie');
											</script>
										<?php
									}
								}
							}
							else if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'ipaddress')
							{
								if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
									$Total_Soft_IP_Address = $_SERVER['HTTP_CLIENT_IP'];
								} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED_FOR' );
								} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED' );
								} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED_FOR' );
								} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED' );
								} elseif ( getenv( 'REMOTE_ADDR' ) ) {
									$Total_Soft_IP_Address = getenv( 'REMOTE_ADDR' );
								} else {
									$Total_Soft_IP_Address = 'UNKNOWN';
								}
								$Total_Soft_Poll_Info = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Poll_ID = %d AND IPAddress = %s order by id", $Total_Soft_Poll, $Total_Soft_IP_Address));
								if($Total_Soft_Poll_Info)
								{
									?>
										<script type="text/javascript">
											Total_Soft_Poll_Ans_Div1(<?php echo $Total_Soft_Poll;?>,'IPCookie');
										</script>
									<?php
								}
							}
						}
					?>
				<?php } else if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image Poll' || $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?>

					<style type="text/css">
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							overflow: hidden;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_MW;?>%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Pos == 'left'){ ?>
								float: left;
							<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Pos == 'right'){ ?>
								float: right;
							<?php } else { ?>
								margin: 0 auto;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BR;?>px;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Show == 'false' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'none'){ ?>
								-webkit-box-shadow: none;
								-moz-box-shadow: none;
								box-shadow: none;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'true'){ ?>
								-webkit-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'false'){ ?>
								-webkit-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh03'){ ?>
								box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh04'){ ?>
								box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?> inset;
								-webkit-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?> inset;
								-moz-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?> inset;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh05'){ ?>
								box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh06'){ ?>
								box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh07'){ ?>
								box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh08'){ ?>
								box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh09'){ ?>
								box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh10'){ ?>
								box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh_Type == 'sh11'){ ?>
								box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-moz-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
								-webkit-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxShC;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Q_BgC;?>;
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Q_C;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Q_FS;?>px;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Q_FF;?>;
							text-align: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Q_TA;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAQ_W;?>%;
							margin: 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAQ_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAQ_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAQ_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_MBgC;?>;
							padding: 5px 10px;
							text-align: center !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
						{
							position:relative;
							display: inline-block;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CC == '1'){ ?>
								width: 99%;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CC == '2'){ ?>
								width: 49%;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CC == '3'){ ?>
								width: 32%;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CC == '4'){ ?>
								width: 24%;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CC == '5'){ ?>
								width: 19%;
							<?php }?>
							padding: 3px 3px;
							margin-top: 3px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div_BO_<?php echo $Total_Soft_Poll;?>
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_BgC;?>;
							<?php }?>
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VEff == '1'){ ?>
								-ms-transform: rotateY(0deg);
								-moz-transform: rotateY(0deg);
								-o-transform: rotateY(0deg);
								-webkit-transform: rotateY(0deg);
								transform: rotateY(0deg);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VEff == '2'){ ?>
								-ms-transform: rotateX(0deg);
								-moz-transform: rotateX(0deg);
								-o-transform: rotateX(0deg);
								-webkit-transform: rotateX(0deg);
								transform: rotateX(0deg);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Overlay_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_OC;?>;
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0 !important;
							left: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VEff == '0'){ ?>
								display: none;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VEff == '1'){ ?>
								-ms-transform: rotateY(-90deg);
								-moz-transform: rotateY(-90deg);
								-o-transform: rotateY(-90deg);
								-webkit-transform: rotateY(-90deg);
								transform: rotateY(-90deg);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VEff == '2'){ ?>
								-ms-transform: rotateX(-90deg);
								-moz-transform: rotateX(-90deg);
								-o-transform: rotateX(-90deg);
								-webkit-transform: rotateX(-90deg);
								transform: rotateX(-90deg);
								-webkit-transition: all 0.5s ease-in-out 0.5s;
								-moz-transition: all 0.5s ease-in-out 0.5s;
								-o-transition: all 0.5s ease-in-out 0.5s;
								-ms-transition: all 0.5s ease-in-out 0.5s;
								transition: all 0.5s ease-in-out 0.5s;
								-webkit-transition-delay: 0s;
								-moz-transition-delay: 0s;
								-o-transition-delay: 0s;
								-ms-transition-delay: 0s;
								transition-delay: 0s;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Ov_Lab_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Ov_Lab1_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_C;?> !important;
							line-height: 1 !important;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_FS;?>px !important;
							display: block;
							width: 100%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Ans_Div_Overlay_Span_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							top: 50%;
							left: 0;
							width:100%;
							transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Ov_Lab1_<?php echo $Total_Soft_Poll;?>
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'percentlab' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'countlab' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'bothlab'){ ?>
								margin-top: 10px;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div .Total_Soft_Poll_1_Ans_Ratio_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: 100%;
							/*1x1*/
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '1'){ ?>
								padding-bottom: 100%;
							/*16x9*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '2'){ ?>
								padding-bottom: 56.25%;
							/*9x16*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '3'){ ?>
								padding-bottom: 177.78%;
							/*3x4*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '4'){ ?>
								padding-bottom: 133.3%;
							/*4x3*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '5'){ ?>
								padding-bottom: 75%;
							/*3x2*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '6'){ ?>
								padding-bottom: 66.7%;
							/*2x3*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '7'){ ?>
								padding-bottom: 150%;
							/*8x5*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '8'){ ?>
								padding-bottom: 62.5%;
							/*5x8*/
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH == '9'){ ?>
								padding-bottom: 160%;
							<?php }else{ ?>
								padding-bottom: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_IH;?>px;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div img
						{
							width: 100%;
							height: 100% !important;
							position: absolute;
							left: 0;
							top: 0;
							margin: 0 !important;
							padding: 0 !important;
							float: none !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							display: inline-block;
							float: none;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div_BO_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_HBgC;?> !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_HSh_Show == 'true'){ ?>
								box-shadow: 0px 0px 5px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_HShC;?> !important;
								-moz-box-shadow: 0px 0px 5px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_HShC;?> !important;
								-webkit-box-shadow: 0px 0px 5px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_HShC;?> !important;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div_BO_<?php echo $Total_Soft_Poll;?>:hover label
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_HC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input
						{
							display: none;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_C;?> !important;
							<?php }?>
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_FS;?>px !important;
							cursor: pointer;
							margin-bottom: 0px !important;
							padding-bottom: 5px !important;
							padding-top: 5px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label:before
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_CBC;?>;
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_TBC;?>";
							margin: 0 .25em 0 0 !important;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_S=='big'){ ?>
								font-size: 32px !important;
								vertical-align: middle !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_S=='medium 2'){ ?>
								font-size: 26px !important;
								vertical-align: sub !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_S=='medium 1'){ ?>
								font-size: 22px !important;
								vertical-align: sub !important;
							<?php }else{ ?>
								font-size: 18px !important;
								vertical-align: initial !important;
							<?php }?>
							font-family: FontAwesome !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:before
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_CAC;?> !important;
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_TAC;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:after
						{
							font-weight: bold;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAA_W;?>%;
							margin: 5px auto 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAA_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAA_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_LAA_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_VB_MBgC;?>;
							position: relative;
							float: left;
							width: 100%;
							border-bottom-left-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BR-2;?>px;
							border-bottom-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BR-2;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_VB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_VB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_VB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_VB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_VB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Vote_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Vote_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_IT;?>";
						}
						@media only screen and ( max-width: 500px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; }
							/*.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; left: 0% !important; }*/
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
							{
								width: 98% !important;
								margin: 5px 1%;
							}
						}
						@media only screen and ( max-width: 820px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 80% !important; }
							/*.Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> { width: 80% !important; left: 10% !important; }*/
						}
						@media only screen and ( max-width: 600px )
						{
							.Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div { width: 49% !important; }
							.Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?> { width: 90% !important; left: 5% !important; top: 5% !important; }
						}
						@media only screen and ( max-width: 400px )
						{
							.Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div { width: 99% !important; }
							.Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?> { width: 100% !important; left: 0% !important; top: 10% !important; }
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Ans_Div_Fix_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus
						{
							outline: none !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_MBgC;?>;
							position: absolute;
							overflow: hidden;
							float: left;
							width: 100%;
							margin-bottom: 0%;
							z-index: -1;
							opacity: 0;
							border-bottom-left-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BR-2;?>px;
							border-bottom-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_BR-2;?>px;
							backface-visibility: hidden;
							height: -webkit-fill-available;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							left: 0 !important;
							top: 0 !important;
							width: 100% !important;
							height: 200%;
							overflow: hidden;
							z-index: -1;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_MBgC;?>;
						}
						<?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?>
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Play_Overlay_<?php echo $Total_Soft_Poll;?>
							{
								background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Play_IOvC;?>;
								position: absolute;
								left: 0 !important;
								top: 0;
								width: 100% !important;
								height: 100%;
								display: none;
								cursor: pointer;
								z-index: 1;
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Video_Icon_Sp_<?php echo $Total_Soft_Poll;?>
							{
								line-height: 1 !important;
								display: block;
								position: relative;
								top: 50%;
								width: 100%;
								text-align: center;
								-ms-transform: translateY(-50%);
								-webkit-transform: translateY(-50%);
								-moz-transform: translateY(-50%);
								-o-transform: translateY(-50%);
								transform: translateY(-50%);
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Video_Icon_Sp_<?php echo $Total_Soft_Poll;?> i
							{
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Play_IC;?>;
								font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Play_IS;?>px;
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_Video_Icon_Sp_<?php echo $Total_Soft_Poll;?> i:before
							{
								content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_Play_IT;?>";
							}
							.Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>
							{
								position: fixed;
								width: 100%;
								height: 100%;
								background-color: rgba(0, 0, 0, 0.3);
								left: 0;
								top: 0;
								z-index: 99999999999999;
								display: none;
								cursor: pointer;
							}
							.Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>
							{
								position: fixed;
								z-index: 9999999999;
								width: 50%;
								left: 25%;
								top: 20%;
								height: 0;
								overflow: hidden;
								padding-bottom: 56.25%;
								display: none;
							}
							.Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?> iframe
							{
								position: absolute;
								width: 100%;
								height: 100%;
								top: 0;
								left: 0;
								right: 0;
								left: 0;
							}
							.Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?>
							{
								position: relative;
								width: 100%;
								padding-top: 56.25%; /* 16:9 Aspect Ratio */
							}
						<?php }?>
						.TotalSoftPoll_Ans_loading
						{
							background: rgba(241, 241, 241, 0.85);
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 1;
							display: none;
						}
						.TotalSoftPoll_Ans_loading_Img
						{
							margin: 0;
							padding: 0;
							width: 20px;
							height: 20px;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
						}
						.TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>
						{
							background:<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_06;?>;
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 1;
							display: none;
						}
						.TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>
						{
							margin: 0;
							padding: 0;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
							line-height: 1;
							color: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_07;?>;
							font-size: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_08;?>px;
							font-family: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_09;?>;
							cursor: default;
						}
					</style>
					<form method="POST" onsubmit="">
						<div class="Total_Soft_Poll_Main_Div">
							<div class="Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>">
								<span class="TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>">
									<span class="TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>">
										<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>
									</span>
								</span>
								<span class="TotalSoftPoll_Ans_loading">
									<img class="TotalSoftPoll_Ans_loading_Img" src="<?php echo plugins_url( "../Images/loading.gif", __FILE__ ); ?>">
								</span>
								<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
									<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
									<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
									<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){
										$val;
										isset($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_CM) ? $val = $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_1_CH_CM : $val = "";
										if( $val == 'true')
										{
											$Total_Soft_Poll_1_Check_Name = "Total_Soft_Poll_1_Ans_". $Total_Soft_Poll . "_" . $i+1;
										}
										else
										{
											$Total_Soft_Poll_1_Check_Name = "Total_Soft_Poll_1_Ans_". $Total_Soft_Poll;
										}
										if(strpos($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im,"youtube"))
										{
											$rest = substr($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im, 0, -13);
											$link = $rest . 'maxresdefault.jpg';
											if(@fopen("$link",'r')) { $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im = $link; }
										}
										?>
										<div class="Total_Soft_Poll_1_Ans_Check_Div" <?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?> onmouseover = "Total_Soft_Poll_Video_Hove(<?php echo $Total_Soft_Poll;?>, <?php echo $i;?>)" onmouseout = "Total_Soft_Poll_Video_Out(<?php echo $Total_Soft_Poll;?>, <?php echo $i;?>)" <?php }?>>
											<div class="Total_Soft_Poll_1_Ans_Check_Div_BO_<?php echo $Total_Soft_Poll;?>" style=" <?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CA == 'Background'){ ?>background: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>">
												<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_Pos == 'Position 3' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_Pos == 'Position 4')
												{ ?>
													<div class="Total_Soft_Poll_1_Ans_Ratio_<?php echo $Total_Soft_Poll;?>">
														<?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?>
															<div class="Total_Soft_Poll_1_Ans_Div_Play_Overlay_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Div_Play_Overlay_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>" onclick = 'Total_Soft_Poll_Video_Play(<?php echo $Total_Soft_Poll;?>, "<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Vd;?>")'>
																<span class="Total_Soft_Poll_1_Ans_Div_Video_Icon_Sp_<?php echo $Total_Soft_Poll;?>"><i class="totalsoft"></i></span>
															</div>
														<?php }?>
														<img src="<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im;?>">
													</div>
												<?php } ?>
												<input type="<?php if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_CH_CM == 'true' ){ echo 'checkbox'; }else{ echo 'radio'; }?>" class="Total_Soft_Poll_1_Ans_CheckBox" id="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" name="<?php echo $Total_Soft_Poll_1_Check_Name;?>" value="<?php echo $Total_Soft_Poll_Ans[$i]->id;?>">
												<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> totalsoft totalsoft-question-circle-o" for="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>"><?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_Pos == 'Position 1' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_Pos == 'Position 3'){ echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);} ?></label>
												<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_Pos == 'Position 1' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_A_Pos == 'Position 2')
												{ ?>
													<div class="Total_Soft_Poll_1_Ans_Ratio_<?php echo $Total_Soft_Poll;?>">
														<?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?>
															<div class="Total_Soft_Poll_1_Ans_Div_Play_Overlay_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Div_Play_Overlay_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>" onclick = 'Total_Soft_Poll_Video_Play(<?php echo $Total_Soft_Poll;?>, "<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Vd;?>")'>
																<span class="Total_Soft_Poll_1_Ans_Div_Video_Icon_Sp_<?php echo $Total_Soft_Poll;?>"><i class="totalsoft"></i></span>
															</div>
														<?php }?>
														<img src="<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im;?>">
													</div>
												<?php } ?>
											</div>
											<div class="Total_Soft_Poll_1_Ans_Div_Overlay_<?php echo $Total_Soft_Poll;?>" <?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?> onclick = 'Total_Soft_Poll_Video_Play(<?php echo $Total_Soft_Poll;?>, "<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Vd;?>")' <?php }?> >
												<span class="Total_Soft_Poll_1_Ans_Div_Overlay_Span_<?php echo $Total_Soft_Poll;?>" <?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image Poll'){ ?> style="cursor: default !important;" <?php }?> >
													<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'percentlab' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'countlab' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'bothlab'){ ?>
														<span class="Total_Soft_Poll_1_Ans_Div_Ov_Lab_<?php echo $Total_Soft_Poll;?>">
															<?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans)?>
														</span>
													<?php }?>
													<span class="Total_Soft_Poll_1_Ans_Div_Ov_Lab1_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_1_Ans_Div_Ov_Lab1_<?php echo $Total_Soft_Poll;?>_<?php echo $i;?>">
														<?php if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'percent' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'percentlab'){ ?>
															<?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' %'; ?>
														<?php } else if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'count' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VT == 'countlab' ){ ?>
															<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes; ?>
														<?php } else { ?>
															<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes . ' ( ' . round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' % )'; ?>
														<?php } ?>
													</span>
												</span>
											</div>
										</div>
									<?php }?>
									<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
									<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Show == 'true'){ ?>
										<button class="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Text);?>" onclick="Total_Soft_Poll_2_Result(<?php echo $Total_Soft_Poll;?>)">
											<i class="totalsoft Total_Soft_Poll_1_Result_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_RB_Text);?></span>
											</i>
										</button>
									<?php }?>
									<?php
										$cookie = ( isset($_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll]) ) ? $_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll] : '';
									 if($cookie == ''){ ?>
										<button class="Total_Soft_Poll_2_But_Vote Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_Text);?>" onclick="Total_Soft_Poll_2_But_Vote(<?php echo $Total_Soft_Poll;?>, event)" >
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_Text);?></span>
											</i>
										</button>
									<?php } ?>
									<?php if($cookie && $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 != "true"){ ?>
										<button class="Total_Soft_Poll_2_But_Vote Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_Text);?>" onclick="Total_Soft_Poll_2_But_Vote(<?php echo $Total_Soft_Poll;?>, event)" >
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_VB_Text);?></span>
											</i>
										</button>
									<?php } ?>
								</div>
								<div class="Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>">
									<div class="Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>"></div>
									<button class="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_Text);?>" onclick="Total_Soft_Poll_2_Back(<?php echo $Total_Soft_Poll;?>)">
										<i class="totalsoft Total_Soft_Poll_1_Back_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_2_P_BB_Text);?></span>
										</i>
									</button>
								</div>
							</div>
							<input type="text" style="display: none;" id="TotalSoft_Poll_2_P_A_VEff_<?php echo $Total_Soft_Poll?>" value="<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_2_P_A_VEff;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_01_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_01;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_ID" value="<?php echo $Total_Soft_Poll;?>" >
							<input type="text" style="display: none;" id="TotalSoft_Poll_Vote" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10; ?>" >
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_02_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_03_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_04_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_05_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_05);?>">
						</div>
					</form>
					<?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Poll'){ ?>
						<div class="Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>" onclick = "Total_Soft_Poll_Video_Close(<?php echo $Total_Soft_Poll;?>)"></div>
						<div class="Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>">
							<div class="Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?>">
								<iframe src="" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							</div>
						</div>
					<?php }?>
					<script type="text/javascript">
						(function(){
							setTimeout(function(){
								console.log(document.querySelector(".Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>").clientWidth);
								if(document.querySelector(".Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>").clientWidth <= 300){
									jQuery(".Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>").css("width","100%");
									jQuery(".Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div").css("width","100%");
								}
							},1000)	
						})()
					</script>
					<?php
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02 != '')
						{
							?>
								<script type="text/javascript">
									Total_Soft_Poll_Upcoming(<?php echo $Total_Soft_Poll;?>);
								</script>
							<?php
						}
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03 != '')
						{
							?>
								<script type="text/javascript">
									Total_Soft_Poll_End_Poll(<?php echo $Total_Soft_Poll;?>, 'Image/Video');
								</script>
							<?php
						}
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 == 'true')
						{
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'phpcookie')
							{
								if(isset($_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll]))
								{
									if( $_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll] == 'Image/Video' )
									{
										?>
											<script type="text/javascript">
												Total_Soft_Poll_Ans_DivIm1(<?php echo $Total_Soft_Poll;?>);
											</script>
										<?php
									}
								}
							}
							else if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'ipaddress')
							{
								if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
									$Total_Soft_IP_Address = $_SERVER['HTTP_CLIENT_IP'];
								} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED_FOR' );
								} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED' );
								} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED_FOR' );
								} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED' );
								} elseif ( getenv( 'REMOTE_ADDR' ) ) {
									$Total_Soft_IP_Address = getenv( 'REMOTE_ADDR' );
								} else {
									$Total_Soft_IP_Address = 'UNKNOWN';
								}
								$Total_Soft_Poll_Info = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Poll_ID = %d AND IPAddress = %s order by id", $Total_Soft_Poll, $Total_Soft_IP_Address));
								if($Total_Soft_Poll_Info)
								{
									?>
										<script type="text/javascript">
											Total_Soft_Poll_Ans_DivIm1(<?php echo $Total_Soft_Poll;?>);
										</script>
									<?php
								}
							}
						}
					?>
				<?php } else if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Standart Without Button'){ ?>
					<style type="text/css">
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							overflow: hidden;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_MW;?>%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Pos == 'left'){ ?>
								float: left;
							<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Pos == 'right'){ ?>
								float: right;
							<?php } else { ?>
								margin: 0 auto;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BR;?>px;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Show == 'false' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'none'){ ?>
								-webkit-box-shadow: none;
								-moz-box-shadow: none;
								box-shadow: none;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'true'){ ?>
								-webkit-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'false'){ ?>
								-webkit-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh03'){ ?>
								box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh04'){ ?>
								box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?> inset;
								-webkit-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?> inset;
								-moz-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?> inset;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh05'){ ?>
								box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh06'){ ?>
								box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh07'){ ?>
								box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh08'){ ?>
								box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh09'){ ?>
								box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh10'){ ?>
								box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh_Type == 'sh11'){ ?>
								box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-moz-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
								-webkit-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxShC;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Q_BgC;?>;
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Q_C;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Q_FS;?>px;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Q_FF;?>;
							text-align: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_Q_TA;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> label { margin-bottom: 0px !important; }
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAQ_W;?>%;
							margin: 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAQ_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAQ_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAQ_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_MBgC;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
						{
							position:relative;
							display: inline-block;
							width: 100%;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BgC;?>;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BR;?>px;
							margin-top: 3px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_Sh == 'true'){ ?>
								padding: 7px 10px;
							<?php } else { ?>
								padding: 10px 10px 5px 10px;
							<?php }?>
							display: inline-block;
							float: none;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover
						{
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_HBgC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_HC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input
						{
							display: none;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_C;?> !important;
							<?php }?>
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_FS;?>px !important;
							cursor: pointer;
							margin-bottom: 0px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label:before
						{
							<?php if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_Sh == 'true'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_CBC;?>;
								content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_TBC;?>";
							<?php } else { ?>
								content: "" !important;
							<?php }?>
							margin: 0 .25em 0 0 !important;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_S=='big'){ ?>
								font-size: 32px !important;
								vertical-align: middle !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_S=='medium 2'){ ?>
								font-size: 26px !important;
								vertical-align: sub !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_S=='medium 1'){ ?>
								font-size: 22px !important;
								vertical-align: sub !important;
							<?php }else{ ?>
								font-size: 18px !important;
								vertical-align: initial !important;
							<?php }?>
							font-family: FontAwesome !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:before
						{
							<?php if( $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_Sh == 'true'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_CAC;?> !important;
								content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_CH_TAC;?>";
							<?php } else { ?>
								content: "" !important;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:after
						{
							font-weight: bold;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAA_W;?>%;
							margin: 5px auto 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAA_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAA_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_LAA_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_RB_MBgC;?>;
							position: relative;
							float: left;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_FS;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_Pos=='center'){ ?>
								width: 98% !important;
								margin: 5px 1%;
								text-align: center;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: default;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_VT_IA=='after'){ ?>
									float: right;
									margin-left: 5px;
								<?php }else{ ?>
									margin-right: 3px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_VT_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_MBgC;?>;
							position: absolute;
							overflow: hidden;
							float: left;
							width: 100%;
							margin-bottom: 0%;
							z-index: -1;
							opacity: 0;
							border-bottom-left-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BR-2;?>px;
							border-bottom-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BR-2;?>px;
							backface-visibility: hidden;
							height: -webkit-fill-available;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_IT;?>";
						}
						@media only screen and ( max-width: 500px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; }
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
							{
								width: 98% !important;
								margin: 5px 1%;
							}
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus
						{
							outline: none !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							overflow: hidden;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_MBgC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BR-3;?>px;
							opacity: 0;
							z-index: -1;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span3_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							display: inline-block;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BR-3;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							left: 0;
							height: 100%;
							min-width: 10px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_BgC;?> !important;
							<?php }?>
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_BR-2;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span5_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogress 2s linear infinite;
							-moz-animation: TSprogress 2s linear infinite;
							-webkit-animation: TSprogress 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span6_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogress 2s linear infinite;
							-moz-animation: TSprogress 2s linear infinite;
							-webkit-animation: TSprogress 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span7_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressa 2s linear infinite;
							-moz-animation: TSprogressa 2s linear infinite;
							-webkit-animation: TSprogressa 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span8_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressa 2s linear infinite;
							-moz-animation: TSprogressa 2s linear infinite;
							-webkit-animation: TSprogressa 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span9_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressb 2s linear infinite;
							-moz-animation: TSprogressb 2s linear infinite;
							-webkit-animation: TSprogressb 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span10_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressb 2s linear infinite;
							-moz-animation: TSprogressb 2s linear infinite;
							-webkit-animation: TSprogressb 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span11_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressc 2s linear infinite;
							-moz-animation: TSprogressc 2s linear infinite;
							-webkit-animation: TSprogressc 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span12_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressc 2s linear infinite;
							-moz-animation: TSprogressc 2s linear infinite;
							-webkit-animation: TSprogressc 2s linear infinite;
						}
						@-webkit-keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@-moz-keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@-webkit-keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@-moz-keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@-webkit-keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@-moz-keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@-webkit-keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						@-moz-keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						@keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							padding: 10px 10px 5px 10px;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_C;?> !important;
							<?php }?>
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?> span
						{
							margin-left: 10px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							left: 0 !important;
							top: 0 !important;
							width: 100% !important;
							height: 200%;
							overflow: hidden;
							z-index: -1;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_MBgC;?>;
						}
						.TotalSoftPoll_Ans_loading
						{
							background: rgba(241, 241, 241, 0.85);
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 999999999;
							display: none;
						}
						.TotalSoftPoll_Ans_loading_Img
						{
							margin: 0;
							padding: 0;
							width: 20px;
							height: 20px;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
						}
						.TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>
						{
							background:<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_06;?>;
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 999999999;
							display: none;
						}
						.TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>
						{
							margin: 0;
							padding: 0;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
							line-height: 1;
							color: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_07;?>;
							font-size: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_08;?>px;
							font-family: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_09;?>;
							cursor: default;
						}
					</style>
					<form method="POST" onsubmit="">
						<div class="Total_Soft_Poll_Main_Div">
							<div class="Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>">
								<span class="TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>">
									<span class="TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>">
										<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>
									</span>
								</span>
								<span class="TotalSoftPoll_Ans_loading">
									<img class="TotalSoftPoll_Ans_loading_Img" src="<?php echo plugins_url( "../Images/loading.gif", __FILE__ ); ?>">
								</span>
								<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
									<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
									<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
									<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){ ?>
										<div class="Total_Soft_Poll_1_Ans_Check_Div" style="height:40px;<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_CA == 'Background'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>">
											<input type="radio" class="Total_Soft_Poll_1_Ans_CheckBox" id="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" name="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Ans[$i]->id;?>">
											<?php
										$cookie = ( isset($_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll]) ) ? $_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll] : '';
									 if($cookie == ''){ ?>
												<label class="Total_Soft_Poll_1_Ans_Lab Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> totalsoft totalsoft-question-circle-o" for="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="width:100%;height:100%;box-sizing:border-box;<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>" onclick="Total_Soft_Poll_1_Ans_Lab('<?php echo $Total_Soft_Poll_Ans[$i]->id;?>',<?php echo $Total_Soft_Poll;?>, event)" ><?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?></label>
											<?php } ?>
											<?php if($cookie && $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 != "true"){ ?>
												<label class="Total_Soft_Poll_1_Ans_Lab Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> totalsoft totalsoft-question-circle-o" for="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="width:100%;height:100%;box-sizing:border-box;<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_3_A_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>" onclick="Total_Soft_Poll_1_Ans_Lab('<?php echo $Total_Soft_Poll_Ans[$i]->id;?>',<?php echo $Total_Soft_Poll;?>, event)" ><?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?></label>
											<?php } ?>
											<span class="Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="width:100%;height:100%;box-sizing:border-box;">
												<span class="Total_Soft_Poll_3_Span3_<?php echo $Total_Soft_Poll;?>">
													<span class="Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_CA == 'Background'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>; <?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_Eff == '0'){ ?> width: <?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . '%'; }?>">
													</span> 
													<label class="Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>">
														<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'countlab' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'percentlab' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'bothlab'){ ?>
															<?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?>
														<?php }?>
														<span class="Total_Soft_Poll_3_Span4_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span4_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>">
															<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'percent' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'percentlab'){ ?>
																<?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' %'; ?>
															<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'count' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_T == 'countlab' ){ ?>
																<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes; ?>
															<?php } else { ?>
																<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes . ' ( ' . round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' % )'; ?>
															<?php } ?>
														</span>
													</label>
												</span>
											</span>
										</div>
									<?php }?>
									<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
									<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Show == 'true'){ ?>
										<button class="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Text);?>" onclick="Total_Soft_Poll_3_Result(<?php echo $Total_Soft_Poll;?>)">
											<i class="totalsoft Total_Soft_Poll_1_Result_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_RB_Text);?></span>
											</i>
										</button>
									<?php }?>
									<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_Show == 'true'){ ?>
										<i class="totalsoft Total_Soft_Poll_1_Total_View_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_TV_Text) . ' : ' . $Total_Soft_Poll_Res_Count1;?></span>
										</i>
									<?php }?>
								</div>
								<div class="Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>">
									<div class="Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>"></div>
									<button class="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_Text);?>" onclick="Total_Soft_Poll_3_Back(<?php echo $Total_Soft_Poll;?>)">
										<i class="totalsoft Total_Soft_Poll_1_Back_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_BB_Text);?></span>
										</i>
									</button>
								</div>
							</div>
							<input type="text" style="display: none;" id="TotalSoft_Poll_3_ID" value="<?php echo $Total_Soft_Poll;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_3_Vote" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10; ?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_3_V_Eff_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_3_V_Eff;?>">
							<input type="text" style="display: none;" id="TotalSoftPoll_Ans_C_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_01_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_01;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_02_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_03_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_04_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_05_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_05);?>">
						</div>
						<?php
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02 != '')
							{
								?>
									<script type="text/javascript">
										Total_Soft_Poll_Upcoming(<?php echo $Total_Soft_Poll;?>);
									</script>
								<?php
							}
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03 != '')
							{
								?>
									<script type="text/javascript">
										Total_Soft_Poll_End_Poll(<?php echo $Total_Soft_Poll;?>, 'StandartWB');
									</script>
								<?php
							}
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 == 'true')
							{
								if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'phpcookie')
								{
									if(isset($_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll]))
									{
										if( $_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll] == 'StandartWB' )
										{
											?>
												<script type="text/javascript">
													Total_Soft_Poll_Ans_DivSt1(<?php echo $Total_Soft_Poll;?>);
												</script>
											<?php
										}
									}
								}
								else if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'ipaddress')
								{
									if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
										$Total_Soft_IP_Address = $_SERVER['HTTP_CLIENT_IP'];
									} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED_FOR' );
									} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED' );
									} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED_FOR' );
									} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED' );
									} elseif ( getenv( 'REMOTE_ADDR' ) ) {
										$Total_Soft_IP_Address = getenv( 'REMOTE_ADDR' );
									} else {
										$Total_Soft_IP_Address = 'UNKNOWN';
									}
									$Total_Soft_Poll_Info = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Poll_ID = %d AND IPAddress = %s order by id", $Total_Soft_Poll, $Total_Soft_IP_Address));
									if($Total_Soft_Poll_Info)
									{
										?>
											<script type="text/javascript">
												Total_Soft_Poll_Ans_DivSt1(<?php echo $Total_Soft_Poll;?>);
											</script>
										<?php
									}
								}
							}
						?>
					</form>
				<?php } else if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image Without Button' || $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video Without Button'){ ?>
					<style type="text/css">
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							overflow: hidden;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_MW;?>%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pos == 'left'){ ?>
								float: left;
							<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pos == 'right'){ ?>
								float: right;
							<?php } else { ?>
								margin: 0 auto;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BR;?>px;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Show == 'false' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'none'){ ?>
								-webkit-box-shadow: none;
								-moz-box-shadow: none;
								box-shadow: none;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'true'){ ?>
								-webkit-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'false'){ ?>
								-webkit-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh03'){ ?>
								box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh04'){ ?>
								box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?> inset;
								-webkit-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?> inset;
								-moz-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?> inset;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh05'){ ?>
								box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh06'){ ?>
								box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh07'){ ?>
								box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh08'){ ?>
								box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh09'){ ?>
								box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh10'){ ?>
								box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxSh_Type == 'sh11'){ ?>
								box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-moz-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
								-webkit-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BoxShC;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Q_BgC;?>;
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Q_C;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Q_FS;?>px;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Q_FF;?>;
							text-align: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Q_TA;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> label
						{
							margin-bottom: 0px !important;
							font-weight: 400 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAQ_W;?>%;
							margin: 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAQ_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAQ_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAQ_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_MBgC;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
						{
							position:relative;
							display: inline-block;
							width: 100%;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BgC;?>;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BR;?>px;
							margin-top: 3px;
							line-height: 1 !important;
							height: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H;?>px;
							overflow: hidden;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							display: inline-block;
							float: none;
							width: 100%;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_FF;?>;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_C;?> !important;
							<?php }?>
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_FS;?>px !important;
							cursor: pointer;
							margin-bottom: 0px !important;
							position: relative;
							top: 50%;
							-ms-transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							-o-transform: translateY(-50%);
							transform: translateY(-50%);
							padding-left: 10px;
							font-weight: 400 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover
						{
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_HBgC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_HC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div img
						{
							height: 100% !important;
							width: 100%;
							margin: 0 !important;
							padding: 0 !important;
							float: none !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1
						{
							position: relative;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '1'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '2'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*16/9;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '3'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*9/16;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '4'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*3/4;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '5'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*4/3;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '6'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*3/2;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '7'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*2/3;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '8'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*8/5;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '9'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*5/8;?>px;
							<?php }?>
							height: 100%;
							float: left;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div2
						{
							position: relative;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '1'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '2'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*16/9;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '3'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*9/16;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '4'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*3/4;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '5'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*4/3;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '6'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*3/2;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '7'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*2/3;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '8'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*8/5;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '9'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*5/8;?>px);
							<?php }?>
							height: 100%;
							float: left;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1_Ov
						{
							position: absolute;
							width: 100%;
							height: 100%;
							top: 0;
							left: 0;
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_OC;?>;
							z-index: -1;
							opacity: 0;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1:hover .Total_Soft_Poll_1_Ans_Check_Div1_Ov_<?php echo $Total_Soft_Poll;?>
						{
							z-index: 999;
							opacity: 1;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1_Ov span
						{
							display: block;
							width: 100%;
							text-align: center;
							position: relative;
							top: 50%;
							-ms-transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							-o-transform: translateY(-50%);
							transform: translateY(-50%);
							font-weight: 400 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1_Ov .Total_Soft_Poll_1_IM_Or_VI_Icon
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_IC;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_IS;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1_Ov .Total_Soft_Poll_1_IM_Or_VI_Icon:before
						{
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAA_W;?>%;
							margin: 5px auto 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAA_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAA_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_LAA_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_MBgC;?>;
							position: relative;
							float: left;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_TV_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_TV_FS;?>px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_TV_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_TV_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_TV_Pos=='center'){ ?>
								width: 98% !important;
								margin: 5px 1%;
								text-align: center;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_TV_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: default;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_TV_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_VT_IA=='after'){ ?>
									float: right;
									margin-left: 5px;
								<?php }else{ ?>
									margin-right: 3px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_VT_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_MBgC;?>;
							position: absolute;
							overflow: hidden;
							float: left;
							width: 100%;
							margin-bottom: 0%;
							z-index: -1;
							opacity: 0;
							border-bottom-left-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BR-2;?>px;
							border-bottom-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_BR-2;?>px;
							backface-visibility: hidden;
							height: -webkit-fill-available;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_IT;?>";
						}
						@media only screen and ( max-width: 850px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 90% !important; }
						}
						@media only screen and ( max-width: 500px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; }
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
							{
								width: 98% !important;
								margin: 5px 1%;
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
							{
								height: 50px !important;
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div1
							{
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '1'){ ?>
									width: 50px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '2'){ ?>
									width: <?php echo 50*16/9;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '3'){ ?>
									width: <?php echo 50*9/16;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '4'){ ?>
									width: <?php echo 50*3/4;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '5'){ ?>
									width: <?php echo 50*4/3;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '6'){ ?>
									width: <?php echo 50*3/2;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '7'){ ?>
									width: <?php echo 50*2/3;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '8'){ ?>
									width: <?php echo 50*8/5;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '9'){ ?>
									width: <?php echo 50*5/8;?>px !important;
								<?php }?>
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div2
							{
								position: relative;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '1'){ ?>
									width: calc(100% - 50px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '2'){ ?>
									width: calc(100% - <?php echo 50*16/9;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '3'){ ?>
									width: calc(100% - <?php echo 50*9/16;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '4'){ ?>
									width: calc(100% - <?php echo 50*3/4;?>px) !important
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '5'){ ?>
									width: calc(100% - <?php echo 50*4/3;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '6'){ ?>
									width: calc(100% - <?php echo 50*3/2;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '7'){ ?>
									width: calc(100% - <?php echo 50*2/3;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '8'){ ?>
									width: calc(100% - <?php echo 50*8/5;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '9'){ ?>
									width: calc(100% - <?php echo 50*5/8;?>px) !important;
								<?php }?>
							}
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>
							{
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '1'){ ?>
									width: calc(100% - 50px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '2'){ ?>
									width: calc(100% - <?php echo 50*16/9;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '3'){ ?>
									width: calc(100% - <?php echo 50*9/16;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '4'){ ?>
									width: calc(100% - <?php echo 50*3/4;?>px) !important
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '5'){ ?>
									width: calc(100% - <?php echo 50*4/3;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '6'){ ?>
									width: calc(100% - <?php echo 50*3/2;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '7'){ ?>
									width: calc(100% - <?php echo 50*2/3;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '8'){ ?>
									width: calc(100% - <?php echo 50*8/5;?>px) !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '9'){ ?>
									width: calc(100% - <?php echo 50*5/8;?>px) !important;
								<?php }?>
							}
							.Total_Soft_Poll_1_Ans_Fix_3_<?php echo $Total_Soft_Poll;?> img { max-height: 250px !important; }
							.Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?> { width: 100% !important; left: 0 !important; top: 10px !important; }
							.Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Ans_Fix_3_<?php echo $Total_Soft_Poll;?> img { border: none !important; }
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus
						{
							outline: none !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							right: 0;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '1'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '2'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*16/9;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '3'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*9/16;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '4'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*3/4;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '5'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*4/3;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '6'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*3/2;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '7'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*2/3;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '8'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*8/5;?>px);
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_Ra == '9'){ ?>
								width: calc(100% - <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_I_H*5/8;?>px);
							<?php }?>
							height: 100%;
							padding-left: 5px;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_MBgC;?> !important;
							border-top-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BR-2;?>px;
							border-bottom-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BR-2;?>px;
							opacity: 0;
							z-index: -1;
							cursor: default;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span3_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							display: inline-block;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BR-3;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							left: 0;
							height: 100%;
							min-width: 10px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_BgC;?> !important;
							<?php }?>
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_BR-2;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span5_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogress 2s linear infinite;
							-moz-animation: TSprogress 2s linear infinite;
							-webkit-animation: TSprogress 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span6_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogress 2s linear infinite;
							-moz-animation: TSprogress 2s linear infinite;
							-webkit-animation: TSprogress 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span7_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressa 2s linear infinite;
							-moz-animation: TSprogressa 2s linear infinite;
							-webkit-animation: TSprogressa 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span8_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressa 2s linear infinite;
							-moz-animation: TSprogressa 2s linear infinite;
							-webkit-animation: TSprogressa 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span9_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressb 2s linear infinite;
							-moz-animation: TSprogressb 2s linear infinite;
							-webkit-animation: TSprogressb 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span10_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressb 2s linear infinite;
							-moz-animation: TSprogressb 2s linear infinite;
							-webkit-animation: TSprogressb 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span11_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressc 2s linear infinite;
							-moz-animation: TSprogressc 2s linear infinite;
							-webkit-animation: TSprogressc 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span12_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressc 2s linear infinite;
							-moz-animation: TSprogressc 2s linear infinite;
							-webkit-animation: TSprogressc 2s linear infinite;
						}
						@-webkit-keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@-moz-keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@-webkit-keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@-moz-keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@-webkit-keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@-moz-keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@-webkit-keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						@-moz-keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						@keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							display: inline-block;
							-ms-transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							-o-transform: translateY(-50%);
							transform: translateY(-50%);
							top: 50%;
							left: 0;
							width: 100%;
							padding: 0px 15px;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_C;?> !important;
							<?php }?>
							font-weight: 400 !important;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_FF;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_FS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?> span
						{
							margin-left: 10px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_MBgC;?>;
							left: 0 !important;
							top: 0 !important;
							width: 100% !important;
							height: 200%;
							overflow: hidden;
							z-index: -1;
						}
						.Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>
						{
							position: fixed;
							width: 100%;
							height: 100%;
							background-color: rgba(0, 0, 0, 0.3);
							left: 0;
							top: 0;
							z-index: 99999999999999;
							display: none;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>
						{
							position: fixed;
							z-index: 9999999999;
							width: 50%;
							left: 25%;
							top: 20%;
							height: 0;
							padding-bottom: 56.25%;
							display: none;
						}
						.Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?> iframe
						{
							position: absolute;
							width: 100%;
							height: 100%;
							top: 0;
							left: 0;
							right: 0;
						}
						.Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: 100%;
							padding-top: 56.25%; /* 16:9 Aspect Ratio */
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_BC;?>;
						}
						.Total_Soft_Poll_1_Ans_Fix_3_<?php echo $Total_Soft_Poll;?>
						{
							position: fixed;
							z-index: 9999999999;
							width: 100%;
							left: 0%;
							top: 50%;
							transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							text-align: center;
							float: left;
							display: none;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Ans_Fix_3_<?php echo $Total_Soft_Poll;?> img
						{
							position: relative;
							width: auto;
							height: 100% !important;
							max-height: 550px;
							top: 0;
							left: 0;
							right: 0;
							margin: 0 auto !important;
							padding: 0 !important;
							float: none !important;
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_BC;?>;
						}
						.Total_Soft_Poll_1_Ans_Fix_4_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: 100%;
						}
						.Total_Soft_Poll_1_Popup_Close_Icon_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_IC;?>;
							font-size: 25px;
							position: absolute;
							z-index: 999999;
							top: 0;
							-ms-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-o-transform: translate(-50%, -50%);
							transform: translate(-50%, -50%);
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Popup_Close_IconV_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_IC;?>;
							font-size: 25px;
							position: absolute;
							z-index: 999999;
							top: 0;
							right: 0;
							-ms-transform: translate(50%, -50%);
							-webkit-transform: translate(50%, -50%);
							-moz-transform: translate(50%, -50%);
							-o-transform: translate(50%, -50%);
							transform: translate(50%, -50%);
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Popup_Close_Icon_<?php echo $Total_Soft_Poll;?>:before, .Total_Soft_Poll_1_Popup_Close_IconV_<?php echo $Total_Soft_Poll;?>:before
						{
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_IT;?>";
						}
						.TotalSoftPoll_Ans_loading
						{
							background: rgba(241, 241, 241, 0.85);
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 999999999;
							display: none;
						}
						.TotalSoftPoll_Ans_loading_Img
						{
							margin: 0;
							padding: 0;
							width: 20px;
							height: 20px;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
						}
						.TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>
						{
							background:<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_06;?>;
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 999999999;
							display: none;
						}
						.TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>
						{
							margin: 0;
							padding: 0;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
							line-height: 1;
							color: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_07;?>;
							font-size: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_08;?>px;
							font-family: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_09;?>;
							cursor: default;
						}
					</style>
					<form method="POST" onsubmit="">
						<div class="Total_Soft_Poll_Main_Div">
							<div class="Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>">
								<span class="TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>">
									<span class="TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>">
										<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>
									</span>
								</span>
								<span class="TotalSoftPoll_Ans_loading">
									<img class="TotalSoftPoll_Ans_loading_Img" src="<?php echo plugins_url( "../Images/loading.gif", __FILE__ ); ?>">
								</span>
								<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
									<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
									<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
									<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){
										if(strpos($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im,"youtube"))
										{
											$rest = substr($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im, 0, -13);
											$link = $rest . 'maxresdefault.jpg';
											if(@fopen("$link",'r')) { $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im = $link; }
										}
										?>
										<div class="Total_Soft_Poll_1_Ans_Check_Div" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_CA == 'Background'){ ?>background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>">
											<div class="Total_Soft_Poll_1_Ans_Check_Div1" <?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_TType == 'Image Without Button'){ ?> onclick='Total_Soft_Poll_4_Popup_Im(<?php echo $Total_Soft_Poll;?>, "<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im;?>")' <?php }else{ ?> onclick='Total_Soft_Poll_4_Popup_VI(<?php echo $Total_Soft_Poll;?>, "<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Vd;?>")' <?php }?> >
												<img src="<?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Im;?>">
												<div class="Total_Soft_Poll_1_Ans_Check_Div1_Ov Total_Soft_Poll_1_Ans_Check_Div1_Ov_<?php echo $Total_Soft_Poll;?>">
													<span>
														<i class="totalsoft Total_Soft_Poll_1_IM_Or_VI_Icon"></i>
													</span>
												</div>
											</div>
											<?php $cookie = ( isset($_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll]) ) ? $_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll] : '';
									 if($cookie == ''){ ?>
												<div class="Total_Soft_Poll_1_Ans_Check_Div2 Total_Soft_Poll_1_Ans_Check_Div2_<?php echo $Total_Soft_Poll;?>"  onclick="Total_Soft_Poll_1_Ans_Check_Div2('<?php echo $Total_Soft_Poll_Ans[$i]->id;?>',<?php echo $Total_Soft_Poll;?>,event)">
													<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>"><?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?></label>
												</div>
											<?php } ?>
											<?php if($cookie && $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 != "true"){ ?>
												<div class="Total_Soft_Poll_1_Ans_Check_Div2 Total_Soft_Poll_1_Ans_Check_Div2_<?php echo $Total_Soft_Poll;?>"  onclick="Total_Soft_Poll_1_Ans_Check_Div2('<?php echo $Total_Soft_Poll_Ans[$i]->id;?>',<?php echo $Total_Soft_Poll;?>,event)">
													<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_A_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>"><?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?></label>
												</div>
											<?php } ?>
											<span class="Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>">
												<span class="Total_Soft_Poll_3_Span3_<?php echo $Total_Soft_Poll;?>">
													<span class="Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_CA == 'Background'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>; <?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_Eff == '0'){ ?> width: <?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . '%'; }?>">
													</span> 
													<label class="Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>">
														<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'countlab' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'percentlab' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'bothlab'){ ?>
															<?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?>
														<?php }?>
														<span class="Total_Soft_Poll_3_Span4_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span4_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>">
															<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'percent' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'percentlab'){ ?>
																<?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' %'; ?>
															<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'count' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_T == 'countlab' ){ ?>
																<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes; ?>
															<?php } else { ?>
																<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes . ' ( ' . round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' % )'; ?>
															<?php } ?>
														</span>
													</label>
												</span>
											</span>
										</div>
									<?php }?>
									<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
									<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Show == 'true'){ ?>
										<button class="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Text);?>" onclick="Total_Soft_Poll_4_Result(<?php echo $Total_Soft_Poll;?>)">
											<i class="totalsoft Total_Soft_Poll_1_Result_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_RB_Text);?></span>
											</i>
										</button>
									<?php }?>
									<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_TV_Show == 'true'){ ?>
										<i class="totalsoft Total_Soft_Poll_1_Total_View_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_TV_Text) . ' : ' . $Total_Soft_Poll_Res_Count1;?></span>
										</i>
									<?php }?>
								</div>
								<div class="Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>">
									<div class="Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>"></div>
									<button class="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_Text);?>" onclick="Total_Soft_Poll_4_Back(<?php echo $Total_Soft_Poll;?>)">
										<i class="totalsoft Total_Soft_Poll_1_Back_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_BB_Text);?></span>
										</i>
									</button>
								</div>
							</div>
							<input type="text" style="display: none;" id="TotalSoft_Poll_3_IV_ID" value="<?php echo $Total_Soft_Poll;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_3_IV_Vote" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10; ?>">


							<input type="text" style="display: none;" id="TotalSoft_Poll_3_V_Eff_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_4_V_Eff;?>">
							<input type="text" style="display: none;" id="TotalSoftPoll_Ans_C_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_01_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_01;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_02_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_03_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_04_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_05_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_05);?>">
						</div>
					</form>
					<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_4_Pop_Show == 'true'){ ?>
						<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_TType == 'Video Without Button'){ ?>
							<div class="Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>" onclick = "Total_Soft_Poll_Video_Close(<?php echo $Total_Soft_Poll;?>)"></div>
							<div class="Total_Soft_Poll_1_Ans_Fix_1_<?php echo $Total_Soft_Poll;?>">
								<div class="Total_Soft_Poll_1_Ans_Fix_2_<?php echo $Total_Soft_Poll;?>">
									<i class="totalsoft Total_Soft_Poll_1_Popup_Close_IconV_<?php echo $Total_Soft_Poll;?>" onclick = "Total_Soft_Poll_Video_Close(<?php echo $Total_Soft_Poll;?>)"></i>
									<iframe src="" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
								</div>
							</div>
						<?php } else { ?>
							<div class="Total_Soft_Poll_1_Ans_Fix_<?php echo $Total_Soft_Poll;?>" onclick = "Total_Soft_Poll_Image_Close(<?php echo $Total_Soft_Poll;?>)"></div>
							<div class="Total_Soft_Poll_1_Ans_Fix_3_<?php echo $Total_Soft_Poll;?>" onclick = "Total_Soft_Poll_Image_Close(<?php echo $Total_Soft_Poll;?>)">
								<img src=""/>
								<i class="totalsoft Total_Soft_Poll_1_Popup_Close_Icon_<?php echo $Total_Soft_Poll;?>" onclick = "Total_Soft_Poll_Image_Close(<?php echo $Total_Soft_Poll;?>)"></i>
							</div>
						<?php }?>
					<?php }?>
					<?php
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02 != '')
						{
							?>
								<script type="text/javascript">
									Total_Soft_Poll_Upcoming(<?php echo $Total_Soft_Poll;?>);
								</script>
							<?php
						}
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03 != '')
						{
							?>
								<script type="text/javascript">
									Total_Soft_Poll_End_Poll(<?php echo $Total_Soft_Poll;?>, 'ImageWB/VideoWB');
								</script>
							<?php
						}
						if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 == 'true')
						{
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'phpcookie')
							{
								if(isset($_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll])) 
								{
									if( $_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll] == 'ImageWB/VideoWB' )
									{
										?>
											<script type="text/javascript">
												Total_Soft_Poll_Ans_DivIV1(<?php echo $Total_Soft_Poll;?>);
											</script>
										<?php
									}
								}
							}
							else if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'ipaddress')
							{
								if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
									$Total_Soft_IP_Address = $_SERVER['HTTP_CLIENT_IP'];
								} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED_FOR' );
								} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED' );
								} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED_FOR' );
								} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
									$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED' );
								} elseif ( getenv( 'REMOTE_ADDR' ) ) {
									$Total_Soft_IP_Address = getenv( 'REMOTE_ADDR' );
								} else {
									$Total_Soft_IP_Address = 'UNKNOWN';
								}
								$Total_Soft_Poll_Info = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Poll_ID = %d AND IPAddress = %s order by id", $Total_Soft_Poll, $Total_Soft_IP_Address));
								if($Total_Soft_Poll_Info)
								{
									?>
										<script type="text/javascript">
											Total_Soft_Poll_Ans_DivIV1(<?php echo $Total_Soft_Poll;?>);
										</script>
									<?php
								}
							}
						}
					?>
				<?php } else if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image in Question' || $Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video in Question'){ ?>
					<style type="text/css">
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							overflow: hidden;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_MW;?>%;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Pos == 'left'){ ?>
								float: left;
							<?php } else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Pos == 'right'){ ?>
								float: right;
							<?php } else { ?>
								margin: 0 auto;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BR;?>px;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Show == 'false' || $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'none'){ ?>
								-webkit-box-shadow: none;
								-moz-box-shadow: none;
								box-shadow: none;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'true'){ ?>
								-webkit-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								box-shadow: 0px 0px 13px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'false'){ ?>
								-webkit-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								box-shadow: 0 25px 13px -18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh03'){ ?>
								box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 0 10px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh04'){ ?>
								box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?> inset;
								-webkit-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?> inset;
								-moz-box-shadow:0 1px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>, 0 0 40px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?> inset;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh05'){ ?>
								box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 0 0 10px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh06'){ ?>
								box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 4px -4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh07'){ ?>
								box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 5px 5px 3px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh08'){ ?>
								box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh09'){ ?>
								box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 8px 8px 18px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh10'){ ?>
								box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 0 8px 6px -6px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh_Type == 'sh11'){ ?>
								box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-moz-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
								-webkit-box-shadow: 0 0 18px 7px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxShC;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Q_BgC;?>;
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Q_C;?>;
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Q_FS;?>px;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Q_FF;?>;
							text-align: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_Q_TA;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> label
						{
							display: block; 
							width: 100%;
							margin-bottom: 0px !important;
							cursor: default !important;
							line-height: 2 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAQ_W;?>%;
							margin: 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAQ_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAQ_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAQ_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_MBgC;?>;
							padding: 5px 10px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div
						{
							position:relative;
							display: inline-block;
							width: 100%;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BgC;?>;
							<?php }?>
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BC;?>;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BR;?>px;
							margin-top: 3px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							padding: 7px 10px;
							display: inline-block;
							float: none;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover
						{
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_HBgC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div:hover .Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?>
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_HC;?> !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input
						{
							display: none;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label
						{
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_C;?> !important;
							<?php }?>
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_FS;?>px !important;
							cursor: pointer;
							margin-bottom: 0px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input + label:before
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_CBC;?>;
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_TBC;?>";
							margin: 0 .25em 0 0 !important;
							padding: 0 !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_S=='big'){ ?>
								font-size: 32px !important;
								vertical-align: middle !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_S=='medium 2'){ ?>
								font-size: 26px !important;
								vertical-align: sub !important;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_S=='medium 1'){ ?>
								font-size: 22px !important;
								vertical-align: sub !important;
							<?php }else{ ?>
								font-size: 18px !important;
								vertical-align: initial !important;
							<?php }?>
							font-family: FontAwesome !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:before
						{
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_CAC;?> !important;
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_CH_TAC;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Ans_Check_Div input:checked + label:after
						{
							font-weight: bold;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAA_W;?>%;
							margin: 5px auto 0 auto;
							border-top: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAA_H;?>px <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAA_S;?> <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_LAA_C;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background-color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_MBgC;?>;
							position: relative;
							float: left;
							width: 100%;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Result_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_FS;?>px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_Pos=='center'){ ?>
								width: 98% !important;
								margin: 5px 1%;
								text-align: center;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: default;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Total_View_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_TV_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VT_IA=='after'){ ?>
									float: right;
									margin-left: 5px;
								<?php }else{ ?>
									margin-right: 3px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VT_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>
						{
							padding: 0px;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_MBgC;?>;
							position: absolute;
							overflow: hidden;
							float: left;
							width: 100%;
							margin-bottom: 0%;
							z-index: -1;
							opacity: 0;
							border-bottom-left-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BR-2;?>px;
							border-bottom-right-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BR-2;?>px;
							backface-visibility: hidden;
							height: -webkit-fill-available;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Back_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_IT;?>";
						}
						@media only screen and ( max-width: 500px )
						{
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> { width: 100% !important; }
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>
							{
								width: 98% !important;
								margin: 5px 1%;
							}
							.Total_Soft_Poll_1_Q_Iframe_1_<?php echo $Total_Soft_Poll;?> { width: 98% !important; }
							.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> img
							{
								margin: 0px auto !important;
								<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '1'){ ?>
									width: 150px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '2'){ ?>
									width: <?php echo 150*16/9;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '3'){ ?>
									width: <?php echo 150*9/16;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '4'){ ?>
									width: <?php echo 150*3/4;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '5'){ ?>
									width: <?php echo 150*4/3;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '6'){ ?>
									width: <?php echo 150*3/2;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '7'){ ?>
									width: <?php echo 150*2/3;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '8'){ ?>
									width: <?php echo 150*8/5;?>px !important;
								<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '9'){ ?>
									width: <?php echo 150*5/8;?>px !important;
								<?php }?>
								height: 150px !important;
								max-width: 98% !important;
								padding: 0 !important;
								float: none !important;
							}
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>:focus, .Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>:focus
						{
							outline: none !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_MBgC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BR-3;?>px;
							opacity: 0;
							z-index: -1;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span3_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							display: inline-block;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BR-3;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							left: 0;
							height: 100%;
							min-width: 10px !important;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_CA != 'Background'){ ?>
								background-color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_BgC;?> !important;
							<?php }?>
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_BR-2;?>px;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span5_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogress 2s linear infinite;
							-moz-animation: TSprogress 2s linear infinite;
							-webkit-animation: TSprogress 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span6_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogress 2s linear infinite;
							-moz-animation: TSprogress 2s linear infinite;
							-webkit-animation: TSprogress 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span7_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressa 2s linear infinite;
							-moz-animation: TSprogressa 2s linear infinite;
							-webkit-animation: TSprogressa 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span8_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressa 2s linear infinite;
							-moz-animation: TSprogressa 2s linear infinite;
							-webkit-animation: TSprogressa 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span9_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressb 2s linear infinite;
							-moz-animation: TSprogressb 2s linear infinite;
							-webkit-animation: TSprogressb 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span10_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressb 2s linear infinite;
							-moz-animation: TSprogressb 2s linear infinite;
							-webkit-animation: TSprogressb 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span11_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-moz-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							-webkit-box-shadow: 0 5px 5px rgba(255,255,255,0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressc 2s linear infinite;
							-moz-animation: TSprogressc 2s linear infinite;
							-webkit-animation: TSprogressc 2s linear infinite;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span12_<?php echo $Total_Soft_Poll;?>
						{
							background-size: 30px 30px;
							-moz-background-size: 30px 30px;
							-webkit-background-size: 30px 30px;
							-o-background-size: 30px 30px;
							background-image: -moz-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0.2)), color-stop(25%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0.2)), color-stop(75%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0)));
							background-image: -o-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							background-image: -ms-linear-gradient(-45deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0) 25%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, rgba(255,255,255,0) 75%, rgba(255,255,255,0) 100%);
							filter: progid:-DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0 );
							animation: TSprogressc 2s linear infinite;
							-moz-animation: TSprogressc 2s linear infinite;
							-webkit-animation: TSprogressc 2s linear infinite;
						}
						@-webkit-keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@-moz-keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@keyframes TSprogress { 0% { background-position: 0 0; } 100% { background-position: -60px -60px; } }
						@-webkit-keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@-moz-keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@keyframes TSprogressa { 0% { background-position: 0 0; } 100% { background-position: -60px 60px; } }
						@-webkit-keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@-moz-keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@keyframes TSprogressb { 0% { background-position: 0 0; } 100% { background-position: 60px -60px; } }
						@-webkit-keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						@-moz-keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						@keyframes TSprogressc { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							display: inline-block;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							padding: 10px 10px 5px 10px;
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_CA != 'Color'){ ?>
								color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_C;?> !important;
							<?php }?>
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh > 0 && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh < 50){ ?>
								font-family: Arial;
							<?php } else { ?>
								font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_BoxSh;?>;
							<?php }?>
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?> span
						{
							margin-left: 10px;
							line-height: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>
						{
							position: absolute;
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_MBgC;?>;
							left: 0 !important;
							top: 0 !important;
							width: 100% !important;
							height: 200%;
							overflow: hidden;
							z-index: -1;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>
						{
							background: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_BgC;?> !important;
							border: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_BW;?>px solid <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_BC;?> !important;
							border-radius: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_BR;?>px !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_Pos=='right'){ ?>
								float: right;
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_Pos=='left'){ ?>
								margin: 5px 10px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_Pos=='full'){ ?>
								width: 98% !important;
								margin: 5px 1%;
							<?php }?>
							color: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_C;?> !important;
							padding: 3px 10px !important;
							text-transform: none !important;
							line-height: 1 !important;
							cursor: pointer;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> span
						{
							font-size: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_FS;?>px !important;
							font-family: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_FF;?>;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>:hover
						{
							background: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_HBgC;?> !important;
							color: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_HC;?> !important;
							opacity: 1 !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Vote_But_Icon
						{
							font-size: <?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_IS;?>px !important;
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Vote_But_Icon:before
						{
							<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_Text!=''){ ?>
								<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_IA=='after'){ ?>
									float: right;
									margin-left: 10px;
								<?php }else{ ?>
									margin-right: 10px;
								<?php }?>
							<?php }?>
							content: "\<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_IT;?>";
						}
						.Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?> .Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?> img
						{
							margin: 0px auto !important;
							<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '1'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '2'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*16/9;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '3'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*9/16;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '4'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*3/4;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '5'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*4/3;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '6'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*3/2;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '7'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*2/3;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '8'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*8/5;?>px;
							<?php }else if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_Ra == '9'){ ?>
								width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H*5/8;?>px;
							<?php }?>
							height: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_I_H;?>px !important;
							padding: 0 !important;
							float: none !important;
						}
						.Total_Soft_Poll_1_Q_Iframe_1_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: <?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_V_W;?>%;
							margin: 0 auto;
						}
						.Total_Soft_Poll_1_Q_Iframe_2_<?php echo $Total_Soft_Poll;?>
						{
							position: relative;
							width: 100%;
							padding-top: 56.25%;
						}
						.Total_Soft_Poll_1_Q_Iframe_2_<?php echo $Total_Soft_Poll;?> iframe
						{
							position: absolute;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
						}
						.TotalSoftPoll_Ans_loading
						{
							background: rgba(241, 241, 241, 0.85);
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 999999999;
							display: none;
						}
						.TotalSoftPoll_Ans_loading_Img
						{
							margin: 0;
							padding: 0;
							width: 20px;
							height: 20px;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
						}
						.TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>
						{
							background:<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_06;?>;
							position: absolute;
							top: 0;
							left: 0;
							text-align: center;
							width: 100%;
							height: 100%;
							line-height: 1;
							z-index: 999999999;
							display: none;
						}
						.TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>
						{
							margin: 0;
							padding: 0;
							position: absolute;
							left: 50%;
							top: 50%;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
							line-height: 1;
							color: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_07;?>;
							font-size: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_08;?>px;
							font-family: <?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_09;?>;
							cursor: default;
						}
					</style>
					<form method="POST" onsubmit="">
						<div class="Total_Soft_Poll_Main_Div">
							<div class="Total_Soft_Poll_1_Main_Div_<?php echo $Total_Soft_Poll;?>">
								<span class="TotalSoftPoll_Ans_ComingSoon_<?php echo $Total_Soft_Poll;?>">
									<span class="TotalSoftPoll_Ans_ComingSoon_Span_<?php echo $Total_Soft_Poll;?>">
										<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>
									</span>
								</span>
								<span class="TotalSoftPoll_Ans_loading">
									<img class="TotalSoftPoll_Ans_loading_Img" src="<?php echo plugins_url( "../Images/loading.gif", __FILE__ ); ?>">
								</span>
								<div class="Total_Soft_Poll_1_Quest_Div_<?php echo $Total_Soft_Poll;?>">
									<?php if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Image in Question'){ ?>
										<label>
											<img src="<?php echo $Total_Soft_Poll_Q_M[0]->TotalSoftPoll_Q_Im;?>">
										</label>
									<?php }else if($Total_Soft_Poll_Themes[0]->TotalSoft_Poll_TType == 'Video in Question'){ ?>
										<div class="Total_Soft_Poll_1_Q_Iframe_1_<?php echo $Total_Soft_Poll;?>">
											<div class="Total_Soft_Poll_1_Q_Iframe_2_<?php echo $Total_Soft_Poll;?>">
												<iframe src="<?php echo $Total_Soft_Poll_Q_M[0]->TotalSoftPoll_Q_Vd;?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
											</div>
										</div>
									<?php }?>
									<label><?php echo html_entity_decode($Total_Soft_Poll_Man[0]->TotalSoftPoll_Question);?></label>
									<div class="Total_Soft_Poll_1_LAQ_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_Ans_Div_<?php echo $Total_Soft_Poll;?>">
									<?php for($i = 0 ; $i < $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C; $i++){ ?>
										<div class="Total_Soft_Poll_1_Ans_Check_Div" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_CA == 'Background'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>">
											<input type="radio" class="Total_Soft_Poll_1_Ans_CheckBox" id="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" name="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Ans[$i]->id;?>">
											<label class="Total_Soft_Poll_1_Ans_Lab_<?php echo $Total_Soft_Poll;?> totalsoft totalsoft-question-circle-o" for="Total_Soft_Poll_1_Ans_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_A_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>" <?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_Show != 'true'){ ?>onclick="Total_Soft_Poll_3_Vote(<?php echo $Total_Soft_Poll;?>, <?php echo $Total_Soft_Poll_Ans[$i]->id;?>,'<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10; ?>')" <?php }?>><?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?></label>
											<span class="Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>">
												<span class="Total_Soft_Poll_3_Span3_<?php echo $Total_Soft_Poll;?>">
													<span class="Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span1_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_CA == 'Background'){ ?> background-color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl; }?>; <?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_Eff == '0'){ ?> width: <?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . '%'; }?>">
													</span>
													<label class="Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span2_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>" style="<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_CA == 'Color'){ ?> color: <?php echo $Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans_Cl;?> !important <?php }?>">
														<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'countlab' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'percentlab' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'bothlab'){ ?>
															<?php echo html_entity_decode($Total_Soft_Poll_Ans[$i]->TotalSoftPoll_Ans);?>
														<?php }?>
														<span class="Total_Soft_Poll_3_Span4_<?php echo $Total_Soft_Poll;?> Total_Soft_Poll_3_Span4_<?php echo $Total_Soft_Poll;?>_<?php echo $i+1;?>">
															<?php if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'percent' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'percentlab'){ ?>
																<?php echo round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' %'; ?>
															<?php } else if( $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'count' || $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_T == 'countlab' ){ ?>
																<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes; ?>
															<?php } else { ?>
																<?php echo $Total_Soft_Poll_Res[$i]->Poll_A_Votes . ' ( ' . round($Total_Soft_Poll_Res[$i]->Poll_A_Votes*100/$Total_Soft_Poll_Res_Count,2) . ' % )'; ?>
															<?php } ?>
														</span>
													</label>
												</span>
											</span>
										</div>
									<?php }?>
									<div class="Total_Soft_Poll_1_LAA_Div_<?php echo $Total_Soft_Poll;?>"></div>
								</div>
								<div class="Total_Soft_Poll_1_But_MDiv_<?php echo $Total_Soft_Poll;?>">
									<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_Show == 'true'){ ?>
										<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Show == 'true' && $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_Show == 'true'){ ?>
											<label style="display: block; width: 100%; line-height: 1 !important; margin-bottom: 0 !important; padding: 0 !important; float: left;">
												<i class="totalsoft Total_Soft_Poll_1_Total_View_But_Icon">
													<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_TV_Text) . ' : ' . $Total_Soft_Poll_Res_Count1;?></span>
												</i>
											</label>
										<?php }else { ?>
											<i class="totalsoft Total_Soft_Poll_1_Total_View_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_TV_Text) . ' : ' . $Total_Soft_Poll_Res_Count1;?></span>
											</i>
										<?php }?>
									<?php }?>
									<?php if($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Show == 'true'){ ?>
										<button class="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Result_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Text);?>" onclick="Total_Soft_Poll_3_Result(<?php echo $Total_Soft_Poll;?>)">
											<i class="totalsoft Total_Soft_Poll_1_Result_But_Icon">
												<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_RB_Text);?></span>
											</i>
										</button>
									<?php }?>
									<?php if($Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_VB_Show == 'true'){ ?>
										<?php $cookie = ( isset($_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll]) ) ? $_COOKIE["TotalSoft_Poll_Cookie_" . $Total_Soft_Poll] : '';
									 if($cookie == ''){ ?>
											<button class="Total_Soft_Poll_5_But_Vote Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_Text);?>" onclick="Total_Soft_Poll_5_But_Vote(<?php echo $Total_Soft_Poll;?>, event)">
												<i class="totalsoft Total_Soft_Poll_1_Vote_But_Icon">
													<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_Text);?></span>
												</i>
											</button>
										<?php } ?>
										<?php if($cookie && $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 != "true"){ ?>
											<button class="Total_Soft_Poll_5_But_Vote Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Vote_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_Text);?>" onclick="Total_Soft_Poll_5_But_Vote(<?php echo $Total_Soft_Poll;?>, event)">
												<i class="totalsoft Total_Soft_Poll_1_Vote_But_Icon">
													<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_VB_Text);?></span>
												</i>
											</button>
										<?php } ?>	
									<?php }?>
								</div>
								<div class="Total_Soft_Poll_1_BBut_MDiv_<?php echo $Total_Soft_Poll;?>">
									<div class="Total_Soft_Poll_1_Div_Cook_<?php echo $Total_Soft_Poll;?>"></div>
									<button class="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" id="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" name="Total_Soft_Poll_1_But_Back_<?php echo $Total_Soft_Poll;?>" type="button" value="<?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_Text);?>" onclick="Total_Soft_Poll_3_Back(<?php echo $Total_Soft_Poll;?>)">
										<i class="totalsoft Total_Soft_Poll_1_Back_But_Icon">
											<span><?php echo html_entity_decode($Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_BB_Text);?></span>
										</i>
									</button>
								</div>
							</div>
							
							<input type="text" style="display: none;" id="TotalSoft_Poll_5_IV_ID" value="<?php echo $Total_Soft_Poll;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_5_IV_Vote" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10; ?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_3_V_Eff_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme_1[0]->TotalSoft_Poll_5_V_Eff;?>">
							<input type="text" style="display: none;" id="TotalSoftPoll_Ans_C_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Man[0]->TotalSoftPoll_Ans_C;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_5_TV_Show_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Theme[0]->TotalSoft_Poll_5_TV_Show;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_01_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_01;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_02_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_03_<?php echo $Total_Soft_Poll;?>" value="<?php echo $Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03;?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_04_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_04);?>">
							<input type="text" style="display: none;" id="TotalSoft_Poll_Set_05_<?php echo $Total_Soft_Poll;?>" value="<?php echo html_entity_decode($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_05);?>">
						</div>
						<?php
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_02 != '')
							{
								?>
									<script type="text/javascript">
										Total_Soft_Poll_Upcoming(<?php echo $Total_Soft_Poll;?>);
									</script>
								<?php
							}
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_03 != '')
							{
								?>
									<script type="text/javascript">
										Total_Soft_Poll_End_Poll(<?php echo $Total_Soft_Poll;?>, 'ImageIQ/VideoIQ');
									</script>
								<?php
							}
							if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_10 == 'true')
							{
								if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'phpcookie')
								{
									if(isset($_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll]))
									{
										if( $_COOKIE['TotalSoft_Poll_Cookie_' . $Total_Soft_Poll] == 'ImageIQ/VideoIQ' )
										{
											?>
												<script type="text/javascript">
													Total_Soft_Poll_Ans_DivSt1(<?php echo $Total_Soft_Poll;?>);
												</script>
											<?php
										}
									}
								}
								else if($Total_Soft_Poll_Set[0]->TotalSoft_Poll_Set_11 == 'ipaddress')
								{
									if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
										$Total_Soft_IP_Address = $_SERVER['HTTP_CLIENT_IP'];
									} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED_FOR' );
									} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_X_FORWARDED' );
									} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED_FOR' );
									} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
										$Total_Soft_IP_Address = getenv( 'HTTP_FORWARDED' );
									} elseif ( getenv( 'REMOTE_ADDR' ) ) {
										$Total_Soft_IP_Address = getenv( 'REMOTE_ADDR' );
									} else {
										$Total_Soft_IP_Address = 'UNKNOWN';
									}
									$Total_Soft_Poll_Info = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Poll_ID = %d AND IPAddress = %s order by id", $Total_Soft_Poll, $Total_Soft_IP_Address));
									if($Total_Soft_Poll_Info)
									{
										?>
											<script type="text/javascript">
												Total_Soft_Poll_Ans_DivSt1(<?php echo $Total_Soft_Poll;?>);
											</script>
										<?php
									}
								}
							}
						?>
					</form>
				<?php } ?>
				
			<?php	

			echo $after_widget;
		}
	}
?>