<?php
/**
 * 	microinv class
 */
class microinv
{

	function ls_do_get_microinv_page($type)
	{
		switch($type)
		{
			case 'load':
				include('html/select_schema.phtml');
			break;
			
			case 'person':
				include('html/person.phtml');
			break;
			
			case 'local_business':
				include('html/local_business.phtml');
			break;
			
			case 'place':
				include('html/place.phtml');
			break;
			
			case 'product':		
				include('html/product.phtml');
			break;
			
			case 'review':		
				include('html/review.phtml');
			break;
		
			case 'event':
				include('html/event.phtml');
			break;
			
			case 'organization':
				include('html/organization.phtml');
			break;
			
			default:
				echo 'No such type present';
			break;
		}
	}
	
	function ls_do_create_microdata()
	{
		$data = array_map('trim',$_REQUEST);
		extract($data);
		echo "~:~";
		$content = '';
		switch($type)
		{
			case "person":
				
				$content = '<div class="mdata person" itemscope itemtype="http://schema.org/Person">';
			  	if(!empty($person_name))
				{
					$content .= '<h2 class="name" itemprop="name">'.$person_name.'</h2>';
				}
				if(!empty($person_image))
				{
					$content .= '<img class="bio-img" src="'.$person_image.'" itemprop="image" /><br>';
				}
				if(!empty($person_job_title))
				{
					$content .= '<span class="job-title" itemprop="jobTitle"><b>'.$person_job_title.'</b></span><br>';
				}
				if(!empty($person_work_location))
				{
					$content .= '<span class="work-location" itemprop="workLocation">'.$person_work_location.'</span><br>';
				}
				$content .= '<div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				if(!empty($person_street_address))
				{
					$content .= '<span class="street-address" itemprop="streetAddress">'.$person_street_address.'</span><br>';
				}
				if(!empty($person_address_locality))
				{
					$content .= '<span class="address-locality" itemprop="addressLocality">'.$person_address_locality.'</span>';
				}
				if(!empty($person_address_region))
				{
					$content .= ',<span class="address-region" itemprop="addressRegion">'.$person_address_region.'</span>';
				}
				if(!empty($person_postal_code))
				{
					$content .= '<span class="address-region" itemprop="postalCode">'.$person_postal_code.'</span>';
				}
				$content .= '</div>';
				if(!empty($person_telephone))
				{
					$content .= '<span class="telephone" itemprop="telephone">'.$person_telephone.'</span><br>';
				}
				if(!empty($person_email))
				{
					$content .= '<a class="email" href="mailto:'.$person_email.'" itemprop="email">'.$person_email.'</a><br>';
				}
				if(!empty($person_url))
				{
					$content .= '<a class="url" href="'.$person_url.'" itemprop="url">'.$person_url.'</a>';
				}
				$content .= '</div>';
					
			break;
			
			case "local_business":
				$content = 	'<div class="place" itemscope itemtype="http://schema.org/LocalBusiness">';
				if(!empty($local_business_name))
				{
					$content .= '<span class="name" itemprop="name"><b>'.$local_business_name.'</b></span>';
				}
				if(!empty($local_business_description))
				{
					$content .= '<br><span class="description" itemprop="description"><i>'.$local_business_description.'</i></span>';
				}
				$content .= '<br><div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				if(!empty($local_business_street_address))
				{
					$content .= '<span class="street-address" itemprop="streetAddress">'.$local_business_street_address.'</span>';
				}
				if(!empty($local_business_address_locality))
				{
					$content .= '<br><span class="address-locality" itemprop="addressLocality">'.$local_business_address_locality.'</span>';
				}
				if(!empty($local_business_address_region))
				{
					$content .= ',<span class="address-region" itemprop="addressRegion">'.$local_business_address_region.'</span>';
				}
				if(!empty($local_business_postal_code))
				{
					$content .= '<span class="address-region" itemprop="postalCode">'.$local_business_postal_code.'</span>';
				}
				$content .= '</div>';
				if(!empty($local_business_telephone))
				{
					$content .= '<span class="telephone" itemprop="telephone">'.$local_business_telephone.'</span>';
				}
				$content .= '</div>';
				
			break;
			
			case "place":
				$content =	'<div class="place" itemscope itemtype="http://schema.org/Place">';
				if(!empty($place_name))
				{
					$content .=	'<span class="name" itemprop="name"><b>'.$place_name.'</b></span><br>';
				}
				if(!empty($place_description))
				{			
					$content .= '<span class="description" itemprop="description"><i>'.$place_description.'</i></span><br>';
				}			
				$content .= '<div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				if(!empty($place_street_address))
				{			
					$content .= '<span class="street-address" itemprop="streetAddress">'.$place_street_address.'</span><br>';
				}
				if(!empty($place_address_locality))
				{			 
					$content .= '<span class="address-locality" itemprop="addressLocality">'.$place_address_locality.'</span>';
				}
				if(!empty($place_address_region))
				{			
					$content .= ',<span class="address-region" itemprop="addressRegion">'.$place_address_region.'</span>'; 
				}
				if(!empty($place_postal_code))
				{			
					$content .= '<span class="postal-code" itemprop="postalCode">'.$place_postal_code.'</span>';
				}
				$content .= '</div>';
				$content .= '</div>';
				
			break;
			
			case "product":
				$content ='<div class="product" itemscope itemtype="http://schema.org/Product">';
				if(!empty($product_name))
				{
					$content .= '<span class="name" itemprop="name"><b>'.$product_name.'</b></span><br>';
				}
				if(!empty($product_image))
				{			
					$content .= '<img class="data-img" itemprop="image" src="'.$product_image.'" alt="'.$product_image.'"/><br>';
				}
				$content .= '<div class="offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
				if(!empty($product_price))
				{			
					$content .= '<span itemprop="price">'.$product_price.'</span><br>';
				}
				if(!empty($product_availability))
				{			
					$content .= '<span itemprop="availability"/>'.$product_availability.'</span>';
				}			
				$content .= '</div>';
				if(!empty($product_description))
				{			
				  	$content .= '<b>Product description:</b>
				  				<span itemprop="description">'.$product_description.'</span>';
				}			
				$content .= '<br><b>Customer reviews:</b><div class="reviews" itemprop="reviews" itemscope itemtype="http://schema.org/Review">';
				if(!empty($product_review_name))
				{			
					$content .= '<span itemprop="name">'.$product_review_name.'</span>';
				}
				if(!empty($product_review_author))
				{	
					$content .= '- by <span itemprop="author">'.$product_review_author.'</span>';
				}
				if(!empty($product_review_date_published))
				{			
					$content .= ',<meta itemprop="datePublished" content="'.$product_review_date_published.'">'.$product_review_date_published.'';
				}
							
				$content .= '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">';
				if(!empty($product_review_worst_rating))
				{			
					$content .= '<meta itemprop="worstRating" content = "'.$product_review_worst_rating.'">';
				}
				if(!empty($product_review_rating_value))
				{			
					$content .= '<span itemprop="ratingValue">'.$product_review_rating_value.'</span>';
				}
				if(!empty($product_review_best_rating))
				{			
					$content .= '/<span itemprop="bestRating">'.$product_review_best_rating.'</span>stars';
				}
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				
			break;
			
			case "review":
				$content ='<div class="reviews" itemscope itemtype="http://schema.org/Review">';
				if(!empty($review_name))
				{
					$content .='<span itemprop="name">'.$review_name.'</span>'; 
				}
				if(!empty($review_author))
				{		   
					$content .='- by <span itemprop="author">'.$review_author.'</span>';
				}
				if(!empty($review_date_published))
				{		   
					$content .='<br>,<meta itemprop="datePublished" content="'.$review_date_published.'">'.$review_date_published.'';
				}
				if(!empty($review_description))
				{		   
					$content .='<span itemprop="description">'.$review_description.'</span>';
				}
				$content .='</div>';
				
			break;
			
			case "event":
				$content ='<div class="event" itemscope itemtype="http://schema.org/Event">';
				if(!empty($event_name))
				{	
				  	$content .='<a class="url" itemprop="url" href="'.$event_url.'"><span itemprop="name"> <b>'.$event_name.'</b> </span></a>';
				}
				if(!empty($event_start_date))
				{			
					$content .='<br><meta class="start-date" itemprop="startDate" content="'.$event_start_date.'"><i> '.$event_start_date.'</i>';
				}
				$content .='<div class="location" itemprop="location" itemscope itemtype="http://schema.org/Place">';
				if(!empty($event_location_name))
				{						
					$content .='<a class="location-url" itemprop="url" href=" '.$event_location_url.'"> '.$event_location_name.'</a>';
				}
				$content .='<div class="addr" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				if(!empty($event_street_address))
				{					
					$content .='<span class="street-address" itemprop="streetAddress"> '.$event_street_address.'</span>';
				}
				if(!empty($event_address_locality))
				{			
					$content .='<span class="address-locality" itemprop="addressLocality"> '.$event_address_locality.'</span>';
				}
				if(!empty($event_address_region))
				{			
					$content .=',<span class="address-region" itemprop="addressRegion"> '.$event_address_region.'</span>';
				}
				if(!empty($event_postal_code))
				{			 
					$content .='<span class="postal-code" itemprop="postalCode"> '.$event_postal_code.'</span>';
				}
							
				$content .='</div>';
							
				$content .='</div>';
							
				$content .='<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
				if(!empty($event_price))
				{			
					$content .='<b>Price:</b> <span class="offer-price" itemprop="price"> '.$event_price.'</span><br>';
				}
				if(!empty($event_availability))
				{			
					$content .='<b>Availability:</b> <span class="offer-availability" itemprop="availability"> '.$event_availability.'</span>';
				}
							
				$content .='<div itemprop="aggregateOffer" itemscope itemtype="http://schema.org/AggregateOffer">';
				if(!empty($event_low_price))
				{			
					$content .='<meta itemprop="lowPrice" content = " '.$event_low_price.'"/>';
				}
				if(!empty($event_high_price))
				{			
					$content .='<meta itemprop="highPrice" content = " '.$event_high_price.'"/>';
				}
							
				$content .='</div>';
				$content .='</div>';				
				$content .='</div>';
				
			break;
			
			case "organization":
				$content ='<div class="organization" itemscope itemtype="http://schema.org/Organization">';
				if(!empty($organization_url))
				{
					$content .='<a class="url" itemprop="url" href="'.$organization_url.'">';
				}
				if(!empty($organization_name))
				{			
					$content .='<span class="name" itemprop="name">'.$organization_name.'</span></a>';
				}			
				$content .='<br><div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				if(!empty($organization_street_address))
				{			
					$content .='<span class="street-address" itemprop="streetAddress">'.$organization_street_address.'</span><br>';
				}
				if(!empty($organization_address_locality))
				{			
					$content .='<span class="address-locality" itemprop="addressLocality">'.$organization_address_locality.'</span>';
				}
				if(!empty($organization_address_region))
				{			
					$content .=',<span class="address-region" itemprop="addressRegion">'.$organization_address_region.'</span>';
				}
				if(!empty($organization_postal_code))
				{			
					$content .='<span class="address-region" itemprop="postalCode">'.$organization_postal_code.'</span>';
				}			
				$content .='</div>';
				if(!empty($organization_telephone))
				{			
					$content .='<b>Tel:</b> 
								<span class="tel" itemprop="telephone">'.$organization_telephone.'</span><br>';
				}
				if(!empty($organization_fax_number))
				{			
					$content .='<b>Fax:</b> 
								<span class="fax" itemprop="faxNumber">'.$organization_fax_number.'</span><br>';
				}
				if(!empty($organization_email))
				{			
					$content .='<b>E-mail:</b> 
								<span class="email" itemprop="email">'.$organization_email.'</span>';
				}			
				$content .='</div>';
				
			break;
		}
		
		echo $content;
		echo "~:~";
	}
	
	function ls_do_save_microdata()
	{
		global $wpdb;
		$save_microdata = trim($_REQUEST['save_data']);
		$save_microdata = stripslashes($save_microdata);
		if(!empty($save_microdata))
		{
			$microinv_option_name = "microinv_".time();
			update_option($microinv_option_name, $save_microdata);
			echo "microinv id=".$microinv_option_name;
		}
	}
	
	function get_blog_root_dir()
	{
		$base = dirname(__FILE__);
		$path = false;
	
		if (@file_exists(dirname(dirname($base))."/wp-config.php"))
		{
			$path = dirname(dirname($base))."/wp-config.php";
		}
		else
		if (@file_exists(dirname(dirname(dirname($base)))."/wp-config.php"))
		{
			$path = dirname(dirname(dirname($base)))."/wp-config.php";
		}
		else if (@file_exists(dirname(dirname(dirname(dirname($base))))."/wp-config.php"))
		{
			$path = dirname(dirname(dirname(dirname($base))))."/wp-config.php";
		}
		else
		$path = false;
	
		if ($path != false)
		{
			
			$search_path = array('\\','wp-config.php');
			$replace_path = array('/','');
			
			$path = str_replace($search_path, $replace_path, $path);
			
		}
		
		return $path;
	}
}
?>