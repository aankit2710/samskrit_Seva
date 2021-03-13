<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<?php
include("wocms/include/db.php"); 
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$abc=mysqli_query($conn,"select * from meta_tbl where page_name='".$actual_link."'");
$xyz=mysqli_fetch_assoc($abc);

$meta_title=$xyz['meta_title'];
$meta_desc=$xyz['meta_desc'];

$meta_Canonical_Link=$xyz['meta_Canonical_Link'];
$meta_Heading_Tag=$xyz['meta_Heading_Tag'];
$metadesc=$xyz[''];
?>
<title><?php echo utf8_encode($meta_title); ?></title>
<meta name="description" content="<?php echo utf8_encode($meta_desc); ?>">
<?php
$Areadata = mysqli_query($conn,"SELECT * FROM `logo` where logo_id=1");
$logo= mysqli_fetch_assoc($Areadata);
$google_analytics=$logo['google_analytics'];
?>
<?php $meta_Canonical_Link=stripslashes($meta_Canonical_Link);
echo $meta_Canonical_Link=html_entity_decode($meta_Canonical_Link);
?>
<?php
$google_analytics=stripslashes($google_analytics);
echo $google_analytics=html_entity_decode($google_analytics);
?>
 <meta property="og:title" content="<?php echo utf8_encode($meta_title); ?>"/>
<meta property="og:description" content="<?php echo utf8_encode($meta_desc); ?>"/>
<meta name="content-language" content="en">
<meta name="robots" content="index, follow">
<meta name="robots" content="all">
<meta name="author" content="hebergementdlg.com"/>
<meta name="googlebot" content="index, follow">
<meta name="referrer" content="always">
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.hebergementdlg.com/">
<meta property="og:image" content="https://www.hebergementdlg.com/uploads/gallery/dominic.jpg">
<meta property="og:site_name" content="Hebergement DLG">

<meta name="google-site-verification" content="4UITjcLbSRem1LD9iA19SK-mK7HkHsj-pcBpWjTjp-s" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173897641-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-173897641-1');
</script>